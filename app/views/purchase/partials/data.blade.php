<div class="col col100 block description-product">

    <div class="header">
        <h1>

            @if ( $purchase->progress_1 AND $purchase->progress_2 AND $purchase->progress_3 AND !$purchase->progress_4 )
                <i title="Factura validada" class="fa fa-check"></i>
            @else
                <i title="Factura en revisión" class="fa fa-times"></i>
            @endif

            Folio: {{ $purchase->folio }}

        </h1>

        @include('purchase.partials.btn_edit')
    </div>

    <div class="col col100">

        <div class="flo col50">
            <ul class="description-list">
                <li>
                    <strong>Proveedor: </strong>
                    <a href="{{ route('provider.show', [$purchase->provider->slug, $purchase->provider->id]) }}">{{ $purchase->provider->name }}</a>
                </li>
                <li>
                    <strong>Número de folio: </strong>
                    {{ $purchase->folio }}
                </li>
                <li>
                    <strong>Estado:</strong>
                    {{ $purchase->status }}
                </li>
                <li>
                    <strong>Fecha de factura:</strong>
                    {{ $purchase->date }}
                </li>
            </ul>
        </div>

        <div class="flo col50">
            <ul class="description-list text-right">
                <li>
                    <strong>Fecha de registro:</strong>
                    {{ $purchase->reception_date }}
                </li>
                <li>
                    <strong>Capturista:</strong>
                    <a href="{{ route('user.show', [$purchase->user->slug, $purchase->user->id]) }}">
                        {{ $purchase->user->profile->name }}
                        {{ $purchase->user->profile->f_last_name }}
                        {{ $purchase->user->profile->s_last_name }}
                    </a>
                </li>
                <li>
                    @if ( $purchase->bill_scan != '' )
                        <strong>Descargar factura escaneada:</strong>
                        @include('purchase.partials.btn_download')
                    @endif

                    @include('purchase.partials.btn_upload')
                </li>
            </ul>
        </div>

    </div>

</div>
