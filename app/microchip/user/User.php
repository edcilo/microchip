<?php

namespace microchip\user;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use microchip\base\BaseEntity;

class User extends BaseEntity implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    protected $fillable = [
        'username',
        'password',
        'remember_token',
        'slug',
        'active',
        'department_id',
    ];

    public function getPermissionsArrayAttribute()
    {
        $per = [];

        foreach ($this->permissions as $permission) {
            $per[] = $permission->id;
        }

        return $per;
    }

    public function getCommissionTFAttribute($f = ',')
    {
        $t = 0;

        if ($this->profile->current >= $this->profile->goal) {
            $t = ($this->profile->current - $this->profile->goal) / 100 * $this->profile->commission;
        }

        return number_format($t, 2, '.', $f);
    }

    public function getSalaryTFAttribute($f = ',')
    {
        $t = $this->profile->salary + $this->getCommissionTFAttribute('');

        return number_format($t, 2, '.', $f);
    }

    public function profile()
    {
        return $this->hasOne('microchip\profile\Profile');
    }

    public function purchases()
    {
        return $this->hasMany('microchip\purchase\Purchase');
    }

    public function sales()
    {
        return $this->hasMany('microchip\sale\Sale');
    }

    public function coupons()
    {
        return $this->hasMany('microchip\coupon\Coupon');
    }

    public function department()
    {
        return $this->belongsTo('microchip\department\Department');
    }

    public function permissions()
    {
        return $this->belongsToMany('microchip\permission\Permission');
    }

    public function pays()
    {
        return $this->hasMany('microchip\pay\Pay');
    }
}
