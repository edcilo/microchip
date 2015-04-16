<?php namespace microchip\cheque;

use microchip\base\BaseRepo;

class ChequeRepo extends BaseRepo {

    public function getModel()
    {
        return new Cheque();
    }

    public function newCheque()
    {
        return $cheque = new Cheque();
    }

    public function getListAvailable()
    {
        $elements = Cheque::select('folio', 'id')
            ->where('active', 1)
            ->where('status', 'Elaborado')
            ->orwhere('status', 'Post-fechado')
            ->get();

        $list = [];

        foreach($elements as $element)
        {
            $list[$element->id] = $element->folio;
        }

        return $list;
    }

    public function getByBank($bank_id, $col_order, $method_order, $active=1, $request='', $take=10)
    {
        $q = Cheque::where('bank_id', $bank_id)
            ->where('active', $active)
            ->orderby($col_order, $method_order);

        return ( $request == 'ajax' ) ? $q->take($take)->get() : $q->paginate();
    }

    public function filter($conditions, $order='ASC')
    {
        return Cheque::where(
            function ($query) use ($conditions) {
                foreach ( $conditions as $key => $value )
                {
                    if ( $key == 'date_start' AND $value != NULL )
                    {
                        $query->where('payment_date', '>=', $value)
                            ->where('payment_date', '!=', '');
                    }
                    elseif ( $key == 'date_end' AND $value != NULL )
                    {
                        $query->where('payment_date', '<=', $value)
                            ->where('payment_date', '>', '0000-00-00');
                    }
                    else
                    {
                        if ($value !== 0 && $value !== '' && $value !== '0')
                        {
                            $query->where($key, $value);
                        }
                    }
                }
            } )
            ->where('active', 1)
            ->orderby('id', $order)
            ->paginate();
    }

}