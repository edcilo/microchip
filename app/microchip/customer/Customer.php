<?php

namespace microchip\customer;

use microchip\base\BaseEntity;

class Customer extends BaseEntity
{
    protected $fillable = [
        'prefix',
        'name',
        'country',
        'state',
        'city',
        'postcode',
        'colony',
        'address',
        'shipping_address',
        'birthday',
        'phone',
        'cellphone',
        'email',
        'rfc',
        'credit_limit',
        'credit_days',
        'classification',
        'legal_concept',
        'card_id',
        'points',
        'expiration',
        'card_active',
        'slug',
        'active',
    ];

    // quien invito
    public function referrer()
    {
        return $this->hasOne('microchip\customerReferral\CustomerReferral', 'referred_id', 'id');
    }

    public function isContact()
    {
        return $this->hasOne('microchip\customerContact\CustomerContact', 'contact_id', 'id');
    }

    // invitados
    public function referenced()
    {
        return $this->hasMany('microchip\customerReferral\CustomerReferral', 'customer_id', 'id');
    }

    public function contacts()
    {
        return $this->hasMany('microchip\customerContact\CustomerContact', 'customer_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany('microchip\sale\Sale');
    }

    public function coupons()
    {
        return $this->hasMany('microchip\coupon\Coupon');
    }

    // Atributos
    public function getExpirationDateAttribute()
    {
        return $this->getDateExpire($this->card_active, $this->expiration);
    }

    public function getDateExpire($startdatum, $number)
    {
        $exp = new \DateTime($startdatum);
        $exp->add(new \DateInterval('P'.$number.'D'));

        $expiration_date = ($number == 0) ? 'Indefinido' : $exp->format('d-m-Y');

        if (strtotime($expiration_date) < strtotime(date('d-m-Y')) and $expiration_date !== 'Indefinido') {
            $expiration_date = 'Vencido';
        }

        return $expiration_date;
    }
}
