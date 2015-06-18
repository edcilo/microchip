<header>
    <div class="cont1366">
        <figure class="logo">
            <img class="img-responsive" src="{{ asset('images/sist/logo1.png') }}" alt="Logotipo de Microchip"/>
        </figure>
        <div class="nav">
            <ul>
                <li><a href="{{ Route('home.sale') }}">Inicio</a></li>
                @if( p(75) )
                    <li><a href="{{ Route('pay.pending') }}">Caja</a></li>
                @endif
                @if( p(76) )
                    <li><a href="{{ route('sale.index') }}">Ventas</a></li>
                @endif
                @if( p(84) )
                    <li><a href="{{ Route('order.index') }}">Pedidos</a></li>
                @endif
                @if( p(93) )
                    <li><a href="{{ Route('service.index') }}">Servicios</a></li>
                @endif
                @if( p(105) )
                    <li><a href="{{ Route('price.index') }}">Cotizaciones</a></li>
                @endif
                @if( p(71) )
                    <li><a href="{{ Route('pay.index') }}">Pagos</a></li>
                @endif
                @if( p(63) )
                    <li><a href="{{ Route('customer.index') }}">Clientes</a></li>
                @endif
                @if( p(24) )
                    <li><a href="{{ Route('user.index') }}">Empleados</a></li>
                @endif
                @if( p(35) )
                    <li><a href="{{ route('provider.index') }}">Proveedores</a></li>
                @endif
                @if(p(60))
                    <li><a href="{{ route('purchase.index') }}">Compras</a></li>
                @endif
                @if( p(54) )
                    <li><a href="{{ route('product.index.product') }}">Productos</a></li>
                    <li><a href="{{ route('product.index.service') }}">Servicios</a></li>
                @endif
            </ul>
        </div>
        <div class="session">
            <div class="profile">
                {{ Auth::user()->username }}
            </div>
            <div class="options">
                <div class="optionList">
                    <a href="#" class="icon">
                        <span></span>
                    </a>
                    <div class="list globe-right">
                        <ul>
                            @if( p(111) )
                                <li>
                                    <a href="{{ route('pas.index') }}">
                                        <i class="fa fa-tag"></i>
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
                            @if( p(134) )
                                <li>
                                    <a href="{{ route('concept.index') }}">
                                        <i class="fa fa-list-ul"></i>
                                        Conceptos de gastos
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
                                <li>
                                    <hr/>
                                </li>
                            @if(p(118))
                                <li>
                                    <a href="{{ route('coupon.purchase.index') }}">
                                        <i class="fa fa-ticket"></i>
                                        Notas de crédito
                                    </a>
                                </li>
                            @endif
                            <li>
                                <hr/>
                            </li>
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
                                <li>
                                    <hr/>
                                </li>
                                @if( p(5) )
                                        <li>
                                            <a href="{{ route('bank.index') }}">
                                                <i class="fa fa-list"></i>
                                                Lista de bancos
                                            </a>
                                        </li>
                                @endif
                                <li>
                                    <hr/>
                                </li>
                                @if(p(124))
                                    <li>
                                        <a href="{{ route('report.money') }}">
                                            <i class="fa fa-book"></i>
                                            Corte de caja
                                        </a>
                                    </li>
                                @endif
                                @if(p(127))
                                    <li>
                                        <a href="{{ route('report.utility') }}">
                                            <i class="fa fa-area-chart"></i>
                                            Reporte de utilidades
                                        </a>
                                    </li>
                                @endif
                                @if(p(130))
                                    <li>
                                        <a href="{{ route('report.service.index') }}">
                                            <i class="fa fa-wrench"></i>
                                            Reporte de servicios
                                        </a>
                                    </li>
                                @endif
                                @if(p(133))
                                    <li>
                                        <a href="{{ route('report.stock') }}">
                                            <i class="fa fa-archive"></i>
                                            Reporte de inventario
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <hr/>
                                </li>
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
                                <li>
                                    <hr/>
                                </li>
                            <li>
                                <a href="{{ route('auth.logout') }}">
                                    <i class="fa fa-power-off"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="picture">
                <img src="{{ asset( Auth::user()->profile->photo ) }}" alt=""/>
            </div>
        </div>
    </div>
</header>
