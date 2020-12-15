<?php

namespace App;

use Decimal\Decimal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    protected $fillable = ['external_id', 'customer_id', 'item_quantity', 'value', 'promotion_discount', 'net_value'];


    protected function items()
    {
        return $this->hasMany('App\ShoppingCartItem')->orderBy('product_id')->orderBy('unit_value', 'DESC');
    }


    public function getItemQuantityAttribute($value)
    {
        if ($value instanceof Decimal) {

            return $value;

        } else {

            return new Decimal ($value);

        }
    }

    public function getValueAttribute($value)
    {
        if ($value instanceof Decimal) {

            return $value;

        } else {

            return new Decimal ($value);

        }
    }

    public function getPromotionDiscountAttribute($value)
    {
        if ($value instanceof Decimal || is_null($value)) {

            return $value;

        } else {

            return new Decimal ($value);

        }
    }

    public function getNetValueAttribute($value)
    {
        if ($value instanceof Decimal || is_null($value)) {

            return $value;

        } else {

            return new Decimal ($value);

        }
    }

    public function setItemQuantityAttribute($value)
    {
        if ($value instanceof Decimal || $value == null) {

            $this->attributes['item_quantity'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['item_quantity'] = new Decimal ($value);

        }
    }

    public function setValueAttribute($value)
    {
        if ($value instanceof Decimal || $value == null) {

            $this->attributes['value'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['value'] = new Decimal ($value);

        }
    }

    public function setPromotionDiscountAttribute($value)
    {
        if ($value instanceof Decimal || $value == null) {

            $this->attributes['promotion_discount'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['promotion_discount'] = new Decimal ($value);

        }
    }

    public function setNetValueAttribute($value)
    {
        if ($value instanceof Decimal || $value == null) {

            $this->attributes['net_value'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['net_value'] = new Decimal ($value);

        }
    }

    public function aggregate($product_id = null)
    {
        $reference = array();

        $aggregate_items = collect();

        foreach ($this->items as $item) {

            if (isset($reference[$item->product_id]) && ($item->product_id == $product_id || $product_id == null)) {

                $aggregate_items[$reference[$item->product_id]]->quantity += $item->quantity;

                $aggregate_items[$reference[$item->product_id]]->value += $item->value;

                $aggregate_items[$reference[$item->product_id]]->promotion_discount += $item->promotion_discount;

                $aggregate_items[$reference[$item->product_id]]->net_value += $item->net_value;

                $aggregate_items[$reference[$item->product_id]]->unit_value = $aggregate_items[$reference[$item->product_id]]->value / $aggregate_items[$reference[$item->product_id]]->quantity;

            } else {

                $aggregate_items->push($item);

                $reference[$item->product_id] = $aggregate_items->count() - 1;

            }

        }

        //acertar o valor unitário

        foreach ($aggregate_items as $ai){

            if ($ai->value != $ai->unit_value * $ai->quantity) {

                $ai_old_value = $ai->value;

                $ai_new_value = $ai->unit_value * $ai->quantity;

                $ai->value = $ai_new_value;

                $ai->promotion_discount += ($ai_new_value - $ai_old_value);

            } else {


            }

        }

        return $this->calculated_items = $aggregate_items;

    }

    public function dismember($product_id = null)
    {
        $dismembered_items = collect();

        foreach ($this->calculated_items as $sci) {

            if ($sci->product_id == $product_id || $product_id == null) {

                $remaining_discount = $sci->promotion_discount;

                for ($quantity = $sci->quantity; $quantity > 0; $quantity--) {

                    $new_sci = $sci;

                    $new_sci->quantity = min(new Decimal('1'), $quantity);

                    $new_sci->value = $new_sci->quantity * $new_sci->unit_value;

                    if ($quantity <= 1) {

                        $new_sci->promotion_discount = $remaining_discount ?? new Decimal('0');

                    } else {


                        $new_sci->promotion_discount = $sci->promotion_discount ?? new Decimal('0') * $new_sci->quantity / $sci->quantity;

                    }


                    $new_sci->net_value = $new_sci->value - $new_sci->promotion_discount;

                    $dismembered_items->push($new_sci);

                    $remaining_discount -= $new_sci->promotion_discount;

                }
            } else {

                $dismembered_items->push($sci);

            }

        }

        return $this->calculated_items = $dismembered_items;

    }
}
