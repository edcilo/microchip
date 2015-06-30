<?php

namespace microchip\purchase;

use microchip\base\BaseManager;

class PurchaseUplUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'bill_scan' => 'required|mimes:pdf,zip,rar',
        ];
    }

    public function prepareData($data)
    {
        $path               = 'images/purchases';
        $path_image         = $this->saveFile(\Input::file('bill_scan'), $path, false, $this->entity->id.$this->entity->folio, false, true, $this->entity->bill_scan);
        $data['bill_scan']  = ($path_image) ? $path_image : $this->entity->bill_scan;

        $data['progress_2'] = ($data['bill_scan'] == '') ? 0 : 1;

        return $data;
    }
}
