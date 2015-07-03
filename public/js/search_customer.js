$(function () {
	search_customer('#customer_id', '#customer_search_and_add');
});

var add_customer = function () {
    'use strict';

    var a = $('.add_customer'),
        i = $('#customer_id'),
        l = $('#customer_name_selected');

    a.click(function (e) {
        e.preventDefault();

        var t = $(this);

        i.val(t.data('id')).focus();
        l.text(t.data('name'));
    });
};

var search_customer = function (input_text, content_results) {
    'use strict';

    var i_t = $(input_text),
        e_r = $(content_results);

    i_t.keyup(function (e) {
        e.stopPropagation();
        hideControls(e_r);

        if ($(this).val() != '' && e.keyCode != 9) {
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
            result += '<div><a href="#" class="add_customer" data-id="'+data[i].id+'" data-name="'+data[i].prefix+' '+data[i].name+'">'+data[i].prefix+' '+data[i].name+'</a></div>';
        }
    } else {
        result = '<div class="text-center"><span>La consulta no devolvió resultados.</span></div>';
    }

    content.html(result).show();
    add_customer();
};
