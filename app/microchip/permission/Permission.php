<?php

namespace microchip\permission;

use microchip\base\BaseEntity;

class Permission extends BaseEntity
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany('microchip\user\User');
    }
}
