<?php

namespace microchip\user;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use microchip\base\BaseRepo;

class UserRepo extends BaseRepo
{
    public function getModel()
    {
        return new User();
    }

    public function newUser()
    {
        return $user = new User();
    }

    public function checkPassword($password)
    {
        $users = User::all();

        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                return true;
            }
        }

        return false;
    }

    public function getUserByPassword($password)
    {
        $users = User::all();

        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                return $user;
            }
        }

        return false;
    }

    public function getPaysByRange($date_init = null, $time_init = null, $date_end = null, $time_end = null)
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

        return User::with(['pays' => function ($query) use ($datetime_init, $datetime_end) {
            $query->with('sale')
                ->where('date', '>', $datetime_init)
                ->where(function ($query) use ($datetime_end)
                {
                    if (!is_null($datetime_end)) {
                        $query->where('date', '<', $datetime_end);
                    }
                });
        }])->get();
    }

    public function getDataChart($user_id, $n_month=6)
    {
        $months = [];
        $data   = [];
        $today  = Carbon::today();
        $user   = User::find($user_id);

        for ($i = $n_month; $i >= 0; $i--) {
            $thisMonth = Carbon::createFromFormat('Y-m-d', $today->format('Y-m-') . '01');
            $month = $thisMonth->subMonths($i);
            $months[] = trans('lists.months.'.$month->format('F'));

            $sales = $user->sales()
                        ->where('status', 'Pagado')
                        ->where('created_at', '>=', $month->format('Y-m-d'))
                        ->where('created_at', '<', $month->addMonth()->format('Y-m-d'))
                        ->get();
            $total = 0;
            foreach ($sales as $sale) {
                $total += $sale->total;
            }
            $data[] = $total;
        }

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Ventas',
                    'fillColor' => "rgba(184,225,174,.4)",
                    'strokeColor' => "rgb(83,169,63)",
                    'pointColor' => "rgba(184,225,174,1)",
                    'pointStrokeColor' => "#fff",
                    'pointHighlightFill' => "rgb(83,169,63)",
                    'pointHighlightStroke' => "rgba(184,225,174,1)",
                    'data' => $data,
                ]
            ]
        ];
    }
}
