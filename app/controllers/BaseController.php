<?php

class BaseController extends Controller {

	protected $msg200 = ['code'=>200, 'msg'=>'OK'];
	protected $msg201 = ['code'=>201, 'msg'=>'Created'];
	protected $msg304 = ['code'=>304, 'msg'=>'Not modified'];
	protected $msg401 = ['code'=>401, 'msg'=>'Unauthorized'];
	protected $msg404 = ['code'=>404, 'msg'=>'Not Found'];

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function notFoundUnless($model)
	{
		if ( Request::ajax() )
		{
			return Response::json( $this->msg404 );
		}
		if ( ! $model )
		{
			App::abort(404);
		}
	}

	/**
	 * Devuelve el modelo en caso que no existan errores en la validacion
	 *
	 * @param $model
	 * @param $errors
	 * @return array
	 */
	protected function responseStore($model, $errors)
	{
		return ( is_array($errors) ) ? $this->msg404 + [ 'errors' => $errors ] : $this->msg201 + [ 'data' => $model ];
	}

	/**
	 * Devuelve el modelo en caso que no existan errores en la validacion
	 *
	 * @param $model
	 * @param $errors
	 * @return array
	 */
	protected function responseUpdate($model, $errors)
	{
		return ( is_array($errors) ) ? $this->msg304 + [ 'errors' => $errors ] : $this->msg200 + [ 'data' => $model ];
	}

	/**
	 * Devolver un arreglo de meses
	 *
	 * @param  string $text  texto a mostrar en la primer opcion de un elemento select de HTML
	 * @return array
	 */
	protected function monthsList($text = 'Selecciona...')
	{
		return $months = [
			0            => $text,
			'Enero'      => 'Enero',
			'Febrero'    => 'Febrero',
			'Marzo'      => 'Marzo',
			'Abril'      => 'Abril',
			'Mayo'       => 'Mayo',
			'Junio'      => 'Junio',
			'Julio'      => 'Julio',
			'Agosto'     => 'Agosto',
			'Septiembre' => 'Septiembre',
			'Octubre'    => 'Octubre',
			'Noviembre'  => 'Noviembre',
			'Diciembre'  => 'Diciembre'
		];
	}


	/**
	 * Devolver un arreglo de numeros enteros
	 *
	 * @param  int    $min
	 * @param  int    $max
	 * @param  string $text
	 * @return array
	 */
	public function number_list($min, $max, $text = "Selecciona...")
	{
		$list = [
			'' => $text
		];

		while ( $min <= $max )
		{
			array_push($list, $min);

			$min++;
		}

		return $list;
	}



	/**
	 * Eliminar imagenes de un directorio
	 *
	 * @param  string|array $path_image  ruta o un arreglo de rutas de las imagenes a eliminar
	 * @param  string $except            nombre de imagen sin extension que no se borrara
	 * @return bool
	 */
	public function destroyFile($path_image, $except=null)
	{
		if ( is_array( $path_image ) )
		{
			foreach ( $path_image as $path )
			{
				$name = $this->getNameImage($path);

				if ( file_exists( $path ) AND $name != $except )
				{
					unlink( $path );
				}
			}

			return true;
		}

		if ( is_string( $path_image ) )
		{
			$name = $this->getNameImage($path_image);

			if ( file_exists( $path_image ) AND $name != $except )
			{
				unlink( $path_image );
			}

			return true;
		}

		return false;
	}

	/**
	 * Obtener el nombre de una imagen
	 *
	 * @param  string $path  ruta de la ubicacion de una imagen
	 * @return string        nombre de la imagen sin extension
	 */
	public function getNameImage($path)
	{
		$name = explode('/', $path);
		$name = array_pop($name);
		$name = explode('.', $name);
		array_pop($name);
		$name = implode($name);

		return $name;
	}

	/**
	 * obtener la ruta de un archivo
	 *
	 * @param $file
	 * @return array|string
	 */
	public function getPath($file)
	{
		$path = explode('/', $file);
		array_pop($path);
		$path = implode('/', $path);

		return $path;
	}

}
