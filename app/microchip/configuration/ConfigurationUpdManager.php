<?php

namespace microchip\configuration;

use microchip\base\BaseManager;

class ConfigurationUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'iva'                           => 'required|numeric',
            'dollar'                        => 'required|numeric',
            'coupon_effective_days'         => 'required|integer',
            'coupon_terms_use'              => 'max:255',
            'width_paper_barcode'           => 'required|numeric',
            'height_paper_barcode'          => 'required|numeric',
            'width_bar_document_barcode'    => 'required|numeric',
            'height_document_barcode'       => 'required|numeric',
            'width_bar_product_barcode'     => 'required|numeric',
            'height_product_barcode'        => 'required|numeric',
            'width_bar_series_barcode'      => 'required|numeric',
            'height_series_barcode'         => 'required|numeric',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        return $data;
    }
}
