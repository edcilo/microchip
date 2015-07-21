$(function () {
    status_show();
});

var add_purchase_price = function () {
    'use strict';

    var l = $('.add_barcode'),
        p = $('#purchase_price');

    l.click(function () {
        p.val($(this).data('purchase_price'));
    });
};

var status_show = function () {
    'use strict';

    var s = $('#status'),
        i = $('.show_in');

    s.change(function () {
        var value = $(this).val();

        if (value == 'in') {
            i.show();
        } else {
            i.hide();
        }
    });
};