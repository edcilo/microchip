@include('layouts.partials.style_print')

@include('layouts.partials.bill_header')

<style>
    .font-body {
        font-size: 14px;
    }
</style>

<div class="font-body">
    <p class="text-left">
        {{ $company->city }}, {{ $company->state }} a {{ \Carbon\Carbon::now()->format('d-m-Y, H:ia') }}.
    </p>

    <p class="text-left">
        Recibi de {{ $sale->customer->name }}
        la cantidad de ${{ number_format($quantity, 2, '.', ',') }}
        ({{ $amount_text }}) por concepto de abono al {{ $sale->classification }}
        no. {{ $sale->folio }}.
    </p>

    <p class="text-left">
        Saldo restante al dia de {{ $pay->created_at->format('d-m-Y, H:ia') }} de ${{ $rest }}
    </p>

    <br>
    <br>

    Recibí

    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="line_sign"></div>
    {{ $sale->user->profile->full_name }}

</div>