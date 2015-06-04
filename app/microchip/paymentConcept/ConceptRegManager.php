<?php

namespace microchip\paymentConcept;

use microchip\base\BaseManager;

class ConceptRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'concept'   => 'required',
            'spending'  => 'boolean',
            //'document'  => 'in:,Venta,Pedido,Servicio',
        ];
    }

    public function prepareData($data)
    {
        if (!isset($data['spending'])) {
            $data['spending'] = 0;
        }

        return $data;
    }
}