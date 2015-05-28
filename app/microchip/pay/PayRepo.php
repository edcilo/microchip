<?php

namespace microchip\pay;

use Carbon\Carbon;
use microchip\base\BaseRepo;

class PayRepo extends BaseRepo
{
    public function getModel()
    {
        return new Pay();
    }

    public function newPay()
    {
        return $pay = new Pay();
    }

    public function getByMethod($method)
    {
        return Pay::where('method', $method)
            ->orderBy('created_at')
            ->get();
    }

    public function getCreditCard()
    {
        return Pay::where('method', 'Tarjeta de crédito/débito')
            ->get();
    }

    public function getPending()
    {
        return Pay::where('change_check', 1)->paginate();
    }

    public function getCajaAnetrior($date=null)
    {
        $total = 0;

        if (is_null($date)) {
            $date = date('Y-m-d');
        }

        $rows = Pay::where('date', '<', $date)->get();

        foreach ($rows as $col) {
            $total += $col->amount - $col->change;
        }

        return $total;
    }

    public function getTotalByMethod($pays, $method)
    {
        $total = 0;

        foreach ($pays as $pay) {
            if ($pay->method == $method AND $pay->amount > 0) {
                $total += $pay->amount - $pay->change;
            }
        }

        return $total;
    }

    public function getInRange($date_init = null, $date_end = null)
    {
        return Pay::where('date', '>=', $date_init)
            ->where(function ($query) use ($date_end)
            {
                if (!is_null($date_end)) {
                    $query->where('date', '<=', $date_end);
                }
            })
            ->get();
    }

    public function getTotalInRange($date_init = null, $date_end = null, $sign=null)
    {
        $total = 0;

        if (is_null($date_init)) {
            $date_init = date('Y-m-d');
        }

        $rows = Pay::where('date', '>=', $date_init)
            ->where(function ($query) use ($date_end)
            {
                if (!is_null($date_end)) {
                    $query->where('date', '<=', $date_end);
                }
            })
            ->get();

        foreach ($rows as $col) {
            if ($sign == null) {
                $total += $col->amount - $col->change;
            } elseif ($sign == '+') {
                if ($col->amount > 0) {
                    $total += $col->amount - $col->change;
                }
            } else {
                if ($col->amount < 0) {
                    $total += $col->amount - $col->change;
                }
            }
        }

        return $total;
    }

    public function getTotalByType($date_init = null, $date_end = null, $type=null, $status=null, $method=null)
    {
        $total = 0;

        if (is_null($date_init)) {
            $date_init = date('Y-m-d');
        }

        $rows = Pay::where('date', '>=', $date_init)
            ->where(function ($query) use ($date_end)
            {
                if (!is_null($date_end)) {
                    $query->where('date', '<=', $date_end);
                }
            })
            ->get();

        foreach ($rows as $col) {
            if ($col->sale) {
                if (
                    (is_null($method) OR $col->method == $method)
                    AND
                    (is_null($type) OR $col->sale->type == $type)
                    AND
                    (is_null($status) OR $col->sale->status == $status)
                ) {
                    $total += $col->amount - $col->change;
                }
            }
        }

        return $total;
    }

    public function getReportByUser($date_init, $date_end = null)
    {
        return Pay::where('date', '>=', $date_init)
            ->where(function ($query) use ($date_end)
            {
                if (!is_null($date_end)) {
                    $query->where('date', '<=', $date_end);
                }
            })
            ->groupBy('user_id')
            ->get();
    }
}
