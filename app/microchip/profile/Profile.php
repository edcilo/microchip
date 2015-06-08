<?php

namespace microchip\profile;

use Carbon\Carbon;
use microchip\base\BaseEntity;

class Profile extends BaseEntity
{
    protected $fillable = [
        'name',
        'f_last_name',
        's_last_name',
        'photo',
        'birthday',
        'sex',
        'phone',
        'cellphone',
        'email',
        'country',
        'state',
        'postcode',
        'city',
        'colony',
        'address',
        'marital_status',
        'wife',
        'reference_1',
        'reference_2',
        'reference_3',
        'ref_phone_1',
        'ref_phone_2',
        'ref_phone_3',
        'hired',
        'salary',
        'commission',
        'goal',
        'current',
        'fired',
        'reason',
        'observations',
        'user_id',
    ];

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->f_last_name.' '.$this->s_last_name;
    }

    public function getFullAddressAttribute()
    {
        $address = '';

        if ($this->address) {
            $address .= $this->address.', ';
        }
        if ($this->colony) {
            $address .= $this->colony.', ';
        }
        if ($this->postcode) {
            $address .= 'C.P.'.$this->postcode.';<br>';
        }
        if ($this->city) {
            $address .= $this->city.', ';
        }
        if ($this->state) {
            $address .= $this->state.', ';
        }
        if ($this->country) {
            $address .= $this->country.'.';
        }

        return $address;
    }

    public function getHiredFAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->hired);

        return $date->format('d-m-Y');
    }

    public function getSalaryFAttribute()
    {
        return number_format($this->salary, 2, '.', ',');
    }

    public function getGoalFAttribute()
    {
        return number_format($this->goal, 2, '.', ',');
    }

    public function getCurrentFAttribute()
    {
        return number_format($this->current, 2, '.', ',');
    }

    public function getCommissionFAttribute()
    {
        return number_format($this->commission, 2, '.', ',');
    }

    public function getBirthdayFAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->birthday);

        return $date->format('d-m-Y');
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }
}
