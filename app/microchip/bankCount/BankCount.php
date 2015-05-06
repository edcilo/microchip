<?php

namespace microchip\bankCount;

use microchip\base\BaseEntity;

class BankCount extends BaseEntity
{
    protected $fillable = [
        'amount',
        'status',
        'description',
        'date',
        'bank_id',
    ];

    public function getDateFAttribute()
    {
        return date('d-m-Y', time($this->date));
    }

    public function bank()
    {
        return $this->belongsTo('microchip\bank\Bank');
    }

    public function cheque()
    {
        return $this->hasOne('microchip\cheque\Cheque');
    }
}
