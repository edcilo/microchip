<ul>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Caja anterior:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['caja_anterior'], 2, '.', ',') }}
        </div>
    </li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Cobro en efectivo:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['total_cash'], 2, '.', ',') }}
        </div>
    </li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Gastos:</strong>
        </div>
        <div class="flo col50 right text-right">
            @if(isset($corte))
                $
                @if (is_object($corte->pay))
                    {{ number_format($report['total_expenses'] + (-1 * $corte->pay->amount), 2, '.', ',') }}
                @else
                    {{ number_format($report['total_expenses'], 2, '.', ',') }}
                @endif
            @else
                $ {{ number_format($report['total_expenses'], 2, '.', ',') }}
            @endif
        </div>
    </li>
    <li><hr/></li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Total en caja:</strong>
        </div>
        <div class="flo col50 right text-right">
            @if(isset($corte))
                $
                @if (is_object($corte->pay))
                    <span id="total_report" data-total="{{ $report['total_box'] + (-1 * $corte->pay->amount) }}">{{ number_format($report['total_box'] + (-1 * $corte->pay->amount), 2, '.', ',') }}</span>
                @else
                    <span id="total_report" data-total="{{ $report['total_box'] }}">{{ number_format($report['total_box'], 2, '.', ',') }}</span>
                @endif
            @else
                $ <span id="total_report" data-total="{{ $report['total_box'] }}">{{ number_format($report['total_box'], 2, '.', ',') }}</span>
            @endif
        </div>
    </li>
    @if(isset($corte))
        <li class="col col100">
            <div class="flo col50 left">
                <strong>Retiro por corte:</strong>
            </div>
            <div class="flo col50 right text-right">
                $
                @if (is_object($corte->pay))
                    {{ $corte->pay->amount }}
                @else
                    0.00
                @endif
            </div>
        </li>
    @endif
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Queda en caja:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ <span class="total_in_box">{{ number_format($report['total_box'], 2, '.', ',') }}</span>
        </div>
    </li>
    <li><hr/></li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Cobro con tarjeta de crédito/debito:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['total_credit_card'], 2, '.', ',') }}
        </div>
    </li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Cobro con tranferencias:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['total_transfers'], 2, '.', ',') }}
        </div>
    </li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Cobro con cheque:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['total_cheques'], 2, '.', ',') }}
        </div>
    </li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Cobro con vales:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['total_coupons'], 2, '.', ',') }}
        </div>
    </li>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Cobro con monedero electronico:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['total_card'], 2, '.', ',') }}
        </div>
    </li>
</ul>