$(function () {
	hide_show_controls();
	calculate_pay();
	reset_form();
});

var reset_form = function () {
	'use strict';

	var form = $('#form_calculate'),
		btn = form.find('[type="reset"]'),
		input = $('#amount');

	btn.click(function () {
		input.val('');
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
		hide_show;

	hide_show = function (value) {
		if (value === 'Efectivo') {
			amount.show();
			change.show();
			folio.hide();
			reference.hide();
			entity.hide();

			calculate.show();
		} else if (
			value === 'Tarjeta de crédito/débito' ||
			value === 'Cheque' ||
			value === 'Transferencia'
		) {
			amount.show();
			change.hide();
			folio.hide();
			reference.show();
			entity.show();

			calculate.hide();
		} else if (value === 'Vale') {
			amount.hide();
			change.hide();
			folio.show();
			reference.hide();
			entity.hide();

			calculate.hide();
		} else if (value === 'Monedero') {
			amount.hide();
			change.hide();
			folio.hide();
			reference.show();
			entity.hide();

			calculate.hide();
		} else {
			amount.hide();
			change.hide();
			folio.hide();
			reference.hide();
			entity.hide();

			calculate.hide();
		}
	}

	hide_show(current);

	method.change(function() {
		var val = $(this).val();

		hide_show(val);
	});
};

var calculate_pay = function () {
	'use strict';

	var cont = $('#calculate_pay'),
		amount = $('#amount'),
		v_total = parseFloat($('#user_rest').text()),
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

		i_change.val(parseFloat(change).toFixed(2));
		amount.val(parseFloat(cash).toFixed(2));
	});
};
