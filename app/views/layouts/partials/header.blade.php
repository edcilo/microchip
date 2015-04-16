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
                    @if( p(63) )
                        <li><a href="{{ Route('customer.index') }}">Clientes</a></li>
                    @endif
                    @if( p(71) )
                        <li><a href="{{ Route('pay.index') }}">Pagos</a></li>
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