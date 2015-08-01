@if ($purchase->progress_1)

    {{ Form::open(['route'=>['purchase.payments.edit', $purchase->id]]) }}

    <button type="submit" class="btn-yellow">
        <i class="fa fa-pencil"></i>
        Editar pagos
    </button>

    {{ Form::close() }}

@endif