<?php namespace microchip\bankCount;

use microchip\base\BaseManager;

class BankCountUpdManager extends BaseManager{

    public function getRules()
    {
        return [
            'amount'        => 'required|numeric',
            'status'        => 'required|in:Entrada,Salida',
            'date'          => 'required|date',
            'description'   => 'max:255'
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['bank_id']    = $this->entity->bank_id;

        return $data;
    }

}