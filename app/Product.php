<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function discount()
    {
        return $this->hasOne(ProductDiscount::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function quantity()
    {
        return $this->hasOne(Quantity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }

    /**
     * @return float
     */
    public function finalPrice()
    {
        $price = $this->getAttribute('price');
        $vat = (new Setting)->getVATSize();
        $discountEntry = $this->discount;
        $discount = $discountEntry ? $discountEntry->discount : 0;
        if (!$price) {
            return 0.00;
        }
        $finalPrice = $price + ($price * $vat / 100) - ($price * $discount / 100);
        return round($finalPrice, 2);
    }

}
