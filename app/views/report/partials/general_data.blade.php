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
            $ {{ number_format($report['total_expenses'], 2, '.', ',') }}
        </div>
    </li>
    <il><hr/></il>
    <li class="col col100">
        <div class="flo col50 left">
            <strong>Total en efectivo:</strong>
        </div>
        <div class="flo col50 right text-right">
            $ {{ number_format($report['total_box'], 2, '.', ',') }}
        </div>
    </li>
    <il><hr/></il>
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