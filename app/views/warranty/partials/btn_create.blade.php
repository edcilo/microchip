@if(p(120))
    <a class="btn-green openDialog" href="{{ route('warranty.create') }}">
        <i class="fa fa-sign-in"></i> Registrar nueva garantía
    </a>
@else
    &nbsp;
@endif