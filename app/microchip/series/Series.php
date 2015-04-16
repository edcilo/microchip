<?php namespace microchip\series;

class Series extends \Eloquent {

	protected $fillable = [
		'ns',
		'status',
		'generate',
		'date_warranty',
		'movement_out',
        'separated_id',
		'product_id',
		'inventory_movement_id',
	];

	protected $perPage = 10;


	public function product()
	{
		return $this->belongsTo('microchip\product\Product');
	}

    public function separated()
    {
        return $this->belongsTo('microchip\orderProduct\OrderProduct', 'separated_id', 'id');
    }

	public function movement()
	{
		return $this->belongsTo('microchip\inventoryMovement\InventoryMovement', 'inventory_movement_id', 'id');
	}

	public function movement_out()
	{
		return $this->belongsTo('microchip\inventoryMovement\InventoryMovement', 'movement_out', 'id');
	}

    public function separate()
    {
        return $this->belongsTo('microchip\orderProduct\OrderProduct', 'separated_id', 'id');
    }

}