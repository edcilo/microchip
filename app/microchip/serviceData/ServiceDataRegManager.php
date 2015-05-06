<?php

namespace microchip\serviceData;

use microchip\base\BaseManager;

class ServiceDataRegManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'observations'  => 'required',
            'equipment'     => 'required',
            'mark'          => 'required',
            'model'         => 'required',
            'series'        => 'required',
            'details'       => 'required',
            'internal'      => '',
            'sale_id'       => 'required|exists:sales,id',
        ];

        if (trim($this->data['warranty_id']) != 0) {
            $rules['warranty_id'] = 'exists:sales,id';
        }

        return $rules;
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['status'] = 'Pendiente';

        return $data;
    }
}
