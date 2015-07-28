@include('layouts.partials.style_print')

<div class="text-left">
    <div class="subtitle_mark">Producto en soporte</div>

    <ul>
        <li>
            <strong>No.</strong>
            {{ $product->id }}
        </li>
        <li>
            <strong>Estado:</strong>
            {{ $product->status }}
        </li>
        <li>
            <strong>Producto:</strong>
            {{ $product->product->barcode }}
        </li>
        <li>
            <strong>Descripción corta del producto:</strong>
            {{ $product->product->s_description }}
        </li>
        <li>
            <strong>Movimientos:</strong>
        </li>
    </ul>

    @include('support.partials.list_movements')

    <ul>
        <li>
            <strong>Observaciones:</strong>
            {{ $product->observations }}
        </li>
        <li>
            <strong>Registrado el</strong>
            {{ $product->created_at->format('h:i A d-m-Y') }}
        </li>
    </ul>

    @if(empty($movement->class_row_series))

        @if($product->authorized_by)

            <div class="col col100">

                <div class="flo col50 left">
                    <div class="subtitle_mark">Autorización</div>

                    <ul>
                        <li>
                            <strong>Entregado por:</strong>
                            {{ $product->givenBy->profile->full_name }}
                        </li>
                        <li>
                            <strong>Recibido por:</strong>
                            {{ $product->receivedBy->profile->full_name }}
                        </li>
                        <li>
                            <strong>Autorizado por:</strong>
                            {{ $product->authorizedBy->profile->full_name }}
                        </li>
                    </ul>
                </div>

                @if($product->dev_authorized_by)
                    <div class="flo col50 right">
                        <div class="subtitle_mark">Entrega</div>

                        <ul>
                            <li>
                                <strong>Entregado por:</strong>
                                {{ $product->devGivenBy->profile->full_name }}
                            </li>
                            <li>
                                <strong>Recibido por:</strong>
                                {{ $product->devReceivedBy->profile->full_name }}
                            </li>
                            <li>
                                <strong>Autorizado por:</strong>
                                {{ $product->devAuthorizedBy->profile->full_name }}
                            </li>
                        </ul>
                    </div>
                @endif

            </div>

        @endif

    @else
        <p class="title-clear">
            Para autorizar este movimiento es necesario registrar los números de serie.
        </p>
    @endif
</div>