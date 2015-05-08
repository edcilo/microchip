<?php

namespace microchip\warranty;

use microchip\base\BaseEntity;

class Warranty extends BaseEntity
{
    protected $fillable = [
        'status',
        'description',
        'sent_at',
        'series_id',
        'sale_id',
        'purchase_id',
        'created_by',
        'sent_by',
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
}
