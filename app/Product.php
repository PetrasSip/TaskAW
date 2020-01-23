<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function setting()
    {
        return $this->hasOne('App\Setting');
    }


    public function productDiscount()
    {
        return $this->hasOne('App\ProductDiscount');
    }


    public function quantity()
    {
        return $this->hasOne('App\Quantity');
    }


    public function productReviews()
    {
        return $this->hasMany('App\ProductReview');
    }


    public function productSpecifications()
    {
        return $this->hasMany('App\ProductReview');
    }


}
