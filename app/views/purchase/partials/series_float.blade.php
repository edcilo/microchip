<div title="Números de serie de PRODUCT_BARCODE" class="form" id="series_alert" data-width="400">

    <div class="message-error" id="series_form_errors"></div>

    <div class="series_added" data-destroy="{{ route('series.destroy', 'SERIES_ID') }}" data-printall="{{ route('series.purchase.print', 'MOVEMENT_ID') }}" data-print="{{ route('series.print', 'SERIES_ID') }}" data-url="{{ route('movement.get.series', 'MOVEMENT_ID') }}" data-purchase="{{ $purchase->id }}" data-form="{{ route('series.purchase.store') }}"></div>

</div>
