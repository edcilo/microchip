@if( p(7) AND $bank->active )
    <a class="btn-yellow" href="{{ route('bank.edit', [$bank->slug, $bank->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>
@endif