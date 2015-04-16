<?php namespace microchip\pendingMovement;

use microchip\base\BaseEntity;

class PendingMovement extends BaseEntity {

	protected $fillable = [
        'barcode',
        's_description',
        'l_description',
        'provider_link',
        'image_link',
        'quantity',
        'selling_price',
        'w_iva',
        'dollar',
        'utility',
        'shipping',
        'product_id',
        'sale_id'
    ];

    public function getRegisteredAttribute()
    {
        return ($this->product_id != 0) ? 1 : 0;
    }

    public function getSellingPriceTotalAttribute()
    {
        $total = $this->selling_price * ($this->utility / 100 + 1);

        $total *= ($this->w_iva) ? $this->sale->iva / 100 + 1 : 1;
        $total *= ($this->dollar) ? $this->sale->dollar : 1;
        $total += $this->shipping;

        return $total;
    }

    public function getSellingPriceFAttribute()
    {
        return number_format($this->getSellingPriceTotalAttribute(), 2);
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->getSellingPriceTotalAttribute();
    }

    public function getTotalFAttribute()
    {
        return number_format($this->getTotalAttribute(), 2);
    }

    public function getOrdersTotalAttribute()
    {
        return $this->orders->sum('quantity');
    }

    public function getOrdersRestAttribute()
    {
        return $this->quantity - $this->getOrdersTotalAttribute();
    }



    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }

    public function product()
    {
        return $this->belongsTo('microchip\product\Product');
    }

    public function orders()
    {
        return $this->hasMany('microchip\orderProduct\OrderProduct');
    }
}