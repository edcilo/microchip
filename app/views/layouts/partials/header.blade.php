<header>
    <div class="cont1366">
        <figure class="logo">
            <img class="img-responsive" src="{{ asset('images/sist/logo1.png') }}" alt="Logotipo de Microchip"/>
        </figure>
        <div class="nav nav-0">
            <ul>
                <li><a href="{{ Route('home.sale') }}">Inicio</a></li>
                @if( p(75) OR p(71) OR p(115) OR p(134) )
                    <li>
                        <a href="#" class="trigger-dropdown">Caja</a>
                        <ul class="dropdown-menu">
                            @if(p(75))
                                <li>
                                    <a href="{{ Route('pay.pending') }}" tabindex="-1">
                                        <i class="fa fa-credit-card"></i>
                                        Caja
                                    </a>
                                </li>
                            @endif
                            @if( p(71) )
                                <li>
                                    <a href="{{ Route('pay.index') }}" tabindex="-1">
                                        <i class="fa fa-money"></i>
                                        Pagos
                                    </a>
                                </li>
                            @endif
                            @if( p(115) )
                                <li>
                                    <a href="{{ route('coupon.index') }}" tabindex="-1">
                                        <i class="fa fa-ticket"></i>
                                        Vales
                                    </a>
                                </li>
                            @endif
                            @if( p(134) )
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('concept.index') }}">
                                        <i class="fa fa-list"></i>
                                        Conceptos de gastos
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if( p(76) OR p(84) OR p(93) OR p(105) )
                    <li>
                        <a href="#" class="trigger-dropdown">Ventas</a>
                        <ul class="dropdown-menu">
                            @if( p(76) )
                                <li>
                                    <a href="{{ route('sale.index') }}" tabindex="-1">
                                        <i class="fa fa-inbox"></i>
                                        Ventas
                                    </a>
                                </li>
                            @endif
                            @if( p(84) )
                                <li>
                                    <a href="{{ Route('order.index') }}" tabindex="-1">
                                        <i class="fa fa-inbox"></i>
                                        Pedidos
                                    </a>
                                </li>
                            @endif
                            @if( p(93) )
                                <li>
                                    <a href="{{ Route('service.index') }}" tabindex="-1">
                                        <i class="fa fa-inbox"></i>
                                        Servicios
                                    </a>
                                </li>
                            @endif
                            @if( p(105) )
                                <li>
                                    <a href="{{ Route('price.index') }}" tabindex="-1">
                                        <i class="fa fa-inbox"></i>
                                        Cotizaciones
                                    </a>
                                </li>
                            @endif
                            @if( p(114) )
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('sale.cancellations') }}" tabindex="-1">
                                        <i class="fa fa-ban"></i>
                                        Cancelaciones
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('service.trash') }}" tabindex="-1">
                                    <i class="fa fa-trash"></i>
                                    Servicios descartados
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(p(54) OR p(51) OR p(45) OR p(41))
                    <li>
                        <a href="#" class="trigger-dropdown">Inventario</a>
                        <ul class="dropdown-menu">
                            @if( p(54) )
                                <li>
                                    <a href="{{ route('product.index.product') }}" tabindex="-1">
                                        <i class="fa fa-archive"></i>
                                        Productos
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.index.service') }}" tabindex="-1">
                                        <i class="fa fa-wrench"></i>
                                        Servicios
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.trash') }}" tabindex="-1">
                                        <i class="fa fa-trash"></i>
                                        Productos eliminados
                                    </a>
                                </li>
                            @endif
                            @if( p(111) OR p(119) )
                                <li class="divider"></li>
                            @endif
                            @if( p(111) )
                                <li>
                                    <a href="{{ route('pas.index') }}">
                                        <i class="fa fa-truck"></i>
                                        Productos ordenados
                                    </a>
                                </li>
                            @endif
                            @if(p(119))
                                <li>
                                    <a href="{{ route('warranty.index') }}">
                                        <i class="fa fa-truck"></i>
                                        Productos en garantía
                                    </a>
                                </li>
                            @endif
                            @if( p(51) )
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('movement.index') }}" tabindex="-1">
                                        <i class="fa fa-refresh"></i>
                                        Movimientos de inventario
                                    </a>
                                </li>
                            @endif
                            @if(p(45) OR p(41))
                                <li class="divider"></li>
                            @endif
                            @if( p(45) )
                                <li>
                                    <a href="{{ route('category.index') }}" tabindex="-1">
                                        <i class="fa fa-tag"></i>
                                        Adm. Categorías
                                    </a>
                                </li>
                            @endif
                            @if( p(41) )
                                <li>
                                    <a href="{{ route('mark.index') }}" tabindex="-1">
                                        <i class="fa fa-tag"></i>
                                        Adm. Marcas
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(p(60) OR p(118) OR p(35))
                    <li>
                        <a href="#" class="trigger-dropdown">Compras</a>
                        <ul class="dropdown-menu">
                            @if( p(60) )
                                <li>
                                    <a href="{{ route('purchase.index') }}" tabindex="-1">
                                        <i class="fa fa-list"></i>
                                        Compras
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('purchase.incomplete') }}" tabindex="-1">
                                        <i class="fa fa-times"></i>
                                        Compras incompletas
                                    </a>
                                </li>
                            @endif
                            @if(p(118))
                                <li>
                                    <a href="{{ route('coupon.purchase.index') }}" tabindex="-1">
                                        <i class="fa fa-ticket"></i>
                                        Notas de crédito
                                    </a>
                                </li>
                            @endif
                            @if( p(35) )
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('provider.index') }}" tabindex="-1">
                                        <i class="fa fa-list"></i>
                                        Proveedores
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('provider.trash') }}" tabindex="-1">
                                        <i class="fa fa-trash"></i>
                                        Proveedores eliminados
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if( p(63) )
                    <li><a href="#" class="trigger-dropdown">Clientes</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ Route('customer.index') }}" tabindex="-1">
                                    <i class="fa fa-users"></i>
                                    Clientes
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.trash') }}" tabindex="-1">
                                    <i class="fa fa-trash"></i>
                                    Clientes eliminados
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if( p(24) OR p(20) )
                    <li>
                        <a href="#" class="trigger-dropdown">Empleados</a>
                        <ul class="dropdown-menu">
                            @if(p(24))
                                <li>
                                    <a href="{{ Route('user.index') }}" tabindex="-1">
                                        <i class="fa fa-users"></i>
                                        Empleados
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.trash') }}" tabindex="-1">
                                        <i class="fa fa-trash"></i>
                                        Empleados eliminados
                                    </a>
                                </li>
                            @endif
                            @if( p(20) )
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('department.index') }}" tabindex="-1">
                                        <i class="fa fa-tag"></i>
                                        Departamentos
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if( p(124) OR p(127) OR p(130) OR p(133) )
                    <li>
                        <a href="#" class="trigger-dropdown">Reportes</a>
                        <ul class="dropdown-menu">
                            @if(p(124))
                                <li>
                                    <a href="{{ route('report.money') }}" tabindex="-1">
                                        <i class="fa fa-book"></i>
                                        Corte de caja
                                    </a>
                                </li>
                            @endif
                            @if(p(127))
                                <li>
                                    <a href="{{ route('report.utility') }}" tabindex="-1">
                                        <i class="fa fa-area-chart"></i>
                                        Reporte de utilidades
                                    </a>
                                </li>
                            @endif
                            @if(p(130))
                                <li>
                                    <a href="{{ route('report.service.index') }}" tabindex="-1">
                                        <i class="fa fa-wrench"></i>
                                        Reporte de servicios
                                    </a>
                                </li>
                            @endif
                            @if(p(133))
                                <li>
                                    <a href="{{ route('report.stock') }}" tabindex="-1">
                                        <i class="fa fa-archive"></i>
                                        Reporte de inventario
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if( p(5) )
                    <li>
                        <a href="#" class="trigger-dropdown">
                            Bancos
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('bank.index') }}" tabindex="-1">
                                    <i class="fa fa-list"></i>
                                    Lista de bancos
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bank.trash') }}" tabindex="-1">
                                    <i class="fa fa-trash"></i>
                                    Bancos eliminados
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if( p(1) OR p(3) OR p(49) )
                    <li>
                        <a href="#" class="trigger-dropdown">
                            Administrar
                        </a>
                        <ul class="dropdown-menu">
                            @if( p(3) )
                                <li>
                                    <a href="{{ route('company.show', 1) }}" tabindex="-1">
                                        <i class="fa fa-bank"></i>
                                        Datos de la empresa
                                    </a>
                                </li>
                            @endif
                            @if( p(1) )
                                <li>
                                    <a href="{{ route('configuration.show', 1) }}" tabindex="-1">
                                        <i class="fa fa-globe"></i>
                                        Variables globales
                                    </a>
                                </li>
                            @endif
                            @if( p(49) )
                                <li>
                                    <a href="{{ route('permission.index') }}" tabindex="-1">
                                        <i class="fa fa-key"></i>
                                        Permisos
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <div class="session">
            <div class="profile">
                {{ Auth::user()->username }}
            </div>
            <div class="picture">
                <img src="{{ asset( Auth::user()->profile->photo ) }}" alt=""/>
            </div>
            <div class="options">
                <a href="{{ route('auth.logout') }}" title="Cerrar sesión" class="btn-logout">
                    <i class="fa fa-power-off"></i>
                </a>
            </div>

        </div>
    </div>
</header>
