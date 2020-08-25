<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PromotionIf extends Model
{
    /* type: 0 - ticket; 1 - produto; 2 - categoria;
     * amount_type: 0 - valor; 1 - quantidade;
     */
    protected $fillable = ['promotion_id', 'type', 'amount_type', 'product_id', 'category_level', 'category_id', 'quantity', 'value'];

    public function promotion()
    {
        return $this->belongsTo('App\Promotion');
    }

}
