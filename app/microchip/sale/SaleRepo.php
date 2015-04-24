<?php namespace microchip\sale;

use microchip\base\BaseRepo;

class SaleRepo extends BaseRepo {

    public function getModel()
    {
        return new Sale();
    }

    public function newSale()
    {
        return $sale = new Sale();
    }

    public function getDocument($classification, $folio)
    {
        return Sale::where('classification', $classification)->where('folio', $folio)->first();
    }

    public function getByUser($user_id, $paginate = true)
    {
        $q = Sale::where('user_id', $user_id)
            ->orderBy('created_at', 'DESC');

        return ( $paginate ) ? $q->paginate() : $q->get();
    }

    public function getByClassification($classification, $col='id', $order='asc', $request='', $status = null)
    {
        $q = Sale::where('classification', $classification)
            ->where(function ($q) use ($status) {
                if ( $status ) {
                    $q->where('status', '!=', $status);
                }
            })
            ->orderby($col, $order);

        return ( $request == 'ajax' ) ? $q->get() : $q->paginate();
    }

    public function getByClassificationStatus($classification, $status, $col='id', $order='ASC', $pagination = true)
    {
        $q = Sale::where('classification', $classification)
            ->where('status', $status)
            ->orderBy($col, $order);

        return ( $pagination ) ? $q->paginate() : $q->get();
    }

    public function search($terms, $type, $request='', $take=10)
    {
        $query = Sale::where('classification', $type)
            ->where(function ($query) use ($terms)
            {
                $query->orwhere('folio', 'like', "%$terms%")
                    ->orwhere('type', 'like', "%$terms%")
                    ->orwhere('status', 'like', "%$terms%");
            });

        return ( $request == 'ajax' ) ? $query->take($take)->get() : $query->paginate();
    }

    public function getServiceOrder($status = '', $request = '')
    {
        $q = Sale::select('sales.*', 'service_datas.status as service_status')
            ->leftJoin('service_datas', 'sales.id', '=', 'service_datas.sale_id')
            ->where(function ($query) use ($status){
                if($status != '')
                {
                    $query->where('service_datas.status', $status);
                }

                $query->where('service_datas.status', '!=', 'Proceso');
            })
            ->where('classification', 'Servicio')
            ->where('sales.status', '!=', 'Cancelado')
            ->orderBy('delivery_date')
            ->orderBy('delivery_time');

        return ( $request == 'ajax' ) ? $q->get() : $q->paginate();
    }

    public function getFolio($classification)
    {
        $elements= Sale::where('classification', $classification)
            ->where('folio', '!=', '')
            ->where(function ($query) use ($classification) {
                if( $classification == 'Venta' )
                {
                    $query->where('sale', 1);
                }
                elseif( $classification == 'Pedido' )
                {
                    $query->where('separated', 1);
                }
                elseif( $classification == 'Servicio' )
                {
                    $query->where('service', 1);
                }
                elseif( $classification == 'Cotización' )
                {
                    $query->where('price', 1);
                }
            })
            ->orderBy('folio', 'asc')
            ->get();

        $c = 1;
        foreach($elements as $element)
        {
            if( $element->folio != $c )
            {
                return $c;
            }

            $c++;
        }

        return $c;
    }

    public function getCancellations($paginate = true)
    {
        $q = Sale::where('status', 'Cancelado')->orderBy('updated_at', 'desc');

        return ($paginate) ? $q->paginate() : $q->get();
    }

}