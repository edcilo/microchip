<nav class="nav-v" id="col-izq">

    <ul class="menuOptions">
        @if( p(71) OR p(76) OR p(84) OR p(93) OR p(105) OR p(111) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="options1"></i>
                    Ventas
                </strong>
            </li>
            <ul class="options1">
                @if( p(76) )
                    <li>
                        <a href="{{ route('sale.index') }}">
                            <i class="fa fa-inbox"></i>
                            Lista de Ventas
                        </a>
                    </li>
                @endif
                @if( p(84) )
                    <li>
                        <a href="{{ route('order.index') }}">
                            <i class="fa fa-inbox"></i>
                            Lista de Pedidos
                        </a>
                    </li>
                @endif
                @if( p(93) )
                    <li>
                        <a href="{{ route('service.index') }}">
                            <i class="fa fa-inbox"></i>
                            Lista de Servicios
                        </a>
                    </li>
                @endif
                @if( p(105) )
                    <li>
                        <a href="{{ route('price.index') }}">
                            <i class="fa fa-inbox"></i>
                            Lista de Cotizaciones
                        </a>
                    </li>
                @endif
                @if( p(111) )
                    <li>
                        <a href="{{ route('pas.index') }}">
                            <i class="fa fa-tag"></i>
                            Productos ordenados
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('warranty.index') }}">
                        <i class="fa fa-truck"></i>
                        Productos en garantía
                    </a>
                </li>
                @if( p(71) )
                    <li>
                        <a href="{{ route('pay.index') }}">
                            <i class="fa fa-money"></i>
                            Pagos
                        </a>
                    </li>
                @endif
                @if( p(115) )
                    <li>
                        <a href="{{ route('coupon.index') }}">
                            <i class="fa fa-ticket"></i>
                            Vales
                        </a>
                    </li>
                @endif
                @if( p(114) )
                    <li>
                        <a href="{{ route('sale.cancellations') }}">
                            <i class="fa fa-ban"></i>
                            Cancelaciones
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @if( p(63) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="options1"></i>
                    Clientes
                </strong>
            </li>
            <ul class="options2">
                <li>
                    <a href="{{ route('customer.index') }}">
                        <i class="fa fa-list"></i>
                        Lista de Clientes
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.trash') }}">
                        <i class="fa fa-trash"></i>
                        Clientes eliminados
                    </a>
                </li>
            </ul>
        @endif

        @if( p(60) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="options1"></i>
                    Facturas de compras
                </strong>
            </li>
            <ul class="options1">
                <li>
                    <a href="{{ route('purchase.index') }}">
                        <i class="fa fa-list"></i>
                        Facturas de compra
                    </a>
                </li>
                <li>
                    <a href="{{ route('purchase.incomplete') }}">
                        <i class="fa fa-times"></i>
                        Facturas incompletas
                    </a>
                </li>
            </ul>
        @endif

        @if( p(41) OR p(45) OR p(51) OR p(54) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="options1"></i>
                    Inventario
                </strong>
            </li>
            <ul class="options1">
                @if( p(54) )
                    <li>
                        <a href="{{ route('product.index.product') }}">
                            <i class="fa fa-circle"></i>
                            Productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.index.service') }}">
                            <i class="fa fa-circle"></i>
                            Servicios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.trash') }}">
                            <i class="fa fa-trash"></i>
                            Productos eliminados
                        </a>
                    </li>
                @endif
                @if( p(51) )
                    <li>
                        <a href="{{ route('movement.index') }}">
                            <i class="fa fa-refresh"></i>
                            Movimientos de inventario
                        </a>
                    </li>
                @endif
                @if( p(45) )
                    <li>
                        <a href="{{ route('category.index') }}">
                            <i class="fa fa-tag"></i>
                            Adm. Categorías
                        </a>
                    </li>
                @endif
                @if( p(41) )
                    <li>
                        <a href="{{ route('mark.index') }}">
                            <i class="fa fa-tag"></i>
                            Adm. Marcas
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @if( p(35) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="options1"></i>
                    Proveedores
                </strong>
            </li>
            <ul>
                <li>
                    <a href="{{ route('provider.index') }}">
                        <i class="fa fa-list"></i>
                        Lista de Proveedores
                    </a>
                </li>
                <li>
                    <a href="{{ route('provider.trash') }}">
                        <i class="fa fa-trash"></i>
                        Proveedores eliminados
                    </a>
                </li>
            </ul>
        @endif

        @if( p(20) OR p(24) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="options1"></i>
                    Empleados
                </strong>
            </li>
            <ul>
                <li>
                    <a href="{{ route('user.index') }}">
                        <i class="fa fa-list"></i>
                        Lista de Empleados
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.trash') }}">
                        <i class="fa fa-trash"></i>
                        Empleados eliminados
                    </a>
                </li>
                @if( p(20) )
                    <li>
                        <a href="{{ route('department.index') }}">
                            <i class="fa fa-tag"></i>
                            Departamentos
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @if( p(5) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="1"></i>
                    Bancos
                </strong>
            </li>
            <ul>
                <li>
                    <a href="{{ route('bank.index') }}">
                        <i class="fa fa-list"></i>
                        Lista de bancos
                    </a>
                </li>
                <li>
                    <a href="{{ route('bank.trash') }}">
                        <i class="fa fa-trash"></i>
                        Bancos eliminados
                    </a>
                </li>
            </ul>
        @endif

        @if( p(1) OR p(3) )
            <li>
                <strong>
                    <i class="fa fa-caret-down button" data-options="1"></i>
                    Administrar
                </strong>
            </li>
            <ul>
                @if( p(3) )
                    <li>
                        <a href="{{ route('company.show', 1) }}">
                            <i class="fa fa-bank"></i>
                            Datos de la empresa
                        </a>
                    </li>
                @endif
                @if( p(1) )
                    <li>
                        <a href="{{ route('configuration.show', 1) }}">
                            <i class="fa fa-globe"></i>
                            Variables globales
                        </a>
                    </li>
                @endif
                @if( p(49) )
                    <li>
                        <a href="{{ route('permission.index') }}">
                            <i class="fa fa-key"></i>
                            Permisos
                        </a>
                    </li>
                @endif
            </ul>
        @endif

    </ul>

</nav>