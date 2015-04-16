<?php namespace microchip\configuration;

use microchip\base\BaseEntity;

class Configuration extends BaseEntity {

	protected $fillable = [
		'iva',
		'dollar'
	];

}