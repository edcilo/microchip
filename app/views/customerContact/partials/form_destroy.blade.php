@if( p(65) )

    {{ Form::open(['route'=>['customer.contact.destroy',  $contact->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button type="submit" class="btn-red"><i class="fa fa-times"></i></button>
    {{ Form::close() }}

    @endif
