$(function () {
    hide_show();
    cheques_bank();
});

var cheques_bank = function () {
    'use strict';

    var s_b = $('#bank_id'),
        s_c = $('#cheques_list'),
        s_ch = $('#cheque_id');

    s_b.change(function () {
        var url = $(this).data('url').replace('BANK_ID', $(this).val());

        $.get(url, '', function (cheques) {
            var list = '';

            s_ch.find('option[value!=""]').remove();

            if (cheques.length > 0) {
                for (var i=0; i<cheques.length; i++) {
                    list += '<option value="'+cheques[i].id+'">'+cheques[i].folio+' ($ '+cheques[i].amount+')</option>';
                }
            } else {
                list += '';
            }

            s_ch.append(list);
            s_c.show();
        }, 'json');
    });
};

var hide_show = function () {
    'use strict';

    var s = $('#type'),
        i_c = $('#cheque_show_hide'),
        i_n = $('#notes_show_hide'),
        i_o = $('#other_show_hide'),
        i_d = $('#transfer_show_hide'),
        c = $('#elements_hide_show');

    s.change(function () {
        var v = $(this).val(), e, es;

        i_o.hide();
        i_c.hide();
        i_n.hide();
        i_d.hide();

        es = c.find('select');
        es.removeAttr('data-required');
        es = c.find('input');
        es.removeAttr('data-required');

        if (v == 'Cheque') {
            i_c.show();
            e = i_c.find('select');
        } else if (v == 'Nota de crédito') {
            i_n.show();
            e = i_n.find('input');
        } else if (v == 'Otro') {
            i_o.show();
            e = i_o.find('input');
        } else if (v == 'Transferencia') {
            i_d.show();
            e = i_d.find('input');
        }

        if (e!=undefined) {
            e.attr('data-required', 'required');
        }
    });
};