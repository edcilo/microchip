<?php

namespace microchip\support;

use microchip\base\BaseEntity;

class Support extends BaseEntity {
    protected $table = 'support';

	protected $fillable = [
        'product_id',
        'authorized_by',
        'given_by',
        'received_by',
        'status',
        'observations',
    ];

    public function product()
    {
        return $this->belongsTo('microchip\product\Product');
    }

    public function movements()
    {
        return $this->belongsToMany('microchip\inventoryMovement\InventoryMovement', 'support_movements', 'support_id', 'movement_id');
    }

    public function pay()
    {
        return $this->belongsTo('microchip\pay\Pay');
    }

    public function authorizedBy()
    {
        return $this->belongsTo('microchip\user\User', 'authorized_by');
    }

    public function givenBy()
    {
        return $this->belongsTo('microchip\user\User', 'given_by');
    }

    public function receivedBy()
    {
        return $this->belongsTo('microchip\user\User', 'received_by');
    }
}