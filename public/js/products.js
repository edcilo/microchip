$(function () {
    for (var i=1; i<6; i++) {
        getUtility('#utility_' + i, '#price_' + i, '#purchase_price', '#iva_' + i)
        getPrice('#price_' + i, '#utility_' + i, '#purchase_price', '#iva_' + i);
    }

    generatePrices('#generate_prices');
    uncheckOffers('#uncheck_offer', 'offer');
    roundPrices('#round_prices');
});

var generatePrices = function (button_id) {
    var b = $(button_id);

    b.click(function () {
        var i_b = parseFloat($('#purchase_price').val()),
            i_u = parseFloat($('#utility').val()),
            i_d = parseFloat($('#desc').val());

        for (var i=1; i<6; i++) {
            var i_u_r = $('#utility_' + i),
                i_p_r = $('#price_' + i),
                i_i_r = $('#iva_' + i)
                iva = parseFloat($('#iva').text()),
                utility = i_u,
                price = i_b * (utility/100 + 1),
                with_iva = price * (iva / 100 + 1);

            if (isNaN(utility)) {
                utility = 0;
            }

            if (isNaN(price)) {
                price = 0;
            }

            if (isNaN(with_iva)) {
                with_iva = 0;
            }

            i_u_r.val(parseFloat(utility).toFixed(2));
            i_p_r.val(parseFloat(price).toFixed(2));
            i_i_r.val(parseFloat(with_iva).toFixed(2));

            i_u -= i_d;
        }
    });
};

var getPrice = function (inp_price, inp_utility, inp_base, inp_with_iva) {
    var i_p = $(inp_price),
        i_u = $(inp_utility),
        i_b = $(inp_base),
        i_i = $(inp_with_iva),
        iva = parseFloat($('#iva').text());

    i_u.keyup(function () {
        var value = parseFloat($(this).val()),
            base = parseFloat(i_b.val()),
            price, with_iva;

        price = base * (value/100+1);
        with_iva = price * (iva/100+1);

        if (isNaN(price)) {
            price = 0;
        }

        if (isNaN(with_iva)) {
            with_iva = 0;
        }

        i_p.val(parseFloat(price).toFixed(2));
        i_i.val(parseFloat(with_iva).toFixed(2))
    });
};

var getUtility = function (inp_utility, inp_price, inp_base, inp_with_iva) {
    var i_u = $(inp_utility),
        i_p = $(inp_price),
        i_b = $(inp_base),
        i_i = $(inp_with_iva),
        iva = parseFloat($('#iva').text());

    i_p.keyup(function () {
        var value = parseFloat($(this).val()),
            base = parseFloat(i_b.val()),
            utility, with_iva;

        utility = (value/base-1)*100;
        with_iva = value * (iva/100+1);

        if (isNaN(utility)) {
            utility = 0;
        }

        if (isNaN(with_iva)) {
            with_iva = 0;
        }

        i_u.val(parseFloat(utility).toFixed(2));
        i_i.val(parseFloat(with_iva).toFixed(2))
    });
};

var uncheckOffers = function (btn_id, name_radio) {
    var b = $(btn_id),
        r = $('[name=' + name_radio + ']');

    b.click(function () {
        r.prop('checked', false);
    });
};

var roundPrices = function (btn_id) {
    var b = $(btn_id);

    b.click(function () {
        for (var i = 1; i < 6; i++) {
            var i_u = $('#utility_' + i),
                i_p = $('#price_' + i),
                i_i = $('#iva_' + i),
                i_b = $('#purchase_price'),
                iva = parseFloat($('#iva').text()),
                base = parseFloat(i_b.val()),
                with_iva = parseFloat(i_i.val()).toFixed(0),
                price = with_iva / (iva/100+1);
                utility = (price/base-1)*100;

            if (isNaN(with_iva)) {
                with_iva = 0;
            }

            if (isNaN(price)) {
                price = 0;
            }

            if (isNaN(utility)) {
                utility = 0;
            }

            i_p.val(parseFloat(price).toFixed(2));
            i_u.val(parseFloat(utility).toFixed(2));
            i_i.val(parseFloat(with_iva).toFixed(2));
        }
    });
};
