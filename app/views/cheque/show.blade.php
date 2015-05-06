@extends('layouts/layout_sist')

@section('title') / {{ $cheque->folio }}@stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

<div class="col col100">
    <div class="flo col30">&nbsp;</div>

    <div class="flo col40 text-right">
        <a class="btn-blue" href="{{ route('bank.show', [$cheque->bank->slug, $cheque->bank->id, 1]) }}">
            <i class="fa fa-list"></i> Volver a {{ $cheque->bank->name }}
        </a>
    </div>

    <div class="flo col30 text-right">
        @include('bank.partials.form_search')
    </div>
</div>

<div class="col col100 block description-product">

    <div class="header">
        <h1>Folio: {{ $cheque->folio }}</h1>
        @if ( $cheque->active )
        <a class="btn-yellow" href="{{ route('cheque.edit', [$cheque->folio, $cheque->id]) }}"><i class="fa fa-pencil"></i></a>
        @endif
    </div>

    <div class="col col100 row">

        <div class="flo col25">
            <strong>Banco: </strong> <br/>
            {{ $cheque->bank->name }}
        </div>

        <div class="flo col25">
            <strong>Sucursal: </strong> <br/>
            {{ $cheque->bank->branch }}
        </div>

        <div class="flo col25">
            <strong>Numero de cuenta: </strong> <br/>
            {{ $cheque->bank->number_account }}
        </div>

        <div class="flo col25">
            <strong>CLABE: </strong> <br/>
            {{ $cheque->bank->clabe }}
        </div>

    </div>

    <div class="col col100 row">
        <hr/>

        <div class="flo col33 left">
            <strong>Folio: </strong> <br/>
            {{ $cheque->folio }}
        </div>

        <div class="flo col33 center">
            <strong>Estado: </strong> <br/>
            {{ $cheque->status }}
        </div>

        <div class="flo col33">
            <strong>Fecha de pago: </strong> <br/>
            {{ $cheque->payment_date_f }}
        </div>

    </div>

    <div class="col col100 row">

        <div class="flo col33 left">
            <strong>Monto:</strong>
            {{ $cheque->amount }}
        </div>

        <div class="flo col33 center">
            <strong>Paguese a:</strong>
            {{ $cheque->receiver }}
        </div>

        <div class="flo col33 right">
            <strong>Concepto:</strong>
            {{ $cheque->concept }}
        </div>

    </div>

    <div class="col col100 row">
        <strong>Observaciones:</strong>
        {{ $cheque->observations }}
    </div>

</div>

@stop
