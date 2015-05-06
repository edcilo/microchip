@if( p(32) AND $user->active )

    <a class="btn-green" href="{{ route('user.pay', [$user->id]) }}" title="Pagar">
        <i class="fa fa-money"></i>
    </a>

    @endif
