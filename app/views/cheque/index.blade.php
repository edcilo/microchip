@if( p(11) )
    <div class="col col100 block description-product">

        <div class="header">
            <h3>Cheques</h3>

            @include('cheque.partials.btn_create')
        </div>

        <div class="subtitle col col100 ">
            <div class="flo col50 left text-center">
                @include('cheque.partials.btn_index')
            </div>

            <div class="flo col50 right text-center">
                @include('cheque.partials.btn_index_trash')
            </div>
        </div>

        <div class="flo col100 subtitle">
            @include('cheque.partials.form_filter')
        </div>

        <hr/>

        @if ( $list )

            @if ( count($cheques) > 0 )

                @include('cheque.partials.list_paginate')

                @include('cheque.partials.form_trash')

            @else

                <p class="title-clear">No hay cheques registrados.</p>

            @endif

        @else

            @if ( count($cheques) > 0 )

                @include('cheque.partials.list_paginate_trash')

                @include('cheque.partials.form_active')

            @else

                <p class="title-clear">No hay cheques en la papelera.</p>

            @endif

        @endif

    </div>
@endif
