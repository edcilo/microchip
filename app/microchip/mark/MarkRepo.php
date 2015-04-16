<?php namespace microchip\mark;

use microchip\base\BaseRepo;

class MarkRepo extends BaseRepo {

    public function getModel()
    {
        return new Mark();
    }

    public function newMark()
    {
        return $mark = new Mark();
    }

    public function search($terms, $request='', $take=10)
    {
        $q = Mark::where('name', 'like', "%$terms%")
            ->orwhere('description', 'like', "%$terms%");

        return ( $request == 'ajax' ) ? $q->take($take)->get() : $q->paginate();
    }

}