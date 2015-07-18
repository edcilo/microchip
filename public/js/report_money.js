$(function () {
    show_results('.demon_quantity');
    
    calculator();
});

var calculator = function () {
    'use strict';

    var inputs = $('.demon_quantity');

    inputs.keyup(function () {
        show_results('.demon_quantity');
    });
};

var show_results = function (e_inps) {
    var inputs = $(e_inps),
        t_b = 0, t_o = 0;

    inputs.each(function (index) {
        var subtotal = row(index, $(this));
        t_b += subtotal[0];
        t_o += subtotal[1];
    });

    print_totals(t_b, t_o);
};

var print_totals = function (t_b, t_o) {
    var total_r      = parseFloat($('#total_report').data('total')),
        total_box    = $('.total_box'),
        total_out    = $('.total_out'),
        total_global = $('.total_global'),
        c_msg        = $('.msg_dialog'),
        msg          = '',
        total        = t_b + t_o;

    total_box.text( parseFloat(t_b).toFixed(2) );
    total_out.text( parseFloat(t_o).toFixed(2) );
    total_global.text( parseFloat(total).toFixed(2) );

    if (total_r == total) {
        msg = 'El resultado del reporte coincide con el especificado en la calculadora.';
    } else if (total_r > total) {
        msg = 'En el reporte se especifica un total en efectivo mayor al especificado en la calculadora.';
    } else {
        msg = 'El total en efectivo del reporte es menor al especificado en la calculadora.';
    }

    c_msg.text(msg).show();
};

var row = function (index, element) {
    var val   = parseFloat(element.val()),
        denom = element.data('value'),
        c_t_d = $('.total_d'),
        c_t_g = $('.total_g'),
        t_b = 0,
        t_o = 0,
        t_d, t_g, e_g;

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
    $(c_t_d[index]).text(t_d);

    if (index%2 == 0) {
        t_g = parseFloat($(c_t_d[index]).text()) + parseFloat($(c_t_d[index + 1]).text());
        e_g = $(c_t_g[index/2]);
    } else {
        t_g = parseFloat($(c_t_d[index]).text()) + parseFloat($(c_t_d[index - 1]).text());
        e_g = $(c_t_g[index/2 - 0.5]);
    }
    e_g.text(parseFloat(t_g).toFixed(2));

    if (element.hasClass('d_b')) {
        t_b += val * denom;
    } else {
        t_o += val * denom;
    }

    return [t_b, t_o];
};