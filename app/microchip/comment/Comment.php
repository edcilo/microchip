<?php namespace microchip\comment;

use microchip\base\BaseEntity;

class Comment extends BaseEntity {

	protected $fillable = [
        'comment',
        'print',
        'sale_id',
        'user_id',
    ];


    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }

}