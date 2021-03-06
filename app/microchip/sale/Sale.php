<?php

namespace microchip\sale;

use Carbon\Carbon;
use microchip\base\BaseEntity;

class Sale extends BaseEntity
{
    protected $fillable = [
        'folio_sale',
        'folio_separated',
        'folio_service',
        'folio_price',
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

    public function getFolioAttribute()
    {
        if ($this->classification == 'Venta') {
            $folio = $this->folio_sale;
        } elseif ($this->classification == 'Pedido') {
            $folio = $this->folio_separated;
        } elseif ($this->classification == 'Servicio') {
            $folio = $this->folio_service;
        } else {
            $folio = $this->folio_price;
        }

        return $folio;
    }

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
            if (!$movement->q_warranty) {
                $subtotal += $movement->getTotalWithoutIvaAttribute();
            }
        }

        return number_format($subtotal, 2, '.', $f);
    }

    public function getTotalAttribute($f = '')
    {
        $total = 0;
        foreach ($this->movements as $movement) {
            if (!$movement->q_warranty) {
                $total += $movement->getTotalAttribute();
            }
        }

        return number_format($total, 2, '.', $f);
    }

    public function getUtilityAttribute()
    {
        $utility = $this->getTotalAttribute() - $this->getTotalPurchase() + $this->getExpensesTotalAttribute();

        return $utility;
    }

    public function getUPercentageAttribute()
    {
        if ($this->getTotalPurchase() != 0) {
            $percentage = ($this->getPaymentTotalAttribute()/$this->getTotalPurchase() - 1) * 100;
        } else {
            $percentage = 100;
        }

        return $percentage;
    }

    public function getTotalServicesAttribute()
    {
        $total = 0;

        foreach ($this->movements as $movement) {
            if ($movement->product->type == 'Servicio') {
                $total += $movement->selling_price;
            }
        }

        return number_format($total, 2, '.', ',');
    }

    public function getTotalPrice($f = '')
    {
        $total = 0;

        foreach ($this->pas as $pa) {
            $total += ($pa->productPrice) ? $pa->getTotalAttribute() : 0;
        }

        return number_format($total, 2, '.', $f);
    }

    public function getTotalPurchase($f = '')
    {
        $total = 0;

        foreach ($this->movements as $movement) {
            $total += $movement->purchase_price * $movement->quantity;
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
        $rest = $this->getTotalOrder() - $this->getPaymentTotalAttribute();

        return number_format($rest, 2, '.', $f);
    }

    public function getPaymentTotalAttribute($f = '')
    {
        $total = $this->payments->sum('amount') - $this->payments->sum('change');

        return number_format($total, 2, '.', $f);
    }

    public function getExpensesTotalAttribute($f = '')
    {
        $total = 0;

        foreach ($this->payments as $payment) {
            if ($payment->amount < 0) {
                $total += $payment->amount;
            }
        }

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

    public function getTotalPurchaseFAttribute()
    {
        return $this->getTotalPurchase(',');
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

    public function getDeliveryDateFAttribute()
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $this->delivery_date);

        return $date->format('d-m-Y');
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

    public function warranties()
    {
        return $this->hasMany('microchip\warranty\Warranty');
    }
}
