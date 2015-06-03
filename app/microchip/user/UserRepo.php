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

    public function getPaysByRange($date_init, $date_end = null)
    {
        return User::with(['pays' => function ($query) use ($date_init, $date_end) {
            $query->with('sale')
                ->where('date', '>=', $date_init)
                ->where(function ($query) use ($date_end)
                {
                    if (!is_null($date_end)) {
                        $query->where('date', '<=', $date_end);
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
                    'fillColor' => "rgba(184,225,174,.4as )",
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
