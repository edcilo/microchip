<?php

namespace microchip\series;

use microchip\base\BaseRepo;

class SeriesRepo extends BaseRepo
{
    public function getModel()
    {
        return new Series();
    }

    public function newSeries()
    {
        return $series = new Series();
    }

    public function getSeriesByProduct($product_id)
    {
        return Series::where('product_id', $product_id)
            ->orderBy('id', 'DESC')
            ->paginate();
    }

    public function findBySeries($ns, $status = '', $product_id = '')
    {
        return Series::where('ns', $ns)
            ->where('status', $status)
            ->where('product_id', $product_id)
            ->first();
    }

    public function unique($ns)
    {
        $result = Series::where('ns', $ns)->first();

        return is_null($result);
    }

    public function findBySeriesForWarranty($ns)
    {
        return Series::where('ns', $ns)
            ->where('status', '!=', 'Garantía')
            ->first();
    }
}
