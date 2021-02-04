<?php

namespace App;

use App\ShoppingCart;
use App\ShoppingCartItem;
use App\Parameter;
use App\PromotionIf;
use App\PromotionThen;
use App\Product;
use Decimal\Decimal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promotion extends Model
{

    protected $fillable = ['start_date', 'end_date', 'active', 'max_times', 'expression'];

    public function ifs()
    {
        return $this->hasMany('App\PromotionIf');
    }

    public function thens()
    {
        return $this->hasMany('App\PromotionThen');
    }

    protected static function verifyIf(PromotionIf $pi, ShoppingCart $sc)
    {
        switch ($pi->type) {

            case 0:

                if ($pi->amount_type == 0) {

                    $v = $sc->value / $pi->value;

                    return $v->floor();

                } else {

                    $v = $sc->item_quantity / $pi->value;

                    return $v->floor();

                }

            case 1:

                if ($pi->amount_type == 0) {

                    $items_value = $sc->items->filter(function ($item) use ($pi) {

                        return ($item->product_id == $pi->product_id);

                    })->sum('value');

                    $v = $items_value / $pi->value;

                    return $v->floor();

                } else {

                    $items_quantity = $sc->items->filter(function ($item) use ($pi) {

                        return ($item->product_id == $pi->product_id);

                    })->sum('quantity');

                    $v = $items_quantity / $pi->quantity;

                    return $v->floor();

                }

            case 2:

                if ($pi->amount_type == 0) {

                    $items_value = $sc->items->filter(function ($item) use ($pi) {

                        return ($item->{'category' . $pi->category_level . 'id'} == $pi->category_id);

                    })->sum('value');

                    $v = $items_value / $pi->value;

                    return $v->floor();

                } else {

                    $items_quantity = $sc->items->filter(function ($item) use ($pi) {

                        return ($item->{'category' . $pi->category_level . 'id'} == $pi->category_id);

                    })->sum('quantity');

                    $v = $items_quantity / $pi->quantity;

                    return $v->floor();

                }

            default:

                return 0;
        }

    }

    protected static function calculateDiscount(ShoppingCartItem $sci, $discount_type, Decimal $discount_value, Decimal $quantity)
    {

        $min_item_value = new Decimal(DB::table('parameters')->where('param_code', '=', '2')->first()->param_value);

        $sci_value = new Decimal($sci->value);

        $sci_unit_value = new Decimal($sci->unit_value);

        $sci_quantity = new Decimal($sci->quantity);

        $sci_discount = is_null($sci->discount) ? new Decimal('0') : new Decimal($sci->discount);

        $sci_net_value = is_null($sci->net_value) ? $sci_value : new Decimal($sci->net_value);

        switch ($discount_type) {

            case 0:

                $discount = min($sci_quantity, $quantity) * min($sci_unit_value, $discount_value);

                $discount = min($sci_quantity, $quantity) * min($sci_unit_value, $discount_value);

                break;

            case 1:

                $discount = min($sci_quantity, $quantity) * $sci_unit_value * min(1, $discount_value / 100);

                break;

            case 2:

                $discount = min($sci_quantity, $quantity) * max(0, $sci_unit_value - $discount_value);

                break;

            default:

                throw new \Exception('Tipo de desconto não suportado');

        }

        if ($min_item_value > 0 && $sci_value == $discount) {

            $discount = $discount - $min_item_value;

            $remainder = $min_item_value;

        } else {

            $remainder = new Decimal("0");

        }

        return array('discount' => $discount->round(2, Decimal::ROUND_HALF_EVEN), 'remainder' => $remainder->round(2, Decimal::ROUND_HALF_EVEN));

    }


    protected static function verifyThen(PromotionThen $pt, ShoppingCartItem $sci)
    {

        $discounts = collect();

        switch ($pt->type) {

            case 0:

                break;


            case 1:

                if ($pt->product_id == $sci->product_id) {

                    return self::calculateDiscount($sci, $pt->discount_type, new Decimal ($pt->discount_value), new Decimal ($pt->quantity));


                } else {


                    return array('discount' => new Decimal('0'), new Decimal('0'));

                }

            case 2:

                if (Product::where('product_id', '=', $pt->product_id)->first()->isInCategory($pt->category_id, $pt->category_level)) {

                    return self::calculateDiscount($sci, $pt->discount_type, new Decimal ($pt->discount_value), new Decimal ($pt->quantity));


                } else {

                    return array('discount' => new Decimal('0'), new Decimal('0'));

                }

                break;

            default:

                break;

        }

        return $discounts;
    }

    protected function verifyPromotion(ShoppingCart $sc)
    {

        $expression = $this->expression;

        $pattern = '(if_([0-9]\d+|[0-9]))';

        preg_match_all($pattern, $expression, $matches);

        foreach ($matches[0] as $m) {

            $replace = '\\App\\Promotion::verifyIf(\\App\\PromotionIf::find(' . preg_replace('(if_)', '', $m) . '), \$sc)';

            $expression = preg_replace($pattern, $replace, $expression, 1);

        }

        $expression = 'return ' . $expression . ';';

        return eval($expression);

    }

    public static function calculatePromotions(ShoppingCart $sc, $cummulative = 0)
    {

        $results = array('items' => $i = collect());

        $sc->calculated_items = $sc->items;

        //1: vejo quais promoções são aplicáveis
        $promotions = Promotion::all();

        $applicable_promotions = collect();

        $applicable_thens = collect();

        foreach ($promotions as $promotion) {

            $ap['promotion'] = $promotion;

            $ap['times'] = min($promotion->verifyPromotion($sc), $promotion->max_times);

            if ($ap['times'] >= 1) {

                //1.1: crio a collection de promoções aplicáveis
                $applicable_promotions->push($ap);

                //1.2: crio a collection de thens aplicáveis
                foreach ($promotion->thens as $pt) {

                    $at['then'] = $pt;

                    $at['times'] = $ap['times'];

                    $at['times_used'] = 0;

                    $applicable_thens->push($at);

                }

            }

        }

        //2: calculo as promoções


        //2A:cumulativas
        if ($cummulative) {


            //2B: não cumulativas
        } else {

            //2B.1: passo item a item verificando as promoções aplicáveis
            foreach ($sc->calculated_items as $ci) {

                foreach ($applicable_thens as $at) {

                    if ($at['times'] >= $at['times_used']) {



                    } else {

                    }

                }


                //1.1: vejo se há promoções aplicadas

                //1A - verifico todas as promoções aplicáveis sobre o item
                foreach ($applicable_promotions as $ap) {


                    $item_thens = $ap['promotion']->thens->filter(function ($pt) use ($csci) {

                        return ($pt->type == 1 && $pt->product_id == $csci->product_id);

                    });

                    $discounts = collect();

                    //1B - calculo as promoções
                    foreach ($item_thens as $it) {

                        $d['promotion'] = $it->promotion_id;

                        $d['then'] = $it->promotion_id;

                        $d['discount'] = Promotion::verifyThen($it, $csci);

                        $discounts = Promotion::verifyThen($it, $sc);

                        foreach ($discounts as $discount) {

                            if (isset($results['items'][$discount['item']])) {

                                $results['items'][$discount['item']]->push(array('promotion' => $discount['promotion'], 'then' => $discount['then'], 'discount' => $discount['discount']));

                            } else {

                                $results['items'][$discount['item']] = collect(array('promotion' => $discount['promotion'], 'then' => $discount['then'], 'discount' => $discount['discount']));

                            }

                        }

                    }


                }


            }


//            foreach ($applicable_promotions as $ap){
//
//                $item_thens = $ap['promotion']->thens->filter(function ($p) {
//
//                    return $p->type == 1;
//
//                });
//
//            }
//
//
//            foreach ($item_thens as $it) {
//
//                $discounts = Promotion::verifyThen($it, $sc);
//
//                foreach ($discounts as $discount) {
//
//                    if (isset($results['items'][$discount['item']])) {
//
//                        $results['items'][$discount['item']]->push(array('promotion'=>$discount['promotion'], 'then' =>$discount['then'], 'discount' => $discount['discount']));
//
//                    } else {
//
//                        $results['items'][$discount['item']] = collect(array('promotion'=>$discount['promotion'], 'then' =>$discount['then'], 'discount' => $discount['discount']));
//
//                    }
//
//                }
//
//            }


        }

        return $results;

    }

}
