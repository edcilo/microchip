<?php namespace microchip\sale;

use microchip\base\BaseManager;

class SaleTotalUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'new_price'	=> 'required|numeric|min:'.$this->entity->getTotalAttribute()
        ];
    }

    public function prepareData($data)
    {
        unset($this->entity->folio);
        unset($this->entity->subtotal);
        unset($this->entity->subtotal_f);
        unset($this->entity->total);
        unset($this->entity->total_f);
        unset($this->entity->total_text);
        unset($this->entity->difference);
        unset($this->entity->difference_f);
        unset($this->entity->pv_di);
        unset($this->entity->pv_di_f);

        return $data;
    }

}