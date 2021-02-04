<?php

namespace App;

use Decimal\Decimal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    protected $fillable = ['external_id', 'customer_id', 'item_quantity', 'value', 'discount', 'net_value'];


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

    public function getDiscountAttribute($value)
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

    public function setDiscountAttribute($value)
    {
        if ($value instanceof Decimal || $value == null) {

            $this->attributes['discount'] = $value;

        } else {

            $value = strval($value);

            $this->attributes['discount'] = new Decimal ($value);

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

}
