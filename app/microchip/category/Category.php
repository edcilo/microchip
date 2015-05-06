<?php

namespace microchip\category;

use microchip\base\BaseEntity;

class Category extends BaseEntity
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany('microchip\productDescription\ProductDescription');
    }
}
