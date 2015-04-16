@if( p(19) )

    <a class="btn-red btn-delete" href="#" data-id="{{ $count->id }}" data-name="{{ $count->status }} por ${{ $count->amount }} del {{ $count->date }}">
        <i class="fa fa-times"></i>
    </a>

@endif