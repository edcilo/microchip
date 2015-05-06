<?php

namespace microchip\sale;

use microchip\base\BaseEntity;

class Sale extends BaseEntity
{
    protected $fillable = [
        'folio',
        'iva',
        'dollar',
        'type',                // factura o ticket
        'classification',    // venta, cotización, pedidos
        'status',
        'description',
        'new_price',
        'advance',
        'delivery_date',
        'delivery_time',
        'shipping_address',
        'sale',
        'separated',
        'price',
        'service',
        'customer_order',
        'movements_end',
        'series_end',
        'customer_id',
        'user_id',
    ];

    public function getIvaRealAttribute()
    {
        return $this->iva / 100 + 1;
    }

    public function getDifferenceIvaAttribute()
    {
        $total = $this->new_price - $this->new_price / $this->getIvaRealAttribute() - ($this->getTotalAttribute() - $this->getTotalAttribute() / $this->getIvaRealAttribute());

        $total = ($total < 0) ? 0 : $total;

        return number_format($total, 2, '.', '');
    }

    public function getSubtotalAttribute($f = '')
    {
        $subtotal = 0;
        foreach ($this->movements as $movement) {
            $subtotal += $movement->getTotalWithoutIvaAttribute();
        }

        return number_format($subtotal, 2, '.', $f);
    }

    public function getTotalAttribute($f = '')
    {
        $total = 0;
        foreach ($this->movements as $movement) {
            $total += $movement->getTotalAttribute();
        }

        return number_format($total, 2, '.', $f);
    }

    public function getTotalPrice($f = '')
    {
        $total = 0;

        foreach ($this->pas as $pa) {
            $total += ($pa->productPrice) ? $pa->getTotalAttribute() : 0;
        }

        return number_format($total, 2, '.', $f);
    }

    public function getTotalOrder($f = '')
    {
        $total = $this->getTotalAttribute();

        if ($this->classification != 'Venta') {
            foreach ($this->pas as $pa) {
                $total += ($pa->productOrder and !$pa->soft_delete) ? $pa->getTotalAttribute() : 0;
            }
        }

        return number_format($total, 2, '.', $f);
    }

    public function getRestAttribute($f = '')
    {
        $rest = $this->getTotalOrder() - $this->advance;

        return number_format($rest, 2, '.', $f);
    }

    public function getPaymentTotalAttribute($f = '')
    {
        $total = $this->payments->sum('amount') - $this->payments->sum('change');

        return number_format($total, 2, '.', $f);
    }

    public function getUserTotalPayAttribute($f = '')
    {
        $total = 0;

        foreach ($this->payments as $pay) {
            if ($pay->amount > 0) {
                $total += $pay->amount - $pay->change;
            }
        }

        return number_format($total, 2, '.', $f);
    }

    public function getRestTotalAttribute($f = '')
    {
        if ($this->classification == 'Venta') {
            $total = $this->getTotalAttribute();
        } elseif ($this->classification == 'Servicio') {
            $total = $this->getTotalPrice();
        } else {
            $total = $this->getTotalOrder();
        }

        $total -= $this->getPaymentTotalAttribute();

        return number_format($total, 2, '.', $f);
    }

    public function getUserRestTotalAttribute($f = '')
    {
        if ($this->classification == 'Venta') {
            $total = $this->getTotalAttribute() + $this->getDifferenceIvaAttribute();
        } elseif ($this->classification == 'Servicio') {
            $total = $this->getTotalPrice();
        } else {
            $total = $this->getTotalOrder();
        }

        $total -= $this->getUserTotalPayAttribute();

        return number_format($total, 2, '.', $f);
    }

    public function getPvDiAttribute($f = '')
    {
        return number_format($this->getTotalAttribute() + $this->getDifferenceIvaAttribute(), 2, '.', $f);
    }

    public function getSubtotalFAttribute()
    {
        return $this->getSubtotalAttribute(',');
    }

    public function getTotalFAttribute()
    {
        return $this->getTotalAttribute(',');
    }

    public function getTotalOrderFAttribute()
    {
        return $this->getTotalOrder(',');
    }

    public function getTotalPriceFAttribute()
    {
        return $this->getTotalPrice(',');
    }

    public function getPvDiFAttribute()
    {
        return $this->getPvDiAttribute(',');
    }

    public function getRestFAttribute()
    {
        return $this->getRestAttribute(',');
    }

    public function getRestTotalFAttribute()
    {
        return $this->getRestTotalAttribute(',');
    }

    public function getUserRestTotalFAttribute()
    {
        return $this->getUserRestTotalAttribute(',');
    }

    public function getPayTotalFAttribute()
    {
        return $this->getPaymentTotalAttribute(',');
    }

    public function getUserTotalPayFAttribute()
    {
        return $this->getUserTotalPayAttribute(',');
    }

    public function getAdvanceFAttribute()
    {
        return number_format($this->advance, 2);
    }

    public function getDaysInSupportAttribute()
    {
        $now = \Carbon\Carbon::now();

        return $now->diffInDays($this->created_at);
    }

    public function getDaysOverdueAttribute()
    {
        $now = \Carbon\Carbon::now();
        $delivery = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->delivery_date.' '.$this->delivery_time);

        $rest = $now->diffInDays($delivery, false);

        if ($rest == 0) {
            $rest = $now->diffInHours($delivery, false);

            if ($rest == 0) {
                $rest = $now->diffInMinutes($delivery, false).' Minutos';
            } else {
                $rest .= ' Horas';
            }
        } else {
            $rest .= ' Días';
        }

        return $rest;
    }

    public function getClassRowAttribute()
    {
        $color = '';

        $now = \Carbon\Carbon::now();
        $delivery = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->delivery_date.' '.$this->delivery_time);

        if ($delivery->lte($now)) {
            $color = 'red';
        }

        return $color;
    }

    public function data()
    {
        return $this->hasOne('microchip\serviceData\ServiceData');
    }

    public function coupon()
    {
        return $this->hasOne('microchip\coupon\Coupon');
    }

    public function pas()
    {
        return $this->hasMany('microchip\pendingMovement\PendingMovement');
    }

    public function orderProducts()
    {
        return $this->hasMany('microchip\orderProduct\OrderProduct');
    }

    public function comments()
    {
        return $this->hasMany('microchip\comment\Comment');
    }

    public function payments()
    {
        return $this->hasMany('microchip\pay\Pay');
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }

    public function customer()
    {
        return $this->belongsTo('microchip\customer\Customer');
    }

    public function customerOrder()
    {
        return $this->belongsTo('microchip\customer\Customer', 'customer_order', 'id');
    }

    public function movements()
    {
        return $this->belongsToMany('microchip\inventoryMovement\InventoryMovement')->withPivot('movement_in');
    }
}
