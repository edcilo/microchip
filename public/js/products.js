$( function () {
    for (var i=1; i<6; i++) {
        getUtility('#utility_' + i, '#price_' + i, '#purchase_price')
        getPrice('#price_' + i, '#utility_' + i, '#purchase_price');
    }

    generatePrices('#generate_prices');
    uncheckOffers('#uncheck_offer', 'offer');
    roundPrices('#round_prices');
} );

var generatePrices = function (button_id) {
    var b = $(button_id);

    b.on('click', function () {
        var i_b = parseFloat($('#purchase_price').val()),
            i_u = parseFloat($('#utility').val()),
            i_d = parseFloat($('#desc').val());

        for (var i=1; i<6; i++) {
            var i_u_r = $('#utility_' + i),
                i_p_r = $('#price_' + i),
                utility = i_u,
                price = i_b * (utility/100 + 1);

            if (isNaN(utility)) {
                utility = 0;
            }

            if (isNaN(price)) {
                price = 0;
            }

            i_u_r.val(parseFloat(utility).toFixed(2));
            i_p_r.val(parseFloat(price).toFixed(2));

            i_u -= i_d;
        }
    });
};

var getPrice = function (inp_price, inp_utility, inp_base) {
    var i_p = $(inp_price),
        i_u = $(inp_utility),
        i_b = $(inp_base);

    i_u.on('keyup', function () {
        var value = parseFloat($(this).val()),
            base = parseFloat(i_b.val()),
            price;

        price = (value/100+1)*base;

        if (isNaN(price)) {
            price = 0;
        }

        i_p.val(parseFloat(price).toFixed(2));
    });
};

var getUtility = function (inp_utility, inp_price, inp_base) {
    var i_u = $(inp_utility),
        i_p = $(inp_price),
        i_b = $(inp_base);

    i_p.on('keyup', function () {
        var value = parseFloat($(this).val()),
            base = parseFloat(i_b.val()),
            utility;

        utility = (value/base-1)*100;

        if (isNaN(utility)) {
            utility = 0;
        }

        i_u.val(parseFloat(utility).toFixed(2));
    });
};

var uncheckOffers = function (btn_id, name_radio) {
    var b = $(btn_id),
        r = $('[name=' + name_radio + ']');

    b.on('click', function () {
        r.prop('checked', false);
    });
};

var roundPrices = function (btn_id) {
    var b = $(btn_id);

    b.on('click', function () {
        for (var i = 1; i < 6; i++) {
            var i_u = $('#utility_' + i),
                i_p = $('#price_' + i),
                i_b = $('#purchase_price'),
                base = parseFloat(i_b.val()),
                price = parseFloat(i_p.val()).toFixed(0),
                utility = (price/base-1)*100;

            if (isNaN(price)) {
                price = 0;
            }

            if (isNaN(utility)) {
                utility = 0;
            }

            i_p.val(parseFloat(price).toFixed(2));
            i_u.val(parseFloat(utility).toFixed(2))
        }
    });
};