$(function () {
	search_customer('#customer_id', '#customer_search_and_add');

	get_customer('#customer_id');
});

var add_address = function (link, content) {
	'use strict';

	var a = $(link),
		t = $(content);

	a.click(function (e) {
		e.preventDefault();

		t.val($(this).data('address'));
	})
}

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
            $.get($(this).data('url'), 'active=1&terms='+$(this).val(), function(result) {
                show_list_customers(result, e_r)
            }, 'json');
        } else {
            e_r.hide().html('');
        }

    });
};

var show_list_customers = function (data, content) {
    'use strict';

    var result = '', personal;

    if (data.length > 0) {
        for (var i=0; i<data.length; i++) {
        	personal;

        	if (data[i].cellphone != '') {
        		personal = '(célular: ' + data[i].cellphone + ')';
        	} else if (data[i].email != '') {
        		personal = '(email: ' + data[i].email + ')';
        	} else if (data[i].rfc != '') {
        		personal = '(RFC: ' + data[i].rfc + ')';
        	} else {
        		personal = '';
        	}

            result += '<div><a href="#" class="add_customer" data-id="'+data[i].id+'" data-name="'+data[i].prefix+' '+data[i].name+'">'+data[i].prefix+' '+data[i].name+' '+personal+'</a></div>';
        }
    } else {
        result = '<div class="text-center"><span>La consulta no devolvió resultados.</span></div>';
    }

    content.html(result).show();
    add_customer();
};

var get_customer = function (input) {
	'use strict';

	var i = $(input);

	i.focusout(function () {
		var val = parseInt($(this).val()),
			url = $(this).data('customer');

		if (!isNaN(val)) {
			url = url.replace('CUSTOMER_ID', val);

			$.get(url, '', function (data) {
				show_data_customer('#customer_show_details', data);
			}, 'json');
		}
	});
};

var show_data_customer = function (content, data) {
	var c = $(content),
		list = '',
		card = '',
		address = '';

	address = (data.address !='') ? data.address + ', ' : '';
	address += (data.colony !='') ? 'col. ' + data.colony + ', ' : '';
	address += (data.postcode !='') ? 'c.p. ' + data.postcode + ', ' : '';
	address += (data.city !='') ? data.city + ', ' : '';
	address += (data.state !='') ? data.state + '; ' : '';
	address += (data.country !='') ? data.country : '';

	list += '<li><strong>Clasificación:</strong> '+data.classification+'</li>';
	list += '<li><strong>R.F.C.:</strong>'+data.rfc+'</li>';
	list += '<li><strong>Teléfono:</strong> '+data.phone+'</li>';
	list += '<li><strong>Celular:</strong> '+data.cellphone+'</li>';
	list += '<li><strong>Correo electrónico:</strong> '+data.email+'</li>';
	list += '<li><strong><a href="#" title="Usar como dirección de envio" class="add_address" data-address="'+address+'"><i class="fa fa-arrow-left"></i></a> Dirección:</strong> '+address+'</li>';
	list += '<li><strong><a href="#" title="Usar como dirección de envio" class="add_address" data-address="'+data.shipping_address+'"><i class="fa fa-arrow-left"></i></a> Envios:</strong> '+data.shipping_address+'</li>';

	card += '<li><strong>Numero:</strong> '+data.card_id+'</li>';
	card += '<li><strong>Vence el:</strong> '+data.expiration_date+'</li>';
	card += '<li><strong>Ahorro:</strong> $ '+data.points+'</li>';

	c.find('.name').text(data.prefix+' '+data.name);
	c.find('.list-description').html(list);
	c.find('.list-card').html(card);

	c.show();
	add_address('.add_address', '#shipping_address');
};
