<?php namespace microchip\customerReferral;

use microchip\base\BaseEntity;

class CustomerReferral extends BaseEntity {

	protected $fillable = [
		'customer_id',   // usuario quien recomienda
		'referred_id',   // usuario a quien recomendo
		'observations',
		'expiration',
	];

	public function customer()
	{
		return $this->belongsTo('microchip\customer\Customer', 'customer_id', 'id');
	}

	public function referenced()
	{
		return $this->belongsTo('microchip\customer\Customer', 'referred_id', 'id');
	}




    // atributos
    public function getExpirationDateAttribute()
    {
        $date = date('Y-m-d', strtotime($this->updated_at));
        return $this->getDateExpire($date, $this->expiration);
    }




    public function getDateExpire($startdatum, $number)
    {
        $exp    = new \DateTime( $startdatum );
        $exp->add(new \DateInterval('P'.$number.'D'));

        $expiration_date = ( $number == 0 ) ? 'Indefinido' : $exp->format('d-m-Y');

        if ( strtotime( $expiration_date ) < strtotime(date('d-m-Y')) AND $expiration_date !== 'Indefinido' )
        {
            $expiration_date = 'Vencido';
        }

        return $expiration_date;
    }

}