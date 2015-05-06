<?php

namespace microchip\productDescription;

use microchip\base\BaseEntity;

class ProductDescription extends BaseEntity
{
    protected $fillable = [
        'model',
        'have_series',
        'purchase_price',
        'data_sheet',
        'box',
        'pieces',
        'stock_min',
        'stock_max',
        'quantity',
        'provider',
        'provider_barcode',
        'provider_warranty',
        'category_id',
        'mark_id',
        'product_id',
    ];

    public function category()
    {
        return $this->belongsTo('microchip\category\Category');
    }

    public function mark()
    {
        return $this->belongsTo('microchip\mark\Mark');
    }

    public function product()
    {
        return $this->belongsTo('microchip\product\Product');
    }
}
