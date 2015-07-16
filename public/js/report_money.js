$(function () {
    calculator();
});

var calculator = function () {
    'use strict';

    var total_r   = parseFloat($('#total_report').data('total')),
        inputs    = $('.demon_quantity'),
        c_t_d     = $('.total_d'),
        total_box = $('.total_box'),
        total_out = $('.total_out'),
        c_msg     = $('.msg_dialog'),
        msg       = '',
        total     = 0;

    inputs.keyup(function () {
        var t_b = 0,
            t_o = 0;

        inputs.each(function (index) {
            var val   = parseFloat($(this).val()),
                t_d   = 0,
                denom = $(this).data('value');

            if (denom === '05') {
                denom = 0.5;
            }

            denom = parseFloat(denom);

            if (isNaN(val)) {
                val = 0;
            }
            if (isNaN(denom)) {
                denom = 0;
            }

            t_d = val*denom;

            if (isNaN(t_d)) {
                t_d = 0;
            }

            t_d = parseFloat(t_d).toFixed(2);
            $(c_t_d[index]).text(t_d)

            if ($(this).hasClass('d_b')) {
                t_b += val * denom;
            } else {
                t_o += val * denom;
            }
        });

        total_box.text( parseFloat(t_b).toFixed(2) );
        total_out.text( parseFloat(t_o).toFixed(2) );
        total = t_b + t_o;

        if (total_r == total) {
            msg = 'Los resultados coinciden';
        } else if (total_r > total) {
            msg = 'Hay mas efectivo en caja';
        } else {
            msg = 'Hay menos efectivo en caja';
        }
        c_msg.text(msg).show();
    });
};