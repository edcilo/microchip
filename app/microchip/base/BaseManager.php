<?php

namespace microchip\base;

abstract class BaseManager
{
    protected $entity;
    protected $data;
    protected $response;

    public function __construct($entity, $data, $response = null)
    {
        $this->entity = $entity;
        $this->data   = $data;
        $this->response = $response;
    }

    abstract public function getRules();

    public function isValid()
    {
        $rules = $this->getRules();

        $validation = \Validator::make($this->data, $rules);

        if ($validation->fails()) {
            if ($this->response == 'json') {
                return $validation->getMessageBag()->toArray();
            } else {
                throw new ValidationException('Validation failed', $validation->messages());
            }
        }

        return true;
    }

    public function prepareData($data)
    {
        return $data;
    }

    public function save()
    {
        $result = $this->isValid();

        if (is_array($result)) {
            return $result;
        }

        $this->entity->fill($this->prepareData($this->data));
        $this->entity->save();

        return true;
    }

    /**
     * Eliminar etiquetas HTML.
     *
     * @param array $data   paso por referencia, arreglo bidireccional a limpiar
     * @param array $needle arreglo simple con los nombres de llaves a excentuar
     *
     * @return array $data   arreglo limpio
     */
    public function stripTags(&$data, $needle = [])
    {
        foreach ($data as $key => $value) {
            $data[$key] = (!in_array($key, $needle)) ? strip_tags($value) : $value;
        }

        return $data;
    }

    /**
     * Convierte las etiquetas HTML a entidades HTML.
     *
     * @param array $data   paso por referencia, arreglo bidireccional a limpiar
     * @param array $needle areglo simple con los nombres de llaves a excentuar
     * @param int   $flag   mascara de bits (http://php.net/manual/es/function.htmlentities.php)
     *
     * @return array $data
     */
    public function htmlEntities(&$data, $needle = [], $flag = ENT_HTML5)
    {
        foreach ($data as $key => $value) {
            $data[$key] = (!in_array($key, $needle)) ? htmlspecialchars($value, $flag) : $value;
        }

        return $data;
    }

    /**
     * Guarda la imagen en el directorio especificado.
     *
     * @param object $file
     * @param string $path
     * @param bool   $date
     * @param  $name
     * @param  $extension
     * @param bool   $delete
     * @param  $file_remove
     *
     * @return bool
     */
    public function saveFile($file, $path, $date = false, $name = false, $extension = false, $delete = false, $file_remove = null)
    {
        if (is_null($file)) {
            return false;
        }

        if ($delete) {
            if (file_exists($file_remove)) {
                unlink($file_remove);
            }
        }

        if ($name) {
            $name = \Str::slug($name);
        } else {
            $name      = $file->getClientOriginalName();
            $name      = explode('.', $name);
            array_pop($name);
            $name      = implode('_', $name);
        }

        $extension = ($extension) ? $extension : $file->guessExtension();

        $name .= ($date) ? '_'.date('YmdHis') : '';
        $name .= ".$extension";

        $file->move($path, $name);

        return $path.'/'.$name;
    }

    /**
     * Devuelve solo la ruta de un archivo pasado como parametro.
     *
     * @param string $file
     *
     * @return string
     */
    public function getPath($file)
    {
        $path = explode('/', $file);
        array_pop($path);
        $path = implode('/', $path);

        return $path;
    }
}
