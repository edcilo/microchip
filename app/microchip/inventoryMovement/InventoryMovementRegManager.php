<?php namespace microchip\inventoryMovement;

use microchip\base\BaseManager;

class InventoryMovementRegManager extends BaseManager {

    public function getRules()
    {
        $movementRepo   = new InventoryMovementRepo();
        $total          = $movementRepo->totalStock(\Input::get('product_id'));

        $rules = [
            'product_id'     => 'required|exists:products,id',
            'quantity'       => 'required|integer',
            'status'         => 'required|in:in,out',
            'purchase_price' => 'numeric|required_if:status,in',
            'selling_price'  => 'numeric|required_if:status,out',
            'description'    => 'required|max:255',
        ];

        if ( \Input::get('status') == 'out' )
        {
            $rules['quantity'] .= '|max:' . $total;
        }

        return $rules;
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        if ( $data['status'] == 'out' )
        {
            $data['in_stock']       = 0;
        }
        else
        {
            $data['in_stock']       = $data['quantity'];
            $data['selling_price']  = 0;
        }


        return $data;
    }

}