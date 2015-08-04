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

    public function getLast()
    {
        return Pay::orderBy('id', 'desc')->first();
    }

    public function getPending()
    {
        return Pay::where('change_check', 1)->paginate();
    }

    public function getCajaAnetrior($date=null, $time=null)
    {
        $total = 0;

        if (is_null($date)) {
            $date = date('Y-m-d');
        }

        if (is_null($time)) {
            $time = '00:00:01';
        }
        $datetime = $date . ' ' . $time;

        $rows = Pay::where('created_at', '<', $datetime)->where('method', 'Efectivo')->get();

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

    public function getInRange($date_init = null, $time_init = null, $date_end = null, $time_end = null)
    {
        if (is_null($date_init)) {
            $date_init = date('Y-m-d');
        }
        $datetime_init = $date_init . ' ' . $time_init;

        $datetime_end = null;
        if (!empty($date_end)) {
            if (empty($time_end)) {
                $datetime_end  = Carbon::createFromFormat('Y-m-d', $date_end);
                $datetime_end  = $datetime_end->addDay()->format('Y-m-d');
            } else {
                $datetime_end  = $date_end  . ' ' . $time_end;
            }
        }

        return Pay::where('date', '>', $datetime_init)
            ->where(function ($query) use ($datetime_end)
            {
                if (!empty(trim($datetime_end))) {
                    $query->where('date', '<', $datetime_end);
                }
            })
            ->get();
    }

    public function getTotalInRange($date_init = null, $time_init = null, $date_end = null, $time_end = null, $sign=null)
    {
        $total = 0;

        if (is_null($date_init)) {
            $date_init = date('Y-m-d');
        }
        $datetime_init = $date_init . ' ' . $time_init;

        $datetime_end = null;
        if (!empty($date_end)) {
            if (empty($time_end)) {
                $datetime_end  = Carbon::createFromFormat('Y-m-d', $date_end);
                $datetime_end  = $datetime_end->addDay()->format('Y-m-d');
            } else {
                $datetime_end  = $date_end  . ' ' . $time_end;
            }
        }

        $rows = Pay::where('date', '>=', $datetime_init)
            ->where(function ($query) use ($datetime_end)
            {
                if (!empty(trim($datetime_end))) {
                    $query->where('date', '<', $datetime_end);
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
