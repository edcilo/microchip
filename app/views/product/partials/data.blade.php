<div class="col col00 form">

    <figure class="flo col25 left row">
        <img src="{{ asset($product->image) }}" alt="{{ $product->barcode }}"/>
    </figure>

    <div class="flo col75 right row">
        <div class="flo col50 left">
            <ul class="list-description">
                <li>
                    <strong>Código de barras: </strong>
                    {{ $product->barcode }}
                </li>
                @if ( is_object($product->p_description) )
                    <li>
                        <strong>Categoría:</strong>
                        <a href="{{ route('category.show', [$product->p_description->category->slug, $product->p_description->category->id]) }}">
                            {{ $product->p_description->category->name }}
                        </a>
                    </li>
                    <li>
                        <strong>Modelo:</strong>
                        {{ $product->p_description->model }}
                    </li>
                    <li>
                        <strong>Marca:</strong>
                        <a href="{{ route('mark.show', [$product->p_description->mark->slug, $product->p_description->mark->id]) }}">
                            {{ $product->p_description->mark->name }}
                        </a>
                    </li>
                    @if ( $product->p_description->box )
                        <li>
                            <strong>Piezas por caja:</strong>
                            {{ $product->p_description->pieces }}
                        </li>
                    @endif
                @endif
                <li>
                    <strong>Días de garantía con el cliente:</strong>
                    {{ $product->warranty }} días.
                </li>
                @if ( is_object($product->p_description) )
                    <li>
                        <strong>Días de garantía con el proveedor:</strong>
                        {{ $product->p_description->provider_warranty }} días.
                    </li>
                    @if ( $product->p_description->data_sheet != '' )
                        <li>
                            <Strong>Ficha técnica:</Strong>
                            <a href="{{ asset($product->p_description->data_sheet) }}" download>
                                <i class="fa fa-download"></i> Descargar
                            </a>
                        </li>
                    @endif
                @endif
                <li>
                    <strong>Descripción corta:</strong>
                    {{ $product->s_description }}
                </li>
            </ul>
        </div>

        <div class="flo col50 right">
            <ul class="list-description">
                @if ( is_object($product->p_description) )
                    <li>
                        <strong>Existencias:</strong>
                        {{ $product->stock }}
                        <ul>
                            <li>
                                <strong>Minimo en stock</strong>
                                {{ $product->p_description->stock_min }}
                            </li>
                            <li>
                                <strong>Maximo en stock</strong>
                                {{ $product->p_description->stock_max }}
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Cuenta con número de serie:</strong>
                        {{ $product->p_description->have_serie }}
                    </li>
                @endif
                <li>
                    <strong>Publicado en página web:</strong>
                    {{ $product->web }}
                </li>
                <li>
                    <strong>Activo:</strong>
                    {{ $product->active_i }}
                </li>
                <li>
                    <strong>Puntos por compra:</strong>
                    {{ $product->points }} %
                </li>
                <li>
                    <strong>Puntos a referido:</strong>
                    {{ $product->r_points }} %
                </li>
                @if ( is_object($product->p_description) )
                    <li>
                        <strong>Proveedor:</strong>
                        {{ $product->p_description->provider }}
                    </li>
                    <li>
                        <strong>Código del proveedor:</strong>
                        {{ $product->p_description->provider_barcode }}
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="flo col100 row">
        <strong>Descripción larga:</strong>
        {{ $product->description }}
    </div>

</div>
