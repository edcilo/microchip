<?php namespace microchip\mark;

use microchip\base\BaseEntity;

class Mark extends BaseEntity {

	protected $fillable = [
		'name',
		'image',
		'description',
		'slug',
	];

	public function products()
	{
		return $this->hasMany('microchip\productDescription\ProductDescription');
	}

}