@if( p(91) )

    @foreach($sale->comments as $comment)

        @if ($comment->suggestion)
            <div class="col col100 row">

                <div class="subtitle col col100">

                    <div class="flo col60 left">
                        <strong>{{ $comment->user->profile->full_name }}</strong>
                    </div>

                </div>

                <div class="flo col90">

                    {{ $comment->comment }}

                </div>

                <div class="text-right">
                    <small>{{ $comment->created_at->format('h:m:i a, d-m-Y') }}</small>
                </div>

            </div>
        @endif

    @endforeach

@endif
