<?php namespace microchip\sale;

use microchip\base\BaseManager;

class SaleUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'customer_id'       => 'required|exists:customers,id',
            'type'              => 'required|in:Factura,Ticket',
            'description'       => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['status']             = 'Emitido';
        $data['user_id']            = $this->entity->user_id;
        $data['classification']     = $this->entity->classification;

        return $data;
    }

}