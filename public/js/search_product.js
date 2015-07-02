$(function () {
    search_product('#barcode', '#product_search_and_add');
});

var add_barcode = function () {
    'use strict';

    var a = $('.add_barcode'),
        i = $('#barcode');

    a.click(function (e) {
        e.preventDefault();

        var l = $(this);

        i.val(l.data('barcode')).focus();
    });
};

var search_product = function (input_text, content_results) {
    'use strict';

    var i_t = $(input_text),
        e_r = $(content_results);

    i_t.keyup(function (e) {
        e.stopPropagation();
        hideControls(e_r);

        if ($(this).val() != '') {
            $.get($(this).data('url'), 'terms='+$(this).val(), function(result) {
                show_list(result, e_r)
            }, 'json');
        } else {
            e_r.hide().html('');
        }

    });
};

var show_list = function (data, content) {
    'use strict';

    var result = '';

    if (data.length > 0) {
        for (var i=0; i<data.length; i++) {
            result += '<div><a href="#" class="add_barcode" data-barcode="'+data[i].barcode+'">'+ data[i].barcode+' - '+data[i].s_description+'</a></div>';
        }
    } else {
        result = '<div class="text-center"><span>La consulta no devolvió resultados.</span></div>';
    }

    content.html(result).show();
    add_barcode();
};
