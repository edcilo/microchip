$(function () {
    //show_dialog_series('.add-series', '#series_alert');
    generate_series('#generator_button_series', '.input_series');
});

var add_form = function (content, quantity, product_id, movement_id, purchase_id) {
    var inputs = '<div class="row message_hide"><strong>Agregar números de serie:</strong></div>';
    for (var i=0; i<quantity; i++) {
        inputs += '<form class="form validate form_store_series">';
        inputs +=   '<div class="row col col100 text-center">';
        inputs +=       '<div class="flo col80">';
        inputs +=           '<input name="product_id" type="hidden" value="'+product_id+'">';
        inputs +=           '<input name="inventory_movement_id" type="hidden" value="'+movement_id+'">';
        inputs +=           '<input name="purchase_id" type="hidden" value="'+purchase_id+'">';
        inputs +=           '<input autofocus="autofocus" type="text" name="ns[]" class="xb-input text-uppercase" placeholder="Número de serie" autocomplete="off" title="Este campo es obligatorio." data-required="required" data-error="0">';
        inputs +=       '</div>';
        inputs +=       '<div class="flo col20">';
        inputs +=           '<button type="submit" class="btn-green" title="Agregar número de serie"><i class="fa fa-plus"></i></button>';
        inputs +=       '</div>';
        inputs +=   '</div>';
        inputs += '</form>';
    }

    content.append(inputs);
};

var add_list = function (content, series) {
    'use strict';

    var url_print = content.data('print'),
        url_print_all = content.data('printall'),
        list = '<div class="col col100">';

    if (series.length > 0) url_print_all = url_print_all.replace('MOVEMENT_ID', series[0].inventory_movement_id);
    list += '<div class="flo col80"><strong>Números de serie en esta compra:</strong></div>';
    list += '<div class="flo col20 text-right"><a class="btn-blue ';
    if (series.length == 0) {
        list += 'hide';
    }
    list += '" href="'+url_print_all+'" target="_blank" title="Imprimir todos los números de serie de esta compra"><i class="fa fa-print"></i></a></div>';
    list += '</div>';
    list += '<table class="table" id="list_series_stored">';
    if (series.length == 0) {
        list += '<tr class="message_hide_init">';
        list += '<th>No hay ningún número de serie registrado</th>';
        list += '</tr>';
    }
    for (var i = 0; i < series.length; i++) {
        url_print = url_print.replace('SERIES_ID', series[i].id);

        list += '<tr>';
        list += '<td>';
        list +=  series[i].ns + ' [' + series[i].status + ']';
        list += '</td>';
        list += '<td class="text-right">';
        list += '<a href="'+url_print+'" class="btn-blue" target="_blank" title="Imprimir número de serie '+series[i].ns+'"><i class="fa fa-print"></i></a> ';
        list += get_form(content.data('destroy'), series[0].id);
        list += '</td>';
        list += '</tr>';
    }
    list += '</table>';

    content.prepend(list);
};

var generate_series = function (button_id, inputs) {
    'use strict';

    var b = $(button_id),
        i = $(inputs),
        folio = b.data('folio'),
        provider = b.data('provider'),
        model = replace_specials(b.data('model'));

    b.click(function (e) {
        e.preventDefault();

        var folio = $(this).data('folio'),
            q = i.size().toString().length;

        i.each(function (index) {
            var ns = folio + '.' + provider + '.' + model + '.' + pad(index + 1, q);
            $(this).val(ns);
        });

    });
};

var get_form = function (url, series_id) {
    'use strict';

    var form = '<form class="inline" action="';
    form += url.replace('SERIES_ID', series_id);
    form += '" method="post">';
    form += '<input name="_method" type="hidden" value="DELETE">';
    form += '<button type="submit" class="btn-red"><i class="fa fa-times"></i></button>';
    form += '</form>';

    return form;
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

        store_series('.form_store_series', url_store, '#series_form_errors', '#list_series_stored', total, button, c.data('print'));
    }, 'json');
};

var store_series = function (form, url, content_errors, list, total, button, url_print) {
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

                url_print = url_print.replace('SERIES_ID', data[0].id);
                var row = '<tr>';
                row += '<td>';
                row +=  data[0].ns + ' [' + data[0].status + ']';
                row += '</td>';
                row += '<td class="text-right">';
                row += '<a href="'+url_print+'" class="btn-blue" target="_blank" title="Imprimir código de barras"><i class="fa fa-print"></i></a> ';
                row += '</td>';
                row += '</tr>';
                list.append(row);

                setTimeout (function () {
                    f.remove();
                }, 100);

                var stored = list.find('tr').size();
                if (total == stored) {
                    $('.message_hide').remove();
                    button.parents('tr').removeClass('red')
                }
            }
        }, 'json');

    });
};