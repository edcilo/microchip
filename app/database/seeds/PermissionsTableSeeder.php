<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use microchip\permission\Permission;

class PermissionsTableSeeder extends Seeder {

	public function run()
	{

        /*
         * Configuraciones
         */
        //1
        Permission::create([
            'name'          => 'Variables globales|Ver',
            'description'   => 'Ver la lista de variables globales del sistema.',
        ]);

        //2
        Permission::create([
            'name'          => 'Variables globales|Modificar',
            'description'   => 'Modificar las variables globales del sistema.',
        ]);



        /*
         * Datos de la emresa
         */
        //3
        Permission::create([
            'name'          => 'Datos de la empresa|Ver',
            'description'   => 'Ver los datos de la empresa',
        ]);

        //4
        Permission::create([
            'name'          => 'Datos de la empresa|Modificar',
            'description'   => 'Modificar los datos de la empresa',
        ]);



        /*
         * Bancos
         */
        //5
        Permission::create([
            'name'          => 'Bancos|Ver',
            'description'   => 'Ver los datos de los bancos',
        ]);

        //6
        Permission::create([
            'name'          => 'Bancos|Registrar',
            'description'   => 'Agregar nuevos bancos',
        ]);

        //7
        Permission::create([
            'name'          => 'Bancos|Modificar',
            'description'   => 'Modificar los datos de los bancos',
        ]);

        //8
        Permission::create([
            'name'          => 'Bancos|Enviar a papelera',
            'description'   => 'Enviar un banco a la papelera'
        ]);

        //9
        Permission::create([
            'name'          => 'Bancos|Devolver de papelera',
            'description'   => 'Devolver un banco enviado a papelera a la lista de bancos activos'
        ]);

        //10
        Permission::create([
            'name'          => 'Bancos|Eliminar',
            'description'   => 'Eliminar el registro de un banco',
        ]);



        /*
         * Cheques
         */
        //11
        Permission::create([
            'name'          => 'Cheques|Ver',
            'description'   => 'Ver los datos de los cheques',
        ]);

        //12
        Permission::create([
            'name'          => 'Cheques|Registrar',
            'description'   => 'Agregar nuevos cheques',
        ]);

        //13
        Permission::create([
            'name'          => 'Cheques|Modificar',
            'description'   => 'Modificar los datos de los cheques',
        ]);

        //14
        Permission::create([
            'name'          => 'Cheques|Enviar a papelera',
            'description'   => 'Enviar un cheque a la papelera'
        ]);

        //15
        Permission::create([
            'name'          => 'Cheques|Devolver de papelera',
            'description'   => 'Devolver un cheque enviado a papelera a la lista de cheques activos'
        ]);



        /*
         * Estado de cuenta
         */
        // 16
        Permission::create([
            'name'          => 'Estado de cuenta|Ver',
            'description'   => 'Ver los datos del estado de cuentas del banco',
        ]);

        //17
        Permission::create([
            'name'          => 'Estado de cuenta|Registrar',
            'description'   => 'Agregar nuevos movimientos en las cuentas',
        ]);

        //18
        Permission::create([
            'name'          => 'Estado de cuenta|Modificar',
            'description'   => 'Modificar los datos de los movimientos de las cuentas',
        ]);

        //19
        Permission::create([
            'name'          => 'Estado de cuenta|Eliminar',
            'description'   => 'Eliminar el registro de un movimiento de las cuentas',
        ]);



        /*
         * Departamentos
         */
        //20
        Permission::create([
            'name'          => 'Departamentos|Ver',
            'description'   => 'Ver los datos de los departamentos',
        ]);

        //21
        Permission::create([
            'name'          => 'Departamentos|Registrar',
            'description'   => 'Agregar nuevos departamentos',
        ]);

        //22
        Permission::create([
            'name'          => 'Departamentos|Modificar',
            'description'   => 'Modificar los datos de los departamentos',
        ]);

        //23
        Permission::create([
            'name'          => 'Departamentos|Eliminar',
            'description'   => 'Eliminar el registro de un departamento',
        ]);



        /*
         * Empleados
         */
        //24
        Permission::create([
            'name'          => 'Empleados|Ver',
            'description'   => 'Ver los datos de los empleados',
        ]);

        //25
        Permission::create([
            'name'          => 'Empleados|Registrar',
            'description'   => 'Agregar nuevos empleados',
        ]);

        //26
        Permission::create([
            'name'          => 'Empleados|Modificar',
            'description'   => 'Modificar los datos de los empleados',
        ]);

        //27
        Permission::create([
            'name'          => 'Empleados|Modificar datos de usuario',
            'description'   => 'Modificar los datos de acceso al sistema'
        ]);

        //28
        Permission::create([
            'name'          => 'Empleados|Enviar a papelera',
            'description'   => 'Enviar un empleado a la papelera'
        ]);

        //29
        Permission::create([
            'name'          => 'Empleados|Devolver de papelera',
            'description'   => 'Devolver un empleado enviado a papelera a la lista de cheques activos'
        ]);

        //30
        Permission::create([
            'name'          => 'Empleados|Eliminar',
            'description'   => 'Eliminar el registro de un empleado',
        ]);

        //31
        Permission::create([
            'name'          => 'Empleados|Ver información de pago del empleado',
            'description'   => 'Ver los datos de pago del empleado'
        ]);

        //32
        Permission::create([
            'name'          => 'Empleados|Pagar',
            'description'   => 'Ver los datos de pago del empleado'
        ]);

        //33
        Permission::create([
            'name'          => 'Empleados|Ver permisos',
            'description'   => 'Ver la lista de permisos del empleado'
        ]);

        //34
        Permission::create([
            'name'          => 'Empleados|Modificar permisos',
            'description'   => 'Modificar permisos del empleado'
        ]);



        /*
         * Proveedores
         */
        //35
        Permission::create([
            'name'          => 'Proveedores|Ver',
            'description'   => 'Ver los datos de los proveedores',
        ]);

        //36
        Permission::create([
            'name'          => 'Proveedores|Registrar',
            'description'   => 'Agregar nuevos proveedores',
        ]);

        //37
        Permission::create([
            'name'          => 'Proveedores|Modificar',
            'description'   => 'Modificar los datos de los proveedores',
        ]);

        //38
        Permission::create([
            'name'          => 'Proveedores|Enviar a papelera',
            'description'   => 'Enviar un proveedor a la papelera'
        ]);

        //39
        Permission::create([
            'name'          => 'Proveedores|Devolver de papelera',
            'description'   => 'Devolver un proveedor enviado a papelera a la lista de cheques activos'
        ]);

        //40
        Permission::create([
            'name'          => 'Proveedores|Eliminar',
            'description'   => 'Eliminar el registro de un proveedores',
        ]);



        /*
         * Marcas
         */
        //41
        Permission::create([
            'name'          => 'Marcas|Ver',
            'description'   => 'Ver los datos de las marcas',
        ]);

        //42
        Permission::create([
            'name'          => 'Marcas|Registrar',
            'description'   => 'Agregar nuevas marcas',
        ]);

        //43
        Permission::create([
            'name'          => 'Marcas|Modificar',
            'description'   => 'Modificar los datos de las marcas',
        ]);

        //44
        Permission::create([
            'name'          => 'Marcas|Eliminar',
            'description'   => 'Eliminar el registro de una marca',
        ]);



        /*
         * Categorías
         */
        //45
        Permission::create([
            'name'          => 'Categorías|Ver',
            'description'   => 'Ver los datos de las categorías',
        ]);

        //46
        Permission::create([
            'name'          => 'Categorías|Registrar',
            'description'   => 'Agregar nuevas categorías',
        ]);

        //47
        Permission::create([
            'name'          => 'Categorías|Modificar',
            'description'   => 'Modificar los datos de las categorías',
        ]);

        //48
        Permission::create([
            'name'          => 'Categorías|Eliminar',
            'description'   => 'Eliminar el registro de una categoría',
        ]);



        /*
         * Permisos
         */
        //49
        Permission::create([
            'name'          => 'Permisos|Ver',
            'description'   => 'Ver los datos de los permisos',
        ]);

        //50
        Permission::create([
            'name'          => 'Permisos|Modificar',
            'description'   => 'Modificar los datos de un permiso',
        ]);



        /*
         * Movimientos
         */
        //51
        Permission::create([
            'name'          => 'Movimientos|Ver',
            'description'   => 'Ver los datos de los movimientos',
        ]);

        //52
        Permission::create([
            'name'          => 'Movimientos|Registrar',
            'description'   => 'Agregar nuevos movimientos',
        ]);

        //53
        Permission::create([
            'name'          => 'Movimientos|Eliminar',
            'description'   => 'Eliminar el registro de un movimiento',
        ]);



        /*
         * Productos y servicios
         */
        //54
        Permission::create([
            'name'          => 'Productos y Servicios|Ver',
            'description'   => 'Ver los datos de los productos y servicios',
        ]);

        //55
        Permission::create([
            'name'          => 'Productos y Servicios|Registrar',
            'description'   => 'Agregar nuevos productos y servicios',
        ]);

        //56
        Permission::create([
            'name'          => 'Productos y Servicios|Modificar',
            'description'   => 'Modificar los datos de los productos y servicios',
        ]);

        //57
        Permission::create([
            'name'          => 'Productos y Servicios|Enviar a papelera',
            'description'   => 'Enviar un producto o servicio a la papelera'
        ]);

        //58
        Permission::create([
            'name'          => 'Productos y Servicios|Devolver de papelera',
            'description'   => 'Devolver un producto o servicio a la lista de activos'
        ]);

        //59
        Permission::create([
            'name'          => 'Productos y Servicios|Eliminar',
            'description'   => 'Eliminar el registro de un producto o servicio',
        ]);



        /**
         * Compras
         */
        //60
        Permission::create([
            'name'          => 'Compras|Ver',
            'description'   => 'Ver los datos de las compras',
        ]);

        //61
        Permission::create([
            'name'          => 'Compras|Registrar',
            'description'   => 'Registrar nuevas compras',
        ]);

        //62
        Permission::create([
            'name'          => 'Compras|Eliminar',
            'description'   => 'Eliminar el registro de una compra',
        ]);



        /**
         * Clientes
         */
        //63
        Permission::create([
            'name'          => 'Clientes|Ver',
            'description'   => 'Ver los datos de los clientes',
        ]);

        //64
        Permission::create([
            'name'          => 'Clientes|Registrar',
            'description'   => 'Agregar nuevos clientes',
        ]);

        //65
        Permission::create([
            'name'          => 'Clientes|Modificar',
            'description'   => 'Modificar los datos de los clientes',
        ]);

        //66
        Permission::create([
            'name'          => 'Clientes|Enviar a papelera',
            'description'   => 'Enviar un cliente a la papelera'
        ]);

        //67
        Permission::create([
            'name'          => 'Clientes|Devolver de papelera',
            'description'   => 'Devolver un cliente enviado a papelera a la lista de clientes activos'
        ]);

        //68
        Permission::create([
            'name'          => 'Clientes|Eliminar',
            'description'   => 'Eliminar el registro de un cliente',
        ]);



        /**
         * Referidos
         */
        //69
        Permission::create([
            'name'          => 'Cliente|Renovar referidos',
            'description'   => 'Renovar o modificar la vigencia de un cliente referido.'
        ]);

        //70
        Permission::create([
            'name'          => 'Cliente|Eliminar referidos',
            'description'   => 'Eliminar un cliente referido',
        ]);



        /**
         * Pagos
         */
        //71
        Permission::create([
            'name'          => 'Pagos|Ver',
            'description'   => 'Ver los datos de los pagos',
        ]);

        //72
        Permission::create([
            'name'          => 'Pagos|Registrar',
            'description'   => 'Agregar nuevos pagos',
        ]);

        //73
        Permission::create([
            'name'          => 'Pagos|Modificar',
            'description'   => 'Modificar los datos de los pagos',
        ]);

        //74
        Permission::create([
            'name'          => 'Pagos|Eliminar',
            'description'   => 'Eliminar el registro de un pago',
        ]);

        //75
        Permission::create([
            'name'          => 'Pagos|Caja',
            'description'   => 'Ver los datos de los pagos',
        ]);



        /**
         * Ventas
         */
        //76
        Permission::create([
            'name'          => 'Ventas|Ver',
            'description'   => 'Ver los datos de las ventas',
        ]);

        //77
        Permission::create([
            'name'          => 'Ventas|Registrar',
            'description'   => 'Agregar nuevas ventas',
        ]);

        //78
        Permission::create([
            'name'          => 'Ventas|Modificar',
            'description'   => 'Modificar los datos de las ventas',
        ]);

        //79
        Permission::create([
            'name'          => 'Ventas|Ver ajuste total',
            'description'   => 'Ver si la venta cuenta con un ajuste de precio',
        ]);

        //80
        Permission::create([
            'name'          => 'Ventas|Ajustar total',
            'description'   => 'Ajustar el valor total de la venta',
        ]);

        //81
        Permission::create([
            'name'          => 'Ventas|Eliminar partida',
            'description'   => 'Eliminar el registro de una venta no concretada',
        ]);

        //82
        Permission::create([
            'name'          => 'Ventas|Cancelar',
            'description'   => 'Cancelar una venta',
        ]);

        //83
        Permission::create([
            'name'          => 'Ventas|Cancelar productos',
            'description'   => 'Cancelar un producto de una venta',
        ]);



        /**
         * Pedidos
         */
        //84
        Permission::create([
            'name'          => 'Pedidos|Ver',
            'description'   => 'Ver los datos de los pedidos',
        ]);

        //85
        Permission::create([
            'name'          => 'Pedidos|Registrar',
            'description'   => 'Agregar nuevos pedidos',
        ]);

        //86
        Permission::create([
            'name'          => 'Pedidos|Modificar',
            'description'   => 'Modificar los datos de los pedidos',
        ]);

        //87
        Permission::create([
            'name'          => 'Pedidos|Eliminar partida',
            'description'   => 'Eliminar el registro de un pedido no concretado',
        ]);

        //88
        Permission::create([
            'name'          => 'Pedidos|Vender',
            'description'   => 'Vender un pedido',
        ]);

        //89
        Permission::create([
            'name'          => 'Pedidos|Cancelar',
            'description'   => 'Cancelar un pedido',
        ]);

        //90
        Permission::create([
            'name'          => 'Pedidos|Surtir',
            'description'   => 'Surtir los productos de un pedido',
        ]);



        /**
         * Bitácora
         */
        //91
        Permission::create([
            'name'          => 'Bitácora|Ver',
            'description'   => 'Ver los datos de la bitácora',
        ]);

        //92
        Permission::create([
            'name'          => 'Bitácora|Registrar',
            'description'   => 'Agregar nuevos registros a la bitácora',
        ]);



        /**
         * Servicios
         */
        //93
        Permission::create([
            'name'          => 'Servicios|Ver',
            'description'   => 'Ver los datos de los servicios',
        ]);

        //94
        Permission::create([
            'name'          => 'Servicios|Registrar',
            'description'   => 'Agregar nuevos pedidos',
        ]);

        //95
        Permission::create([
            'name'          => 'Servicios|Modificar',
            'description'   => 'Modificar los datos/productos de los pedidos',
        ]);

        //96
        Permission::create([
            'name'          => 'Servicios|Eliminar partida',
            'description'   => 'Eliminar el registro de un pedido no concretado',
        ]);

        //97
        Permission::create([
            'name'          => 'Servicios|Modificar fecha de entrega',
            'description'   => 'Modificar la fecha de entrega de un servicio',
        ]);

        //98
        Permission::create([
            'name'          => 'Servicios|Terminar',
            'description'   => 'Marcar servicio como terminado',
        ]);

        //99
        Permission::create([
            'name'          => 'Servicios|Vender',
            'description'   => 'Vender un pedido',
        ]);

        //100
        Permission::create([
            'name'          => 'Servicios|Volver en proceso',
            'description'   => 'Marcar servicio como en proceso'
        ]);

        //101
        Permission::create([
            'name'          => 'Servicios|Pedir productos',
            'description'   => 'Marcar productos de un servicio como pedidos',
        ]);

        //102
        Permission::create([
            'name'          => 'Servicios|Surtir productos',
            'description'   => 'Surtir productos pedidos de un servicio',
        ]);

        //103
        Permission::create([
            'name'          => 'Servicios|Subir/Bajar productos a soporte',
            'description'   => 'Subir/bajar productos surtidos de un servicio a soporte',
        ]);

        //104
        Permission::create([
            'name'          => 'Servicios|Cancelar',
            'description'   => 'Cancelar un pedido',
        ]);


        /**
         * Cotizaciones
         */
        //105
        Permission::create([
            'name'          => 'Cotizaciones|Ver',
            'description'   => 'Ver los datos de las cotizaciones',
        ]);

        //106
        Permission::create([
            'name'          => 'Cotizaciones|Registrar',
            'description'   => 'Agregar nuevas cotizaciones',
        ]);

        //107
        Permission::create([
            'name'          => 'Cotizaciones|Modificar',
            'description'   => 'Modificar los datos de las cotizaciones',
        ]);

        //108
        Permission::create([
            'name'          => 'Cotizaciones|Eliminar partida',
            'description'   => 'Eliminar el registro de una cotización no concretada',
        ]);

        //109
        Permission::create([
            'name'          => 'Cotizaciones|Clonar',
            'description'   => 'Clonar una partida de una cotización',
        ]);

        //110
        Permission::create([
            'name'          => 'Cotizaciones|Convertir cotización a pedido',
            'description'   => 'Convertir cotización a pedido',
        ]);
        /*
        Permission::create([
            'name'          => '',
            'description'   => '',
        ]);
        */

	}

}