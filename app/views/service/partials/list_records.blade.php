@if( p(91) )

    @foreach($sale->comments as $comment)

        <div class="col col100 row">

            <div class="subtitle col col100">

                <div class="flo col60 left">
                    <strong>{{ $comment->user->profile->full_name }}</strong>
                    @if($comment->suggestion)
                        (sugerencia)
                    @endif
                </div>

                <div class="flo col40 right text-right">
                    <small>{{ $comment->created_at->format('h:m:i a, d-m-Y') }}</small>
                </div>

            </div>

            <div class="flo col90">

                {{ $comment->comment }}

            </div>

            <div class="flo col10 text-right">

                @include('service.partials.btn_print_record')

            </div>

        </div>

    @endforeach

@endif
