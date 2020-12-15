<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_id', 'category_1_id', 'category_2_id', 'category_3_id', 'category_4_id', 'category_5_id'];


    public function isInCategory($category_id, $category_level)
    {
        if (is_null($category_id) || is_null($category_level)) {

            return 0;

        } else {


            switch ($category_level) {

                case 1:

                    return ($category_id == $this->category_1_id) ? 1 : 0;

                case 2:

                    return ($category_id == $this->category_2_id) ? 1 : 0;

                case 3:

                    return ($category_id == $this->category_3_id) ? 1 : 0;

                case 4:

                    return ($category_id == $this->category_4_id) ? 1 : 0;

                case 5:

                    return ($category_id == $this->category_5_id) ? 1 : 0;

                default:

                    return 0;

            }

        }

    }

}
