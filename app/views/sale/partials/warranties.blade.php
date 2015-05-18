@if( count($sale->warranties))
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            Productos en garantía:
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="edc-hide-show-element col col100">

            @include('warranty.partials.list_paginate', ['warranties' => $sale->warranties()->paginate()])

            @include('warranty.partials.form_destroy_float')

        </div>

    </div>
@endif
