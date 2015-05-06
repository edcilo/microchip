<?php

namespace microchip\series;

use microchip\base\BaseManager;

class SeriesUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'ns'        => 'required|unique:series,ns',
            'generate'  => 'required|boolean',
            'status'    => 'required|in:Disponible,Vendido,Garantía,Baja,Apartado',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['product_id']             = $this->entity->product_id;
        $data['inventory_movement_id']  = $this->entity->inventory_movement_id;

        return $data;
    }
}
