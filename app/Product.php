<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function discount()
    {
        return $this->hasOne(ProductDiscount::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function quantity()
    {
        return $this->hasOne(Quantity::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class, 'product_id', 'id');
    }

    /**
     * @return float
     */
    public function finalPrice()
    {
        $price = $this->getAttribute('price');
        $vat = (new Setting)->getVATSize();
        $discountEntry = $this->discount;
        $discount = $discountEntry ? $discountEntry->value : 0;
        $globalDiscount = $discount ? 0 : (new Setting)->getGlobalDiscount();
        if (!$price) {
            return 0.00;
        }
        $finalPrice = $price + ($price * $vat / 100) - ($price * $discount / 100) - ($price * $globalDiscount / 100);
        return round($finalPrice, 2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function specificationTypes()
    {
        return $this->hasManyThrough(Specification::class, ProductSpecification::class, 'product_id', 'id', 'id', 'specification_id');
    }

}
