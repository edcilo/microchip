$(function () {
	search_provider('#provider', '#provider_search_and_add')
});

var add_provider = function () {
	'use strict';

	var a = $('.add_provider'),
        i = $('#provider');

    a.click(function (e) {
        e.preventDefault();

        var t = $(this);

        i.val(t.data('name')).focus();
    });
}

var search_provider = function (input_text, content_results) {
	'use strict';

	var i = $(input_text),
		c = $(content_results);

	i.keyup(function(e){
		e.stopPropagation();
		hideControls(c);

		if ($(this).val() != '' && e.keyCode != 9) {
            $.get($(this).data('url'), 'terms='+$(this).val(), function(result) {
                show_list_provides(result, c)
            }, 'json');
        } else {
            c.hide().html('');
        }
	});
};

var show_list_provides = function (data, content) {
	'use strict';

	var result = '';

    if (data.length > 0) {
        for (var i=0; i<data.length; i++) {
            result += '<div><a href="#" class="add_provider" data-name="'+data[i].name+'">'+data[i].name+'</a></div>';
        }
    } else {
        result = '<div class="text-center"><span>La consulta no devolvió resultados.</span></div>';
    }

    content.html(result).show();
    add_provider();
};
