<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionThen extends Model
{

    /* type: 0 - desconto no ticket; 1 - desconto no produto; 2 - desconto na categoria;
     * discount_type 0 - desconto em valor; 1 - desconto percentual; 2 - valor de oferta
     */
    protected $fillable = ['promotion_id', 'type', 'discount_type', 'discount_value', 'quantity', 'product_id','category_level', 'category_id'];

    public function promotion()
    {
        return $this->belongsTo('App\Promotion');
    }


}
