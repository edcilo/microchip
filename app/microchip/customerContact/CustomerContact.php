<?php namespace microchip\customerContact;

use microchip\base\BaseEntity;

class CustomerContact extends BaseEntity {

	protected $fillable = [
		'customer_id',
		'contact_id',
	];

	public function dataCustomer()
	{
		return $this->belongsTo('microchip\customer\Customer', 'customer_id', 'id');
	}

	public function dataContact()
	{
		return $this->belongsTo('microchip\customer\Customer', 'contact_id', 'id');
	}

}