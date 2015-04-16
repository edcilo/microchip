<?php namespace microchip\purchase;

use microchip\base\BaseEntity;

class Purchase extends BaseEntity {

	protected $fillable = [
		'folio',
		'status',
		'date',
		'reception_date',
		'iva',
		'bill_scan',
		'progress_1',
		'progress_2',
		'progress_3',
		'progress_4',
		'provider_id',
		'user_id',
	];

    public function getSubtotalFAttribute($f = '')
    {
        $total = 0;

        foreach($this->movements as $movement)
        {
            $total += $movement->getTotalPurchaseWithoutIvaAttribute();
        }

        return number_format($total, 2, '.', $f);
    }

    public function getTotalAttribute($f = '')
    {
        $total = 0;

        foreach($this->movements as $movement)
        {
            $total += $movement->purchase_price * $movement->quantity * (($this->iva/100) + 1);
        }

        return number_format($total, 2, '.', $f);
    }



	public function payment()
	{
		return $this->hasOne('microchip\purchasePayment\PurchasePayment');
	}



	public function provider()
	{
		return $this->belongsTo('microchip\provider\Provider');
	}

	public function user()
	{
		return $this->belongsTo('microchip\user\User');
	}



	public function movements()
	{
		return $this->belongsToMany('microchip\inventoryMovement\InventoryMovement');
	}

}