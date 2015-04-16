@if ( Session::get('success') )
    <aside class="msg_dialog success">{{ Session::get('success') }}</aside>
@endif

@if ( Session::get('error') )
    <aside class="msg_dialog error">{{ Session::get('error') }}</aside>
@endif

@if ( Session::get('alert') )
    <aside class="msg_dialog alert">{{ Session::get('alert') }}</aside>
@endif