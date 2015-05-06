<?php

namespace microchip\orderProduct;

use microchip\base\BaseEntity;

class OrderProduct extends BaseEntity
{
    protected $fillable = [
        'quantity',
        'selling_price',
        'user_id',
        'admin_id',
        'support_id',
        'pending_movement_id',
        'sale_id',
        'product_id',
    ];

    public function getTotalAttribute($f = '')
    {
        $total  = $this->selling_price * $this->quantity;

        return number_format($total, 2, '.', $f);
    }

    public function getSellingPriceFAttribute()
    {
        return number_format($this->selling_price, 2);
    }

    public function getTotalFAttribute()
    {
        return $this->getTotalAttribute(',');
    }

    public function getClassRowSeriesAttribute()
    {
        $color = '';

        if ($this->product->type == 'Producto') {
            if ($this->product->p_description->have_series) {
                if (count($this->series) != $this->quantity) {
                    $color = 'red';
                }
            }
        }

        return $color;
    }

    public function product()
    {
        return $this->belongsTo('microchip\product\Product');
    }

    public function order()
    {
        return $this->belongsTo('microchip\sale\Sale', 'sale_id', 'id');
    }

    public function pa()
    {
        return $this->belongsTo('microchip\pendingMovement\PendingMovement', 'pending_movement_id', 'id');
    }

    public function series()
    {
        return $this->hasMany('microchip\series\Series', 'separated_id', 'id');
    }

    public function permissionUser()
    {
        return $this->belongsTo('microchip\user\User', 'user_id', 'id');
    }

    public function permissionAdmin()
    {
        return $this->belongsTo('microchip\user\User', 'admin_id', 'id');
    }

    public function permissionSupport()
    {
        return $this->belongsTo('microchip\user\User', 'support_id', 'id');
    }
}
