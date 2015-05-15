<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 * Rutas relacionadas con el inicio de sesion
 */
require __DIR__.'/routes/home.php';

/*
 * Rutas a las que se necesita iniciar sesión par poder acceder
 */
Route::group(['before' => 'auth'], function () {

    /*
 * Rutas relacionadas con la administracion de las variables globales
 */
    require __DIR__.'/routes/configuration.php';

    /*
     * Rutas relacionadas con la administración de la informacion de la empresa
     */
    require __DIR__.'/routes/company.php';

    /*
     * Rutas relacionadas con la administracion de los bancos
     */
    require __DIR__.'/routes/bank.php';

    /*
     * Rutas relacionadas con la administracion del historial de cuenta de los bancos
     */
    require __DIR__.'/routes/bankCount.php';

    /*
     * Rutas relacionadas con la administracion de los cheques
     */
    require __DIR__.'/routes/cheques.php';

    /*
     * Rutas relacionadas con la administracion de los departamentos de los usuarios
     */
    require __DIR__.'/routes/department.php';

    /*
     * Rutas relacionadas con la administracion de los usuarios y sus perfiles
     */
    require __DIR__.'/routes/user.php';

    /*
     * Rutas relacionadas con la administracion de los permisos
     */
    require __DIR__.'/routes/permission.php';

    /*
     * Rutas relacionadas con la administracion de los proveedores
     */
    require __DIR__.'/routes/provider.php';

    /*
     * Rutas relacionadas con la administracion de los contactos de los proveedores
     */
    require __DIR__.'/routes/providerContact.php';

    /*
     * Rutas relacionadas con la administracion de los telefonos del proveedor
     */
    require __DIR__.'/routes/providerPhone.php';

    /*
     * Rutas relacionadas con la administracion de la informacion bancaria de los proveedores
     */
    require __DIR__.'/routes/providerBank.php';

    /*
     * Rutas relacionadas con la administracion de los clientes
     */
    require __DIR__.'/routes/customer.php';

    /*
     * Rutas relacionadas con la administracion de los contactos de un cliente
     */
    require __DIR__.'/routes/customerContact.php';

    /*
     * Rutas relacionadas con la administracion de los contactos referidos
     */
    require __DIR__.'/routes/customerReferrer.php';

    /*
     * Rutas relacionadas con la administración de las categorias de los productos
     */
    require __DIR__.'/routes/category.php';

    /*
     * Rutas relacionadas con la administración de las marcas de los productos
     */
    require __DIR__.'/routes/mark.php';

    /*
     * Rutas relacionadas con la administración de los productos (productos/servicios)
     */
    require __DIR__.'/routes/product.php';

    /*
     * Rutas relacionadas con la administracion de las descripciones de los productos
     */
    require __DIR__.'/routes/productDescription.php';

    /*
     * Rutas relacionadas con la administracion de los numeros de series de los productos
     */
    require __DIR__.'/routes/series.php';

    /*
     * Rutas relacionadas con la administracion de los movimientos de inventario
     */
    require __DIR__.'/routes/movement.php';

    /*
     * Rutas relacionadas con la administracion de las compras
     */
    require __DIR__.'/routes/purchase.php';

    /*
     * Rutas relacionadas con la administracion de los pagos de una compra
     */
    require __DIR__.'/routes/purchasePayment.php';

    /*
     * Rutas relacionadas con la administracion de las ventas
     */
    require __DIR__.'/routes/sale.php';

    /*
     * Rutas relacionadas con la administracion de los pedidos
     */
    require __DIR__.'/routes/order.php';

    /*
     * Rutas relacionadas con la administracion de las cotizaciones
     */
    require __DIR__.'/routes/price.php';

    /*
     * Rutas relaciondas con la administracion de los servicios
     */
    require __DIR__.'/routes/service.php';

    /*
     * Rutas relacionadas con los datos del servicio
     */
    require __DIR__.'/routes/dataService.php';

    /*
     * Rutas relacionadas con la administracion de PAS
     */
    require __DIR__.'/routes/pas.php';

    /*
     * Rutas relacionadas con la administracion de productos ordenados en pedidos
     */
    require __DIR__.'/routes/orderProduct.php';

    /*
     * Rutas relacionadas con la administracion de los comentarios de pedidos y servicios (bitácora)
     */
    require __DIR__.'/routes/comment.php';

    /*
     * Rutas relacionadas con la administracion de los pagos del cliente
     */
    require __DIR__.'/routes/pays.php';

    /*
     * Rutas relacionadas con la administracion de los vales
     */
    require __DIR__.'/routes/coupon.php';

    /*
     * Rutas relacionadas con la administracion de garantías
     */
    require __DIR__.'/routes/warranty.php';

    /*
     * Rutas relacionadas con la administración de las notas de credito
     */
    require __DIR__.'/routes/couponPurchase.php';

});
