$(function () {
    show_dialog_series('.add-series', '#series_alert');
});

var add_form = function (content, quantity, product_id, movement_id, purchase_id) {
    var inputs = '<div class="row message_hide"><strong>Agregar números de serie:</strong></div>';
    for (var i=0; i<quantity; i++) {
        inputs += '<form class="form validate form_store_series">';
        inputs +=   '<div class="row col col100 text-center">';
        inputs +=       '<div class="flo col80">'
        inputs +=           '<input name="product_id" type="hidden" value="'+product_id+'">';
        inputs +=           '<input name="inventory_movement_id" type="hidden" value="'+movement_id+'">';
        inputs +=           '<input name="purchase_id" type="hidden" value="'+purchase_id+'">';
        inputs +=           '<input autofocus="autofocus" type="text" name="ns[]" class="xb-input text-uppercase" placeholder="Número de serie" autocomplete="off" title="Este campo es obligatorio." data-required="required" data-error="0">';
        inputs +=       '</div>';
        inputs +=       '<div class="flo col20">'
        inputs +=           '<button type="submit" class="btn-green" title="Agregar número de serie"><i class="fa fa-plus"></i></button>'
        inputs +=       '</div>';
        inputs +=   '</div>';
        inputs += '</form>';
    }

    content.append(inputs);
};

var add_list = function (content, series) {
    'use strict';

    var list = '<strong>Números de serie en esta compra:</strong>';
    list += '<ul id="list_series_stored">';
    if (series.length == 0) {
        list += '<li class="message_hide_init">No hay ningún número de serie registrado</li>';
    }
    for (var i = 0; i < series.length; i++) {
        list += '<li>';
        list +=  series[i].ns + ' [' + series[i].status + ']';
        //list += '<a href="http://microchip.loc/series/39/print" target="_blank" class="btn-blue" title="Imprimir código de barras"> <i class="fa fa-print"></i></a>';
        list += '</li>';
    }
    list += '</ul>';

    content.prepend(list);
};

var show_dialog_series = function (button, dialog) {
    'use strict';

    var b = $(button);

    b.click(function (e) {
        e.preventDefault();

        var e_d = $(dialog),
            barcode = $(this).data('barcode'),
            movement_id = $(this).data('movement'),
            quantity = $(this).data('quantity'),
            product_id = $(this).data('product');

        //e_d.attr('title', e_d.attr('title').replace('PRODUCT_BARCODE', barcode));

        get_series(e_d.find('.series_added'), movement_id, quantity, product_id, $(this));

        e_d.dialog({
            autoOpen: false,
            width: e_d.data('width'),
            modal: true
        });

        e_d.dialog('open');
    });
};

var get_series = function (content, movement_id, quantity, product_id, button) {
    'use strict';

    var c = content,
        url = c.data('url').replace('MOVEMENT_ID', movement_id),
        url_store = c.data('form'),
        purchase_id = c.data('purchase'),
        total = quantity;

    c.html('');

    $.get(url, '', function(series) {
        add_list(c, series);

        quantity -= series.length;
        if (quantity > 0) {
            add_form(c, quantity, product_id, movement_id, purchase_id);
        }

        store_series('.form_store_series', url_store, '#series_form_errors', '#list_series_stored', total, button);
    }, 'json');
};

var store_series = function (form, url, content_errors, list, total, button) {
    'use strict';

    var c = $(form),
        c_errors = $(content_errors),
        list = $(list);

    c.submit(function (e) {
        e.preventDefault();

        var f = $(this);

        $.post(url, $(this).serialize(), function (json) {
            if (json['code'] == 304) {
                c_errors.html('<span>'+json['ns']+'</span>');
            } else {
                c_errors.html('');
                c.parent('tr').removeClass('red');

                var data = json['data'];

                $('.message_hide_init').remove();
                list.append('<li>'+data[0].ns+' ['+data[0].status+']</li>');

                setTimeout (function () {
                    f.remove();
                }, 100);

                var stored = list.children('li').size();
                if (total == stored) {
                    $('.message_hide').remove();
                    button.parents('tr').removeClass('red')
                }
            }
        }, 'json');

    });
};