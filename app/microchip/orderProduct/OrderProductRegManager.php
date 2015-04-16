<?php namespace microchip\orderProduct;

use microchip\base\BaseManager;
use microchip\product\ProductRepo;
use microchip\sale\SaleRepo;

class OrderProductRegManager extends  BaseManager {

    public function getRules()
    {
        $iva    = 0;

        $rules  = [
            'quantity'              => 'required|integer|min:1|max:' . $this->data['pa_quantity'],
            'selling_price'         => 'required|numeric',
            'pending_movement_id'   => 'required|exists:pending_movements,id',
            'sale_id'               => 'required|exists:sales,id',
            'product_id'            => 'required|exists:products,id'
        ];

        if(!empty($this->data['sale_id']))
        {
            $sale                   = new SaleRepo();
            $sale                   = $sale->find($this->data['sale_id']);
            if(!is_null($sale))
            {
                $iva = $sale->iva;
            }
        }

        if(!empty($this->data['product_id']))
        {
            $product                = new ProductRepo();
            $product                = $product->find($this->data['product_id']);
            if(!is_null($product))
            {
                if($product->type == 'Producto')
                    $rules['quantity']   .= '|max:' . $product->stock;

                $rules['selling_price'] .= '|min:' . $product->price_5 * ($iva / 100 + 1);
            }
        }

        return $rules;
    }

    public function prepareData($data)
    {
        $data['user_id'] = 0;
        $data['admin_id'] = 0;
        $data['support_id'] = 0;

        return $data;
    }

}