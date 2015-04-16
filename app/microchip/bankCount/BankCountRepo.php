<?php namespace microchip\bankCount;

use microchip\base\BaseRepo;

class BankCountRepo extends BaseRepo{

    public function getModel()
    {
        return new BankCount();
    }

    public function newBankCount()
    {
        return $count = new BankCount();
    }


    public function getByBank($bank_id, $col='id', $order='desc', $pagination = true)
    {
        $q = BankCount::where('bank_id', $bank_id)
            ->orderBy($col, $order);

        return ($pagination) ? $q->paginate() : $q->get();
    }

}