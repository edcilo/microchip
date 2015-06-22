<?php

namespace microchip\configuration;

use microchip\base\BaseEntity;

class Configuration extends BaseEntity
{
    protected $fillable = [
        'iva',
        'dollar',
        'coupon_effective_days',
        'coupon_terms_use',
        'width_paper_barcode',          //cm
        'height_paper_barcode',         //cm
        'width_bar_document_barcode',   //mm
        'height_document_barcode',      //mm
        'width_bar_product_barcode',    //mm
        'height_product_barcode',       //mm
        'width_bar_series_barcode',     //mm
        'height_series_barcode',        //mm
    ];

    protected $uniteToPdf = 28.34646;

    protected $CmToPixel = 37.795276;

    protected $MmToPixel = 3.779528;

    public function getWithRealPaperBarcodeAttribute()
    {
        return $this->width_paper_barcode * $this->uniteToPdf;
    }

    public function getHeightRealPaperBarcodeAttribute()
    {
        return $this->height_paper_barcode * $this->uniteToPdf;
    }

    public function getWidthRealBarDocumentBarcodeAttribute()
    {
        return $this->mmToPixel($this->width_bar_document_barcode);
    }

    public function getHeightRealDocumentBarcodeAttribute()
    {
        return $this->mmToPixel($this->height_document_barcode);
    }

    public function getWidthRealBarProductBarcodeAttribute()
    {
        return $this->mmToPixel($this->width_bar_product_barcode);
    }

    public function getHeightRealProductBarcodeAttribute()
    {
        return $this->mmToPixel($this->height_product_barcode);
    }

    public function getWidthRealBarSeriesBarcodeAttribute()
    {
        return $this->mmToPixel($this->width_bar_series_barcode);
    }

    public function getHeightRealSeriesBarcodeAttribute()
    {
        return $this->mmToPixel($this->height_series_barcode);
    }

    public function cmToPixel($cms)
    {
        return $cms * $this->CmToPixel;
    }

    public function mmToPixel($mms)
    {
        return $mms * $this->MmToPixel;
    }
}
