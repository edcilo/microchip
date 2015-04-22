<?php namespace microchip\pay;

use microchip\base\BaseEntity;

class Pay extends BaseEntity {

	protected $fillable = [
        'amount',
        'change',
        'pending',
        'description',
        'method',
        'reference',
        'entity',
        'change_check',
        'user_receiving_id',
        'date',
        'sale_id',
        'user_id',
    ];


    public function getClassRowAttribute()
    {
        return ($this->amount < 0) ? 'red' : '';
    }

    public function getDateFAttribute()
    {
        return date('d-m-Y', time($this->date));
    }


    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }

    public function userReceiving()
    {
        return $this->belongsTo('microchip\user\User', 'user_receiving_id', 'id');
    }

}