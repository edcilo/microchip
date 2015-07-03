$(function () {

	text2select('selling_price', []);
	addPrices('#barcode', '.product_price', '#selling_price', '#value_iva');

});

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

					showDataProduct('#product_show_details', data)
				} else {
					c.hide();
				}
			}, 'json');
		}
	});
};

var showDataProduct = function (content, data)
{
	'use strict';

	var content = $(content),
		list = '',
		prices = '',
		iva = parseFloat($('#value_iva').text()),
		link = content.find('.link_product').data('url'),
		download = content.find('.link_download').data('url'),
		list_prices = [data.price_1, data.price_2, data.price_3, data.price_4, data.price_5];

	if (data.type == 'Producto') {
		download = download + '/' + data.p_description.data_sheet;
	}

	link = link.replace('PRODUCT_ID', data.id);

	if (data.type == 'Producto') {
		list += '<li><strong>Modelo:</strong> '+data.p_description.model+'</li>';
		list += '<li><strong>Marca:</strong> '+data.p_description.mark.name+'</li>';
	}
	list += '<li><strong>Garantía:</strong> '+data.warranty/30+' meses</li>';
	if (data.type == 'Producto') {
		list += '<li><strong>Existencias:</strong> '+data.stock+'</li>';
	}
	list += '<li><strong>Descripción:</strong> '+data.description+'</li>';

	for (var i = 0; i < list_prices.length; i++) {
		prices += '<li>';
		prices += '<strong>('+(i+1)+')</strong> ';
		prices += '$ '+ parseFloat(list_prices[i] * (iva / 100 + 1)).toFixed(2);
		prices += (i+1 == data.offer) ? ' [precio en oferta]' : '';
		prices += '</li>';
	}

	content.find('.barcode').text(data.barcode);
	content.find('img').attr('src', content.find('img').data('url') + '/' + data.image);
	content.find('.link_download').attr('href', download);
	content.find('.link_product').attr('href', link);
	content.find('.list-description').html(list);
	content.find('.list-prices').html(prices);

	content.show();
}

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
