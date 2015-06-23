<?php

namespace microchip\product;

use microchip\base\BaseEntity;

class Product extends BaseEntity
{
    protected $fillable = [
        'barcode',
        'type',
        's_description',
        'description',
        'image',
        'price_1',
        'price_2',
        'price_3',
        'price_4',
        'price_5',
        'offer',
        'points',
        'r_points',
        'warranty',
        'web',
        'active',
        'slug',
    ];

    public function getStockAttribute()
    {
        return $this->movements->sum('in_stock');
    }

    public function getUtility1Attribute()
    {
        return $this->getUtility($this->price_1);
    }

    public function getUtility2Attribute()
    {
        return $this->getUtility($this->price_2);
    }

    public function getUtility3Attribute()
    {
        return $this->getUtility($this->price_3);
    }

    public function getUtility4Attribute()
    {
        return $this->getUtility($this->price_4);
    }

    public function getUtility5Attribute()
    {
        return $this->getUtility($this->price_5);
    }

    public function getCurrentPriceAttribute($f = ',')
    {
        $price = $this->price1;

        if ($this->offer != 0) {
            $price = 'price_' . $this->offer;
            $price = $this->$price;
        }

        return number_format($price, 2, '.', $f);
    }

    public function getUtility($price)
    {
        if (! is_null($this->pDescription)) {
            $utility = ($price / $this->pDescription->purchase_price - 1) * 100;
        } else {
            $utility = 100;
        }

        return number_format($utility, 2);
    }

    public function pDescription()
    {
        return $this->hasOne('microchip\productDescription\ProductDescription', 'product_id', 'id');
    }

    public function movements()
    {
        return $this->hasMany('microchip\inventoryMovement\InventoryMovement');
    }

    public function series()
    {
        return $this->hasMany('microchip\series\Series');
    }
}
