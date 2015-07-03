<div class="col col100 description-product hide" id="product_show_details">

    <div class="subtitle_mark">
        <strong class="barcode"></strong>
    </div>

    <div class="col col100">
        <div class="flo col20">&nbsp;</div>
        <figure class="flo col60" style="margin-bottom: 6px">
            <img src="#" data-url="{{ url() }}">
        </figure>
        <div class="flo col20">&nbsp;</div>
    </div>

    <div class="col col100">
        <div class="flo col50 left">
            <a href="#" data-url="{{ url() }}" class="btn-green link_download" download title="Descargar ficha técnica">
                <i class="fa fa-download"></i>
            </a>
            &nbsp;
        </div>
        <div class="flo col50 right text-right">
            <a href="#" data-url="{{ route('product.show.min', 'PRODUCT_ID') }}" class="btn-blue open_new_window link_product" target="_blank">
                <i class="fa fa-eye"></i>
            </a>
        </div>
    </div>

    <hr/>

    <ul class="list-description"></ul>

    <strong>Precios (I.V.A. incluido):</strong>

    <ul class="list-prices"></ul>

</div>
