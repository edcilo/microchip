@if( p(61) AND $purchase->status != 'Cancelado' )

    <a class="btn-blue openDialog" href="{{ route('purchase.upload', [$purchase->id]) }}" title="Subir factura escaneada"><i class="fa fa-upload"></i></a>

@endif
