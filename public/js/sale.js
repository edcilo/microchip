$(function () {

	text2select('selling_price', []);
	addPrices('#barcode', '.product_price', '#selling_price', '#value_iva');

});

/**
 * Convierte un elemento input text a select
 *
 * @param {string} input_text el nombre del id del elemento input text sin (#)
 * @param {array} options Arreglo de valores para las opciones del elemento select
 */
var text2select = function (input_text, options) {
	'use strict';

	var t_js = document.getElementById(input_text),
		t = $('#' + input_text),
		s = '';

	if (t.attr('type') == 'text') {
		var nodes=[],
			values=[],
			att,
			atts = t_js.attributes;

		s = '<select ';
		for (var i = 0; i < atts.length; i++){
    		att = atts[i];
    		s += att.nodeName + '="' + att.nodeValue + '" ' ;
		}
		s += '></select>';

		s = $(s);

		for (var i = 0; i < options.length; i++) {
			var option = document.createElement('option');
			option.value = options[i];
			$(option).text(options[i]);
			s.append($(option));
		}

		t.replaceWith(s);
	}
};

var addPrices = function (inp_product, content, inp_price, iva) {
	'use strict';

	var i_pro = $(inp_product),
		c = $(content),
		i_pri = $(inp_price),
		iva = parseFloat($(iva).text()) / 100 + 1;

	i_pro.focusout(function () {
		var barcode = $(this).val(),
			url = i_pri.data('url').replace('PRODUCT_BARCODE', barcode);

		if (barcode != null && barcode.length != 0 && !/^\s*$/.test(barcode)) {
			$.get(url, '', function (data) {
			i_pri.html('');

			if (data.code == 200) {

				var prices = [data.price_1, data.price_2, data.price_3, data.price_4, data.price_5],
					price = 0,
					offer = parseInt(data.offer) - 1,
					list = '';

				for (var i = 0; i<prices.length; i++) {
					price = parseFloat(prices[i]);
					price = parseFloat(price * iva).toFixed(2);

					list += '<option value="' + price + '" ';
					list += (offer == i) ? 'selected ' : '';
					list += '>';
					list += '$ ' + price;
					list += '</option>';
				}

				i_pri.append(list);

				c.show();
			} else {
				c.hide();
			}
		}, 'json');
		}
	});
};
