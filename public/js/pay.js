$(function () {
	$('#btn_show_customer').hide();

	calculate_pay();
	calculate_rest();
	get_vale();
	hide_show_controls();
	reset_form();
	search_card();
	show_details();
	show_hide_btn_details();
	show_totals();
});

var add_customer = function () {
    'use strict';

    var a = $('.add_customer'),
        i = $('#reference');

    a.click(function (e) {
        e.preventDefault();

		$('#btn_show_customer').show();
        i.val($(this).data('card')).focus();

        search_customer();
    });
};

var calculate_pay = function () {
	'use strict';

	var cont = $('#calculate_pay'),
		amount = $('#amount'),
		v_total = parseFloat($('#user_rest').data('value')),
		anticipo = parseFloat($('#anticipo').text()),
		i_change = $('#change'),
		inputs = cont.find('input');

	inputs.keyup(function () {
		var cash = 0,
			change = 0;

		inputs.each(function () {
			var q = parseInt($(this).val()),
				v = parseFloat($(this).data('value'));

			if (isNaN(q)) {
				q = 0;
			}

			if (isNaN(v)) {
				v = 0;
			}

			cash += q * v;
		});

        if (cash > v_total) {
            change = cash - v_total;
		}

        if (anticipo > 0 && cash > anticipo) {
            change = cash - anticipo;
        }

		i_change.val(parseFloat(change).toFixed(2));
		amount.val(parseFloat(cash).toFixed(2));

		get_data_confr();
	});
};

var calculate_rest = function () {
	'use strict';

	var total = parseFloat($('#user_rest').data('value')),
        anticipo = parseFloat($('#anticipo').text()),
		i_a = $('#amount'),
		c_rest = $('#change');

	i_a.keyup(function () {
		var amount = parseFloat($(this).val()),
			rest = amount - total;

		if (isNaN(rest) || rest < 0) {
			rest = 0;
		}

        if (anticipo > 0 && amount>anticipo) {
            rest = amount - anticipo;
        }

		c_rest.val(parseFloat(rest).toFixed(2));
	})
};

var get_data_confr = function () {
	'use strict';

	var method = $('#method').val(),
		rest = parseFloat($('#user_rest').data('value')),
		amount = parseFloat($('#amount').val()),
		change = parseFloat($('#change').val()),
		reference = parseFloat($('#reference').data('points')),
		folio = parseFloat($('#folio').data('total')),
		c_m = $('#c_m'),
		c_s = $('#c_s'),
		c_p = $('#c_p'),
		c_c = $('#c_c'),
		l_c = $('#l_c'),
		l_default = l_c.data('default');

	l_c.parents('tr').show();
	if (method == 'Monedero') {
		l_c.text('Puntos restantes:');
		change = reference - rest;

		if (reference > rest) {
			reference = rest;
		}

		amount = reference;
	} else if (method == 'Vale') {
		amount = folio;

		l_c.parents('tr').hide();
	} else if (method == 'Efectivo') {
		l_c.text(l_default);
	} else {
		l_c.parents('tr').hide();
	}

	if (isNaN(rest)) {
		rest = 0;
	}

	if (isNaN(amount)) {
		amount = 0;
	}

	if (isNaN(change)) {
		change = 0;
	}

	c_m.text(method);
	c_s.text(parseFloat(rest).toFixed(2));
	c_p.text(parseFloat(amount).toFixed(2));
	c_c.text(parseFloat(change).toFixed(2));
};

var get_vale = function () {
	'use strict';

	var method = $('#method'),
		i_v = $('#folio');

	method.change(function () {
		if ($(this).val() == 'Vale') {
			i_v.keyup(function () {
				search_vale();
			});
		}
	});
};

var hide_show_controls = function () {
	'use strict';

	var form = $('#form_pay'),
		method = form.find('#method'),
		current = method.val(),
		amount = form.find('.amount'),
		folio = form.find('.folio'),
		reference = form.find('.reference'),
		entity = form.find('.entity'),
		calculate = $('#calculate_pay'),
		change = $('#pay_change'),
		add_attributes,
		hide_elements,
		hide_show,
		input,
		inputs = form.find('input');

	add_attributes = function (e) {
		e.attr('data-required', 'required');
	};

	hide_elements = function () {
		amount.hide();
		change.hide();
		folio.hide();
		reference.hide();
		entity.hide();
		calculate.hide();

		$('#customer_show_details').hide();
	};

	hide_show = function (value) {

		inputs.each(function () {
			$(this).removeAttr('data-required');
			$(this).removeAttr('data-accept');
			$(this).val('');
		});

		if (value === 'Efectivo') {
			add_attributes(amount.find('input'));

			amount.show();
			change.show();
			calculate.show();
		} else if (
			value === 'Tarjeta de crédito/débito' ||
			value === 'Cheque' ||
			value === 'Transferencia'
		) {
			add_attributes(amount.find('input'));
			add_attributes(reference.find('input'));
			add_attributes(entity.find('input'));

			amount.show();
			reference.show();
			entity.show();
		} else if (value === 'Vale') {
			add_attributes(folio.find('input'));

			folio.show();
		} else if (value === 'Monedero') {
			add_attributes(reference.find('input'));

			reference.show();
		}
	};

	hide_elements();
	hide_show(current);

	method.change(function() {
		var val = $(this).val();

		hide_elements();
		hide_show(val);
	});
};

var reset_form = function () {
	'use strict';

	var form = $('#form_calculate'),
		btn = form.find('[type="reset"]'),
		input = $('#amount'),
		change = $('#change');

	btn.click(function () {
		input.val('');
		change.val('0.00');
	});
};

var search_card = function () {
	'use strict';

	var i_m = $('#method'),
		i_f = $('#reference'),
		c = $('#customer_search_and_add'),
		search;

	search = function (event, input) {
		var val = input.val();

		if (i_m.val() === 'Monedero' && val != '' && event.keyCode != 9 && event.keyCode != 13) {
			$.get(i_m.data('url_customer'), 'active=1&terms='+val, function(result) {
				show_list_customers(result, c)
			}, 'json');
		} else {
            c.hide().html('');
        }
	};

	i_m.change(function () {
		i_f.keyup(function (e) {
			search(e, $(this));
		});
	});
};

var search_customer = function () {
	'use strict';

	var btn = $('#btn_show_customer'),
		i = $('#reference');

	$.get(btn.data('url'), 'card_id='+i.val(), function(result) {
		if (result.code != 404) {
			show_data_customer('#customer_show_details', result);
		}
	}, 'json');
};

var show_data_customer = function (content, data) {
	var c = $(content),
		list = '',
		card = '',
		address;

	$('#reference').attr('data-points', data.points);

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
	list += '<li><strong>Dirección:</strong> '+address+'</li>';
	list += '<li><strong>Envios:</strong> '+data.shipping_address+'</li>';

	card += '<li><strong>Numero:</strong> '+data.card_id+'</li>';
	card += '<li><strong>Vence el:</strong> '+data.expiration_date+'</li>';
	card += '<li><strong>Ahorro:</strong> $ '+data.points+'</li>';

	c.find('.name').text(data.prefix+' '+data.name);
	c.find('.list-description').html(list);
	c.find('.list-card').html(card);

	c.show();
};

var show_data_vale = function (data) {
	'use strict';

	var c = $('#details_vale'),
		f = $('#folio'),
		ul = c.find('.list-description'),
		list = '',
		available = '';

	if (data.code != 404) {
		if (data.available) {
			available = '<i class="fa fa-check"> Si';
		} else {
			available = '<i class="fa fa-times"> No';
		}

		list += '<li><strong>Folio:</strong> '+data.folio+'</li>';
		list += '<li><strong>Valor:</strong> $ '+data.value+'</li>';
		list += '<li><strong>Disponible:</strong> '+available+'</li>';

		ul.html(list);
		f.attr('data-total', data.value);

		c.show();
	} else {
		c.hide();
	}
};

var show_details = function () {
	'use strict';

	var b = $('#btn_show_customer'),
		i = $('#reference');

	b.click(function (e) {
		e.preventDefault();

		if (i.val() != '') {
			search_customer();
		}
	});
};

var show_hide_btn_details = function () {
	'use strict';

	var i = $('#reference'),
		s = $('#method'),
		b = $('#btn_show_customer');

	i.keyup(function (e) {
		if (e.keyCode == 13) {
			b.show();
			search_customer();
		}
	});

	s.change(function () {
		if ($(this).val() != 'Monedero') {
			$('#btn_show_customer').hide();
		}
	});
};

var show_list_customers = function (data, content) {
    'use strict';

    var result = '';

	hideControls(content);

    if (data.length > 0) {
        for (var i=0; i<data.length; i++) {
        	var personal;

        	if (data[i].cellphone != '') {
        		personal = '(célular: ' + data[i].cellphone + ')';
        	} else if (data[i].email != '') {
        		personal = '(email: ' + data[i].email + ')';
        	} else if (data[i].rfc != '') {
        		personal = '(RFC: ' + data[i].rfc + ')';
        	} else {
        		personal = '';
        	}

            result += '<div><a href="#" class="add_customer"'+
            	'data-id="'+data[i].id+'"'+
            	'data-card="'+data[i].card_id+'">'+
            	data[i].prefix+' '+data[i].name+' '+personal+
            	'</a></div>';
        }
    } else {
        result = '<div class="text-center"><span>La consulta no devolvió resultados.</span></div>';
    }

    content.html(result).show();
    add_customer();
};

var show_totals = function () {
	'use strict';

	var form = $('#form_pay'),
		btn = form.find('[type="submit"]');

	btn.click(function () {
		get_data_confr();
	});
};

var search_vale = function () {
	'use strict';

	var i_f = $('#folio');

	$.get(i_f.data('url'), 'folio='+i_f.val(), function(result) {
		show_data_vale(result);
	}, 'json');
};
