@foreach($order->comments as $comment)

    <div class="col col100 row">

        <div class="subtitle col col100">

            <div class="flo col60 left">
                <strong>{{ $comment->user->profile->full_name }}</strong>
            </div>

            <div class="flo col40 right text-right">
                <span>{{ $comment->created_at->format('h:m:i a, d-m-Y') }}</span>
            </div>

        </div>

        {{ $comment->comment }}

    </div>
@endforeach
