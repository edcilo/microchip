@foreach($sale->order_products as $movement)

    <div class="tr @if(!$movement->support_id) green @else blue @endif">
        <div class="flo col40">
            <div class="flo col10 left text-right">
                {{ $movement->quantity }}
            </div>
            <div class="flo col40 center">
                {{ $movement->product->barcode }}
            </div>
            <div class="flo col50 center">
                {{ $movement->product->s_description }}
            </div>
        </div>
        <div class="flo col10 text-right center">
            <nobr>$ {{ $movement->selling_price_f }}</nobr>
        </div>
        <div class="flo col10 text-right center">
            <nobr>$ {{ $movement->total_f }}</nobr>
        </div>
        <div class="flo col40 text-center right">
            <div class="flo col20 text-center center">
                <i class="fa fa-check"></i>
            </div>

            <div class="flo col20 text-center center">
                <i class="fa fa-check"></i>
            </div>

            <div class="flo col20 text-center center">
                <a href="{{ route('pas.show', $movement->pending_movement_id) }}" title="Ver detalles de surtido">
                    <i class="fa fa-check"></i>
                </a>

                @if($movement->product->type == 'Producto')
                    @if($movement->product->p_description->have_series)
                        <a href="{{ route('series.create.separate', [$movement->id]) }}" class="btn-green">N/S</a>
                    @endif
                @endif
            </div>

            <div class="flo col20 text-center center">

                @if($movement->product->type != 'Servicio' AND p(103) )
                    @if(!$movement->admin_id)
                        <a href="{{ route('order.product.support', $movement->id) }}" class="btn-green" title="Subir a soporte">
                            <i class="fa fa-arrow-up"></i>
                        </a>
                    @endif
                @else
                    @if($movement->admin_id)
                        <i class="fa fa-check"></i>
                    @else
                        &nbsp;
                    @endif
                @endif

            </div>
            <div class="flo col20 text-center right">
                @if(!$movement->admin_id AND p(95))
                    {{ Form::open(['route'=>['pas.destroy', $movement->pending_movement_id], 'method'=>'delete', 'class'=>'form validate inline']) }}
                    <button type="submit" class="btn-red form_confirm" data-confirm="disorder_movement_confirm_{{ $movement->id }}">
                        <i class="fa fa-times"></i>
                    </button>
                    {{ Form::close() }}

                    <div class="confirm-dialog hide" title="Regresar producto a cotizado" id="disorder_movement_confirm_{{ $movement->id }}" data-width="400">
                        <div class="mesasge text-center">
                            <h3>¿Estas seguro de querer devolver el producto {{ $movement->product->barcode }} a cotizado?</h3>
                        </div>
                    </div>
                @elseif( $movement->admin_id AND p(103) )
                    <a href="{{ route('order.product.support', $movement->id) }}" class="btn-red" title="Bajar de soporte">
                        <i class="fa fa-arrow-down"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>

@endforeach
