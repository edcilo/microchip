<?php

namespace microchip\cheque;

use microchip\base\BaseEntity;

class Cheque extends BaseEntity
{
    public function getFillable()
    {
        return $this->fillable;
    }

    protected $fillable = [
        'folio',
        'payment_date',
        'amount',
        'receiver',
        'concept',
        'status',
        'active',
        'message',
        'observations',
        'bank_id',
        'bank_count_id',
    ];

    public function getPaymentDateFAttribute()
    {
        return date('d-m-Y', time($this->payment_date));
    }

    public function payment()
    {
        return $this->hasOne('microchip\purchasePayment\PurchasePayment');
    }

    public function bank()
    {
        return $this->belongsTo('microchip\bank\Bank');
    }

    public function bankCount()
    {
        return $this->belongsTo('microchip\bankCount\BankCount');
    }
}
