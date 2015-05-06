<?php

namespace microchip\sale;

use microchip\helpers\NumberToLetter;

class SaleFormat
{
    public function formatData(&$sale)
    {
        if (is_object($sale->movements)) {
            foreach ($sale->movements as $movement) {
                $movement->selling_price_iva    = $this->getPriceIva($movement, $sale->iva);
                $movement->total                = $this->getTotal($movement, 0);
                $movement->total_iva            = $this->getTotal($movement, $sale->iva);

                $movement->selling_price_f      = number_format($movement->selling_price, 2);
                $movement->selling_price_iva_f  = number_format($movement->selling_price_iva, 2);
                $movement->total_f              = number_format($movement->total, 2);
                $movement->total_iva_f          = number_format($movement->total_iva, 2);

                $sale->subtotal                 += $movement->total;
                $sale->total                    += $movement->total_iva;
            }

            foreach ($sale->pas as $pa) {
                if ($pa->product_id != 0) {
                    $pa->selling_price_wiva         = number_format($pa->selling_price / $this->getIva($sale->iva), 2, '.', '');
                    $pa->total_wiva                 = number_format($pa->quantity * $pa->selling_price_wiva, 2, '.', '');
                    $pa->total                      = number_format($pa->quantity * $pa->selling_price, 2, '.', '');

                    $pa->selling_price_wiva_f       = number_format($pa->selling_price_wiva, 2);
                    $pa->selling_price_f            = number_format($pa->selling_price, 2);
                    $pa->total_wiva_f               = number_format($pa->total_wiva, 2);
                    $pa->total_f                    = number_format($pa->total, 2);
                } else {
                    $pa->price_total                = $pa->selling_price * $this->getIva($pa->utility) + $pa->shipping;
                    $pa->price_total                *= ($pa->w_iva) ? $this->getIva($sale->iva) : 1;
                    $pa->price_total                *= ($pa->dollar) ? $sale->value_dollar : 1;

                    $pa->selling_price_wiva         = number_format($pa->price_total / $this->getIva($sale->iva), 2, '.', '');
                    $pa->total_wiva                 = number_format($pa->quantity * $pa->selling_price_wiva, 2, '.', '');
                    $pa->total                      = number_format($pa->quantity * $pa->price_total, 2, '.', '');

                    $pa->selling_price_wiva_f       = number_format($pa->selling_price_wiva, 2);
                    $pa->selling_price_f            = number_format($pa->price_total, 2);
                    $pa->total_wiva_f               = number_format($pa->total_wiva, 2);
                    $pa->total_f                    = number_format($pa->total, 2);
                }

                $sale->subtotal                 += $pa->total_wiva;
                $sale->total                    += $pa->total;
            }

            $no2letter          = new NumberToLetter();
            $sale->total_text   = strtoupper($no2letter->ValorEnLetras($sale->total, 'pesos'));

            $sale->subtotal_f   = number_format($sale->subtotal, 2);
            $sale->total_f      = number_format($sale->total, 2);
        } else {
            $sale->subtotal = '0.00';
            $sale->total    = '0.00';
        }

        if ($sale->new_price > 0) {
            $sale->difference   = $this->getDifferenceIva($sale);
            $sale->pv_di        = $sale->total + $sale->difference;

            $sale->difference_f = number_format($sale->difference, 2);
            $sale->pv_di_f      = number_format($sale->pv_di, 2);
        }
    }

    public function getPriceIva($movement, $iva)
    {
        $price  = number_format($movement->selling_price * $this->getIva($iva), 2, '.', '');

        return $price;
    }

    public function getTotal($movement, $iva, $format = true)
    {
        $total = number_format($this->getPriceIva($movement, $iva, false) * $movement->quantity, 2, '.', '');

        return $total;
    }

    public function getIva($iva)
    {
        return ($iva / 100) + 1;
    }

    public function getDifferenceIva($sale)
    {
        return number_format(($sale->new_price - $sale->new_price / $this->getIva($sale->iva)) - ($sale->total - $sale->total / $this->getIva($sale->iva)), 2, '.', '');
    }
}
