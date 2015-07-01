<?php

namespace microchip\product;

use microchip\base\BaseRepo;

class ProductRepo extends BaseRepo
{
    public function getModel()
    {
        return new Product();
    }

    public function newProduct()
    {
        return $product = new Product();
    }

    public function find($id)
    {
        return Product::where('id', $id)->with('pDescription')->first();
    }

    public function getType($type, $active = 1,  $like = 'all', $column = 'id', $order = 'ASC')
    {
        $q = Product::where('type', $type)
            ->where('active', $active)
            ->orderby($column, $order);

        return ($like == 'all') ? $q->get() : $q->paginate();
    }

    public function getByMark($mark_id, $paginate = true)
    {
        $q = Product::select('products.*', 'product_descriptions.*', 'categories.name')
            ->leftjoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
            ->leftjoin('categories', 'product_descriptions.category_id', '=', 'categories.id')
            ->where('mark_id', $mark_id)
            ->orderBy('barcode', 'ASC');

        return ($paginate) ? $q->paginate() : $q->get();
    }

    public function getByCategory($category_id, $paginate = true)
    {
        $q = Product::select('products.*', 'product_descriptions.*', 'marks.name')
            ->leftjoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
            ->leftjoin('marks', 'product_descriptions.category_id', '=', 'marks.id')
            ->where('category_id', $category_id)
            ->orderBy('barcode', 'ASC');

        return ($paginate) ? $q->paginate() : $q->get();
    }

    public function getByBarcode($barcode, array $with = array())
    {
        return Product::with($with)->where('barcode', $barcode)->first();
    }

    public function search($terms, $type = 'all', $request = '', $take = 10)
    {
        $q = Product::with('pDescription');

        if ($type != 'all') {
            $q->where('type', $type);
        }

        $q->where(function($q) use ($terms) {
            $q->where('barcode', 'like', "%$terms%")->orwhere('s_description', 'like', "%$terms%");
        });

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }

    public function getStockMin($paginate=true)
    {
        $query = Product::select('products.*', 'product_descriptions.stock_min', 'product_descriptions.stock_max', \DB::raw('ifnull(sum(inventory_movements.in_stock),0) as total_stock'))
            ->leftJoin('inventory_movements', 'products.id', '=', 'inventory_movements.product_id')
            ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
            ->with(['movements' => function ($query) {
                $query->with('purchases')->orderBy('id', 'DESC');
            }])
            ->where('type', 'Producto')
            ->groupBy('products.id')
            ->havingRaw('stock_min > total_stock');

        return ($paginate) ? $query->paginate() : $query->get();
    }
}
