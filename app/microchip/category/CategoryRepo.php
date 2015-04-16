<?php namespace microchip\category;

use microchip\base\BaseRepo;

class CategoryRepo extends BaseRepo {

    public function getModel()
    {
        return new Category();
    }

    public function newCategory()
    {
        return $category = new Category();
    }

    public function search($terms, $request='', $take=10)
    {
        $q = Category::where('name', 'like', "%$terms%")
            ->orwhere('description', 'like', "%$terms%");

        return ( $request == 'ajax' ) ? $q->take($take)->get() : $q->paginate();
    }

}