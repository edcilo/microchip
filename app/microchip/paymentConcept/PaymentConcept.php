<?php

namespace microchip\paymentConcept;

use microchip\base\BaseEntity;

class PaymentConcept extends BaseEntity {

	protected $fillable = [
        'concept',
        'spending',
        'document',
    ];
}