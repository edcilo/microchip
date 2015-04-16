<?php namespace microchip\department;

use microchip\base\BaseEntity;

class Department extends BaseEntity {

	protected $fillable = [
		'name',
		'description',
		'slug'
	];



	public function users()
	{
		return $this->hasMany('microchip\user\User');
	}

}