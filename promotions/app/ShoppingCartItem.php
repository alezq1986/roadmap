<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Decimal\Decimal;

class ShoppingCartItem extends Model
{
    protected $fillable = ['shopping_cart_id', 'product_id', 'quantity', 'unit_value', 'value', 'promotion_discount', 'net_value'];

    protected function shopping_cart()
    {
        return $this->belongsTo('App\ShoppingCart');
    }

    public function getQuantityAttribute($value)
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

    public function getUnitValueAttribute($value)
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

    public function setQuantityAttribute($value)
    {
        if ($value instanceof Decimal) {

            $this->attributes['quantity'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['quantity'] = new Decimal ($value);

        }
    }

    public function setValueAttribute($value)
    {
        if ($value instanceof Decimal) {

            $this->attributes['value'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['value'] = new Decimal ($value);

        }
    }

    public function setUnitValueAttribute($value)
    {
        if ($value instanceof Decimal) {

            $this->attributes['unit_value'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['unit_value'] = new Decimal ($value);

        }
    }

    public function setPromotionDiscountAttribute($value)
    {
        if ($value instanceof Decimal) {

            $this->attributes['promotion_discount'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['promotion_discount'] = new Decimal ($value);

        }
    }

    public function setNetValueAttribute($value)
    {
        if ($value instanceof Decimal) {

            $this->attributes['net_value'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['net_value'] = new Decimal ($value);

        }
    }
}
