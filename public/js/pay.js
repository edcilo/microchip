$(function () {
	hide_show_controls();
});

var hide_show_controls = function () {
	'use strict';

	var form = $('#form_pay'),
		method = form.find('#method'),
		current = method.val(),
		amount = form.find('.amount'),
		folio = form.find('.folio'),
		reference = form.find('.reference'),
		entity = form.find('.entity'),
		hide_show;

	hide_show = function (value) {
		if (value === 'Efectivo') {
			amount.show();
			folio.hide();
			reference.hide();
			entity.hide();
		} else if (
			value === 'Tarjeta de crédito/débito' ||
			value === 'Cheque' ||
			value === 'Transferencia'
		) {
			amount.show();
			folio.hide();
			reference.show();
			entity.show();
		} else if (value === 'Vale') {
			amount.hide();
			folio.show();
			reference.hide();
			entity.hide();
		} else if (value === 'Monedero') {
			amount.hide();
			folio.hide();
			reference.show();
			entity.hide();
		} else {
			amount.hide();
			folio.hide();
			reference.hide();
			entity.hide();
		}
	}

	hide_show(current);

	method.change(function() {
		var val = $(this).val();

		hide_show(val);
	});
};
