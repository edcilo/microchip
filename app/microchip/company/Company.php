<?php namespace microchip\company;

use microchip\base\BaseEntity;

class Company extends BaseEntity {

	protected $fillable = [
		'id',
		'name',
		'owner',
		'rfc',
		'photo',
		'state',
		'city',
		'colony',
		'address',
		'phone_1',
		'phone_2',
		'phone_3',
		'email',
		'web',
		'services',
		'schedule',
		'note',
	];

}