<?php

namespace microchip\purchasePayment;

use microchip\base\BaseEntity;

class PurchasePayment extends BaseEntity
{
    protected $fillable = [
        'purchase_id',
        'cheque_id',
        'method',
        'type',
        'payment_date',
        'status',
    ];

    public function bill()
    {
        return $this->belongsTo('microchip\purchase\Purchase');
    }

    public function cheque()
    {
        return $this->belongsTo('microchip\cheque\Cheque');
    }
}
