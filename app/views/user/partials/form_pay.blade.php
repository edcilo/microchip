{{ Form::open(['route'=>['user.pay', $user->id], 'method'=>'get']) }}

<button class="btn-green form_confirm" data-confirm="pay_confirm">
    <i class="fa fa-money"></i>
    Pagar
</button>

{{ Form::close() }}

<div class="confirm-dialog hide" title="Pagar" id="pay_confirm" data-width="400">
    <div class="mesasge text-center">
        <p>¿Estas seguro de querer registrar el pago al empleado <strong>{{ $user->profile->full_name }}</strong>?</p>
    </div>
</div>