$(function () {
	get_total_pa();
});

var get_total_pa = function (input) {
	'use strict';

	var i_p = $('#selling_price'),
		h_i = $('#iva'),
		h_d = $('#dollar'),
		i_i = $('#pa_iva'),
		i_d = $('#pa_dollar'),
		i_u = $('#pa_utility'),
		i_s = $('#pa_shipping'),
		i_t = $('#pa_total');

	i_p.keyup(function () {
		i_t.val(sum());
	});

	i_i.change(function () {
		i_t.val(sum());
	})

	i_d.change(function () {
		i_t.val(sum());
	})

	i_u.keyup(function () {
		i_t.val(sum());
	});

	i_s.keyup(function () {
		i_t.val(sum());
	});

	var sum = function () {
		var p = parseFloat(i_p.val()),
			i = i_i.val(),
			d = parseFloat(i_d.val()),
			u = parseFloat(i_u.val()),
			s = parseFloat(i_s.val()),
			total;

		if (isNaN(p)) {
			p = 0;
		}

		if (i==1) {
			i = parseFloat(h_i.val()) / 100 + 1;
		} else {
			i = 1;
		}

		if (d==1) {
			d = parseFloat(h_d.val());
		} else {
			d = 1;
		}

		if (isNaN(u)) {
			u = 1;
		} else {
			u = u / 100 + 1;
		}

		if (isNaN(s)) {
			s = 0;
		}

		total = (p * i * d * u) + s

		if (isNaN(total)) {
			total = 0;
		}

		return parseFloat(total).toFixed(2);
	};
};
