<?php

namespace microchip\bank;

use microchip\base\BaseEntity;

class Bank extends BaseEntity
{
    protected $fillable = [
        'name',
        'number_account',
        'branch',
        'clabe',
        'executive_name',
        'active',
        'phone',
        'country',
        'state',
        'city',
        'postcode',
        'colony',
        'address',
        'terminal',
        'commission_debit',
        'commission_credit',
        'slug',
    ];

    public function cheques()
    {
        return $this->hasMany('microchip\cheque\Cheque');
    }

    public function bankCount()
    {
        return $this->hasMany('microchip\bankCount\BankCount');
    }

    // Atributos
    public function getTerminalIAttribute()
    {
        return ($this->terminal) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
    }

    public function getCommissionDebitFAttribute()
    {
        return number_format($this->commission_debit, 2);
    }

    public function getCommissionCreditFAttribute()
    {
        return number_format($this->commission_credit, 2);
    }

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->bankCount as $count) {
            if ($count->status == 'Salida') {
                $count->amount *= -1;
            }

            $total += $count->amount;
        }

        return number_format($total, 2, '.', ',');
    }
}
