<?php

namespace microchip\sale;

use Carbon\Carbon;
use microchip\base\BaseRepo;

class SaleRepo extends BaseRepo
{
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

        return ($paginate) ? $q->paginate() : $q->get();
    }

    public function getByClassification($classification, $col = 'id', $order = 'asc', $request = '', $status = null)
    {
        $q = Sale::where('classification', $classification)
            ->where(function ($q) use ($status) {
                if ($status) {
                    $q->where('status', '!=', $status);
                }
            })
            ->orderby($col, $order);

        return ($request == 'ajax') ? $q->get() : $q->paginate();
    }

    public function getByClassificationStatus($classification, $status, $col = 'id', $order = 'ASC', $pagination = true)
    {
        $q = Sale::where('classification', $classification)
            ->where('status', $status)
            ->orderBy($col, $order);

        return ($pagination) ? $q->paginate() : $q->get();
    }

    public function getByStatus($status, $col = 'folio', $order = 'ASC')
    {
        return  Sale::where('status', $status)
            ->orderBy($col, $order)
            ->paginate();
    }

    public function search($terms, $type, $request = '', $take = 10)
    {
        $query = Sale::where('classification', $type)
            ->where(function ($query) use ($terms) {
                $query->orwhere('folio', 'like', "%$terms%")
                    ->orwhere('type', 'like', "%$terms%")
                    ->orwhere('status', 'like', "%$terms%");
            });

        return ($request == 'ajax') ? $query->take($take)->get() : $query->paginate();
    }

    public function getServiceOrder($status = '', $request = '')
    {
        $q = Sale::select('sales.*', 'service_datas.status as service_status')
            ->leftJoin('service_datas', 'sales.id', '=', 'service_datas.sale_id')
            ->where(function ($query) use ($status) {
                if ($status != '') {
                    $query->where('service_datas.status', $status);
                }

                $query->where('service_datas.status', '!=', 'Proceso');
            })
            ->where('classification', 'Servicio')
            ->where('sales.status', '!=', 'Cancelado')
            ->orderBy('delivery_date')
            ->orderBy('delivery_time');

        return ($request == 'ajax') ? $q->get() : $q->paginate();
    }

    public function getFolio($classification)
    {
        if ($classification == 'Venta') {
            $column = 'folio_sale';
        } elseif ($classification == 'Pedido') {
            $column = 'folio_separated';
        } elseif ($classification == 'Servicio') {
            $column = 'folio_service';
        } else {
            $column = 'folio_price';
        }

        $elements = Sale::where('classification', $classification)
            ->where($column, '!=', '')
            ->where(function ($query) use ($classification) {
                if ($classification == 'Venta') {
                    $query->where('sale', 1);
                } elseif ($classification == 'Pedido') {
                    $query->where('separated', 1);
                } elseif ($classification == 'Servicio') {
                    $query->where('service', 1);
                } elseif ($classification == 'Cotización') {
                    $query->where('price', 1);
                }
            })
            ->orderBy($column, 'asc')
            ->get();

        $c = 1;
        foreach ($elements as $element) {
            if ($element->folio != $c) {
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

    public function getPendingCancellations($paginate = true)
    {
        $q = Sale::where('status', 'Cancelado')->orderBy('updated_at', 'desc')
            ->where('repayment', 0);

        return ($paginate) ? $q->paginate() : $q->get();
    }

    public function getInRange($date_init, $date_end=null)
    {
        return Sale::where('classification', 'Venta')
            ->where('status', 'Pagado')
            ->where('updated_at', '>=', $date_init)
            ->where(function ($query) use ($date_end)
            {
                if (!empty($date_end)) {
                    $date_end = Carbon::createFromFormat('Y-m-d', $date_end)->addDay();
                    $query->where('updated_at', '<', $date_end);
                }
            })
            ->get();
    }

    public function getServicesInRange($date_init, $date_end=null)
    {
        return Sale::where('classification', 'Venta')
            ->where('service', 1)
            ->where('updated_at', '>=', $date_init)
            ->where(function ($query) use ($date_end)
            {
                if (!empty($date_end)) {
                    $date_end = Carbon::createFromFormat('Y-m-d', $date_end)->addDay();
                    $query->where('updated_at', '<', $date_end);
                }
            })
            ->get();
    }

    public function getDataChart($n_month)
    {
        $months         = [];
        $data_sale      = [];
        $data_purchase  = [];
        $data_utility   = [];
        $today          = Carbon::today();

        for ($i = $n_month; $i >= 0; $i--) {
            $thisMonth = Carbon::createFromFormat('Y-m-d', $today->format('Y-m-') . '01');
            $month = $thisMonth->subMonths($i);
            $months[] = trans('lists.months.'.$month->format('F'));

            $sales = Sale::where('status', 'Pagado')
                ->where('created_at', '>=', $month->format('Y-m-d'))
                ->where('created_at', '<', $month->addMonth()->format('Y-m-d'))
                ->get();

            $total_purchase = 0;
            $total_sale = 0;
            foreach ($sales as $sale) {
                $total_purchase += $sale->getTotalPurchase();
                $total_sale     += $sale->getTotalAttribute();
            }

            $data_sale[]        = $total_sale;
            $data_purchase[]    = $total_purchase;
            $data_utility[]     = $total_sale - $total_purchase;
        }

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Total de ventas',
                    'fillColor' => "rgba(184,225,174,.4)",
                    'strokeColor' => "rgb(83,169,63)",
                    'pointColor' => "rgba(184,225,174,1)",
                    'pointStrokeColor' => "#fff",
                    'pointHighlightFill' => "rgb(83,169,63)",
                    'pointHighlightStroke' => "rgba(184,225,174,1)",
                    'data' => $data_sale,
                ],
                [
                    'label' => 'Total de compras',
                    'fillColor' => "rgba(215,15,11,.4)",
                    'strokeColor' => "rgb(215,15,11)",
                    'pointColor' => "rgba(215,15,11, .4)",
                    'pointStrokeColor' => "#fff",
                    'pointHighlightFill' => "rgb(215,15,11)",
                    'pointHighlightStroke' => "rgba(215,15,11, .4)",
                    'data' => $data_purchase,
                ],
                [
                    'label' => 'Total de utilidades',
                    'fillColor' => "rgba(48,150,218,.4)",
                    'strokeColor' => "rgb(48,150,218)",
                    'pointColor' => "rgba(48,150,218,.4)",
                    'pointStrokeColor' => "#fff",
                    'pointHighlightFill' => "rgb(48,150,218)",
                    'pointHighlightStroke' => "rgba(48,150,218,.4)",
                    'data' => $data_utility,
                ]
            ]
        ];
    }
}
