<?php namespace microchip\base;

abstract class BaseRepo{

    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract function getModel();

    /**
     * devolver coleccion de todas las filas de un modelo
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * eliminar una fila o una collecion de filas de un modelo según su id
     * $id puede ser un valor entero o un arreglo de valores enteros
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * devolver una fila o una coleccion de filas según su id
     * $id puede ser un valor entero o un arreglo de valores enteros
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * devolver la primera fila de un modelo
     *
     * @return mixed
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * devolver una coleccion de filas con una o dos columnas
     * para generar la lista de opciones de un elemento select de HTML
     *
     * @param string $column
     * @param null   $key
     * @return array
     */
    public function lists($column, $key=null)
    {
        return ( is_null($key) ) ? $this->model->lists($column) : $this->model->lists($column, $key);
    }

    /**
     * devolver una columna de la primer fila de un modelo
     *
     * @param  string $column
     * @return mixed
     */
    public function pluck($column)
    {
        return $this->model->pluck($column);
    }

    /**
     * Borrar todas las filas de un modelo
     *
     * @return mixed
     */
    public function truncate()
    {
        return $this->model->truncate();
    }

    /**
     * devolver coleccion de todas las filas de un modelo
     *
     * @param string $like    devolver toda la colleccion en forma de arreglo o paginada
     * @param string $column  columna para ordenar la coleccion
     * @param string $order   orden en que se devolvera la coleccion (ASC|DESC)
     * @return mixed
     */
    public function getAll($like='all', $column='id', $order='ASC')
    {
        $q = $this->model->orderby($column, $order);

        return ( $like == 'all' ) ? $q->get() : $q->paginate();
    }

    public function getActive($active=1, $like='all', $column='id', $order='ASC')
    {
        $q = $this->model->orderby($column, $order)->where('active', $active);

        return ( $like == 'all' ) ? $q->get() : $q->paginate();
    }

}