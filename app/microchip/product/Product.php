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
