<?php

namespace microchip\product;

class ProductFormat
{
    protected $iva;

    public function formatData(&$product, $iva)
    {
        $this->iva = $iva;

        $this->getPriceWithIva($product);

        $product->r_type    = ($product->type == 'Servicio') ? 'service' : 'product';

        $product->web       = $this->checkOrFail($product->web);
        $product->active_i  = $this->checkOrFail($product->active);

        if (is_object($product->p_description)) {
            $this->getUtilities($product);

            $product->p_description->have_series = $this->checkOrFail($product->p_description->have_series);
        }
    }

    public function getPriceWithIva($product)
    {
        $product->price_iva_1 = $this->getIva($product->price_1);
        $product->price_iva_2 = $this->getIva($product->price_2);
        $product->price_iva_3 = $this->getIva($product->price_3);
        $product->price_iva_4 = $this->getIva($product->price_4);
        $product->price_iva_5 = $this->getIva($product->price_5);
    }

    public function getIva($price)
    {
        return number_format($price * (($this->iva / 100) + 1), 2);
    }

    public function getUtilities($product)
    {
        $product->utility_1 = $this->getUtility($product->p_description->purchase_price, $product->price_1);
        $product->utility_2 = $this->getUtility($product->p_description->purchase_price, $product->price_2);
        $product->utility_3 = $this->getUtility($product->p_description->purchase_price, $product->price_3);
        $product->utility_4 = $this->getUtility($product->p_description->purchase_price, $product->price_4);
        $product->utility_5 = $this->getUtility($product->p_description->purchase_price, $product->price_5);
    }

    public function getUtility($purchase, $price)
    {
        $utility = number_format((($price / $purchase) - 1) * 100, 2);

        return $utility;
    }

    public function checkOrFail($data)
    {
        return ($data) ? '<i class="fa fa-check"></i> Si' : '<i class="fa fa-times"></i> No';
    }
}
