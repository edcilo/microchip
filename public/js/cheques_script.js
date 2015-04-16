var limit = function (e_start, e_quantity, e_end) {
    "use strict";
    var start    = $(e_start),
        quantity = $(e_quantity),
        end      = $(e_end),
        result   = null;

    var suma = function () {
        result = parseInt(start.val()) + parseInt(quantity.val()) - 1;
        end.val(result);
    };

    start.keyup( function () { suma(); });
    quantity.keyup( function () { suma(); });
};


$(function () {
    "use strict";

    limit('#folio_start', '#quantity', '#folio_end');
});