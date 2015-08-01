@if (!$purchase->progress_1)

    {{ Form::open(['route' => ['purchase.payments.stop', $purchase->id]]) }}

    <button type="submit" class="btn-red">
        <i class="fa fa-ban"></i>
        Terminar la edicion de pagos
    </button>

    {{ Form::close() }}

@endif