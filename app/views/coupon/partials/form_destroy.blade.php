@if ( p(116) )
    <hr/>

    {{ Form::open(['route'=>['coupon.destroy', $coupon->id], 'method'=>'delete', 'class'=>'form']) }}
    <div class="row text-right">
        <button class="btn-red"><i class="fa fa-times"></i> Eliminar vale</button>
    </div>
    {{ Form::close() }}
@endif
