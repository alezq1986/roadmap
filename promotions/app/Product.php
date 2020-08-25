<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_id', 'category_1_id', 'category_2_id', 'category_3_id', 'category_4_id', 'category_5_id'];
}
