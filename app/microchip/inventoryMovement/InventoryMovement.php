<?php

namespace microchip\inventoryMovement;

use microchip\base\BaseEntity;

class InventoryMovement extends BaseEntity
{
    protected $fillable = [
        'product_id',
        'in_stock',
        'quantity',
        'status',
        'warranty',
        'purchase_price',
        'selling_price',
        'description',
        'movement_in_id',
    ];

    public function getPurchasePriceFAttribute($f = ',')
    {
        return number_format($this->purchase_price, 2, '.', $f);
    }

    public function getTotalAttribute()
    {
        return number_format($this->selling_price * $this->quantity, 2, '.', '');
    }

    public function getTotalPurchaseWithoutIvaAttribute($f = '')
    {
        return number_format($this->purchase_price * $this->quantity, 2, '.', $f);
    }

    public function getTotalPurchaseWithoutIvaFAttribute()
    {
        return $this->getTotalPurchaseWithoutIvaAttribute(',');
    }

    public function getTotalWithoutIvaAttribute($f = '')
    {
        return number_format($this->getTotalAttribute() / ($this->sales[0]->iva / 100 + 1), 2, '.', $f);
    }

    public function getPvDiFAttribute()
    {
        return $this->getTotalAttribute();
    }

    public function getTotalWithoutIvaFAttribute()
    {
        return $this->getTotalWithoutIvaAttribute(',');
    }

    public function getSellingPriceWithoutIvaAttribute($f = '')
    {
        return number_format($this->selling_price / ($this->sales[0]->iva / 100 + 1), 2, '.', $f);
    }

    public function getSellingPriceWithoutIvaFAttribute()
    {
        return $this->getSellingPriceWithoutIvaAttribute(',');
    }

    public function getSellingPriceFAttribute()
    {
        return number_format($this->selling_price, 2);
    }

    public function getTotalFAttribute()
    {
        return number_format($this->getTotalAttribute(), 2);
    }

    public function getDateWarrantyAttribute()
    {
        return $this->created_at->addDays($this->warranty);
    }

    public function getClassRowAttribute()
    {
        $now        = \Carbon\Carbon::now();
        $delivery   = $this->getDateWarrantyAttribute();

        return ($delivery->lte($now)) ? 'red' : '';
    }

    public function getClassRowSeriesAttribute()
    {
        $color = '';

        if ($this->product->type == 'Producto') {
            if ($this->product->p_description->have_series) {
                if ($this->status == 'in' and count($this->series) != $this->quantity) {
                    $color = 'red';
                }

                if ($this->status == 'out' and count($this->series_out) != $this->quantity) {
                    $color = 'red';
                }
            }
        }

        return $color;
    }

    public function series()
    {
        return $this->hasMany('microchip\series\Series');
    }

    public function seriesOut()
    {
        return $this->hasMany('microchip\series\Series', 'movement_out', 'id');
    }

    public function product()
    {
        return $this->belongsTo('microchip\product\Product');
    }

    public function movementIn()
    {
        return $this->belongsTo('microchip\inventoryMovement\InventoryMovement', 'movement_in_id', 'id');
    }

    public function purchases()
    {
        return $this->belongsToMany('microchip\purchase\Purchase');
    }

    public function sales()
    {
        return $this->belongsToMany('microchip\sale\Sale')->withPivot('movement_in');
    }
}
