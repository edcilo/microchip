$(function () {
    show_hide_customer();
});

var show_hide_customer = function () {
	'use strict';

	var check = $('#customer'),
		content = $('#content_hidden');

	check.click(function () {
		if (check.is(':checked')) {
			content.show();
		} else {
			content.hide();
		}
	});
};
