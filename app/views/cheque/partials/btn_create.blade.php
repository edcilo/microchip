@if( p(12) )
    <a class="btn-green openDialog" href="{{ route('cheque.create', [$bank->id]) }}">
        <i class="fa fa-sign-in"></i>
        Registrar cheques
    </a>

    @include('cheque.partials.form_create_float')
@endif
