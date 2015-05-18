<?php

namespace microchip\warranty;

use microchip\base\BaseEntity;

class Warranty extends BaseEntity
{
    protected $fillable = [
        'status',
        'former_status',
        'description',
        'observations',
        'sent_at',
        'series_id',
        'sale_id',
        'service_id',
        'purchase_id',
        'created_by',
        'sent_by',
        'movement_out',
        'movement_in',
        'solutions',
    ];

    public function getFolioAttribute()
    {
        return str_pad($this->id, 8, '0', STR_PAD_LEFT);
    }

    public function series()
    {
        return $this->belongsTo('microchip\series\Series');
    }

    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }

    public function service()
    {
        return $this->belongsTo('microchip\sale\Sale', 'service_id');
    }

    public function purchase()
    {
        return $this->belongsTo('microchip\purchase\Purchase');
    }

    public function createdBy()
    {
        return $this->belongsTo('microchip\user\User', 'created_by');
    }

    public function sentBy()
    {
        return $this->belongsTo('microchip\user\User', 'sent_by');
    }

    public function movementOut()
    {
        return $this->belongsTo('microchip\inventoryMovement\InventoryMovement', 'movement_out');
    }

    public function movementIn()
    {
        return $this->belongsTo('microchip\inventoryMovement\InventoryMovement', 'movement_in');
    }

    public function coupon()
    {
        return $this->hasOne('microchip\couponPurchase\CouponPurchase');
    }
}
