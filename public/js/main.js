$( function () {
    height('#col-izq');
    height('#col-der');
    stopEnter();
    enter2tap();

    $( "#tooltip" ).tooltip();

    $('#col-izq').perfectScrollbar({
        suppressScrollX: true
    });
    $('#col-der').perfectScrollbar({
        suppressScrollX: true
    });
    $('#big-table').perfectScrollbar({
        suppressScrollX: false
    });
    $('#col_price').perfectScrollbar({
        suppressScrollX: true
    });
    $('#col_order').perfectScrollbar({
        suppressScrollX: true
    });

    search('#form-search', '.search', '.resultSearch');

    validateForm('.validate');
} );

var stopEnter = function ()
{
    var e_i = $('.stopEnter');

    e_i.keypress(function (e) {
        if (e.keyCode == 13) {
            return false;
        }
    });
};

var element2string = function (e) {
    return $('<div />').append( e.clone() ).remove().html();
};

var enter2tap = function () {
    'use strict';

    var i = $('.nextInput');

    i.keypress(function (e) {
        var t=(document.all) ? e.keyCode : e.which;

        if (t==13) {
            var frm = $(this).parents('form'),
                es = frm.find('input'),
                inp = element2string($(this)),
                n = 0;

            es.each(function (index) {
                var inp2 = element2string($(this));

                if (inp2 == inp) {
                    n = index + 1;

                    return false;
                }
            });


            es[n].focus();
        }
    });
};

function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
}
//document.onkeypress = stopRKey;

var height = function (element) {
    var element  = $(element),
        e_header = $('header').height(),
        e_footer = $('footer .subtitle').height() + 11,
        e_window = $( window ).height();

    var height_c = e_window - (e_header + e_footer);
    element.css('height', height_c + 'px');
};

var sumaFecha = function(d, fecha, sep)
{
    "use strict";
    var date = null;
    var fecha_array = fecha.split(sep);
    fecha_array[1] -= 1;
    date = new Date(fecha_array[0], fecha_array[1], fecha_array[2]);
    date.setDate(date.getDate() + parseInt(d));

    return date;
};

var search = function (element_form, element_input, element_contResults) {
    "use strict";

    var cont = null,
        form = $(element_form),
        input = $(element_form + ' ' + element_input),
        contResults = $(element_contResults),
        url = $(contResults).data('url');

    input.keyup( function (e) {
        e.stopPropagation();
        hideControls(contResults);

        if ( $(this).val() !== "" ) {
            $.get(form.attr('action'), form.serialize(), function(result) {
                var cont = "",
                    text = "",
                    slug = null,
                    i    = null;

                if (result.length > 0)
                {
                    for( i = 0; i < result.length; i++ ){

                        text = ( result[i].barcode     ) ? result[i].barcode            : '';
                        text += ( result[i].name        ) ? result[i].name              : '';
                        text += ( result[i].f_last_name ) ? result[i].f_last_name       : '';
                        text += ( result[i].card_id     ) ? ' - ' + result[i].card_id   : '';
                        text += ( result[i].type        ) ? result[i].type              : '';
                        text += ( result[i].folio       ) ? ': ' + result[i].folio      : '';

                        slug = result[i].slug;
                        if (typeof(slug) == "undefined") {
                            slug = '';
                        } else {
                            slug += '/';
                        }

                        cont += '<div> ' +
                                    '<a href="' + url + '/' + slug + result[i].id + '">' +
                                        text +
                                    '</a>' +
                                '</div>';
                    }
                } else {
                    cont = '<div><span>La consulta no devolvió resultados.</span></div>'
                }

                contResults.addClass('text-left').html(cont).show();

            }, 'json');
        } else {
            contResults.html('').hide();
        }
    });
};

var show_message = function (message, cont) {
    "use strict";

    var msg = (cont === undefined) ? $('.msgs') : $(cont);

    setTimeout (function () {
        msg.html(message).slideDown().delay(3000).slideUp(600);
    }, 100);
};

var validateForm = function (element) {
    "use strict";
    var form = $(element),
        exp_integer          = /^(\+|\-)?\d+$/,
        exp_integer_unsigned = /^\d+/,
        exp_numeric          = /^[+-]?[0-9]+(\.[0-9]*)?$/,
        exp_email            = /^([A-Za-z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
        exp_date             = /^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/;

    $(element + ' input').attr('data-error', '0');
    $(element + ' select').attr('data-error', '0');
    $(element + ' textarea').attr('data-error', '0');

    form.submit(function (e) {
        var errors = 0,
            elementsDataError = $(this).find('[data-error]'),
            required          = $(this).find('[data-required]'),
            selectRequired    = $(this).find('select'),
            min               = $(this).find('[data-min]'),
            max               = $(this).find('[data-max]'),
            equals            = $(this).find('[data-equals]'),
            numeric           = $(this).find('[data-numeric]'),
            integer           = $(this).find('[data-integer]'),
            integer_unsigned  = $(this).find('[data-integer-unsigned]'),
            inlist            = $(this).find('[data-in]'),
            mimes             = $(this).find('[data-mimes]'),
            email             = $(this).find('[data-email]'),
            date              = $(this).find('[data-date]');

        $.each(elementsDataError, function () {
            $(this).attr('data-error', 0);
        });

        $.each(required, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') );

            if ( val.length===0 || val === null ){
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });
        $.each(selectRequired, function() {
            var val = null,
                dataError = null;
            if( $(this).attr('data-required') )
            {
                val = parseInt( $(this).val() );
                dataError = parseInt( $(this).data('error') );

                if ( val.length === 0 || val === 0 ){
                    errors++;

                    dataError += 1;
                    $(this).attr('data-error', dataError);
                }
            }
        });

        $.each(max, function () {
            var val = $(this).val(),
                maxLength = $(this).data('max'),
                dataError = parseInt( $(this).data('error') );

            if( val.length!==0 && val.length > maxLength ){
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(min, function () {
            var val = $(this).val(),
                minLength = $(this).data('min'),
                dataError = parseInt( $(this).data('error') );

            if( val.length!==0 && val.length < minLength ){
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(equals, function () {
            var val = $(this).val(),
                valLength = $(this).data('equals'),
                dataError = parseInt( $(this).data('error') );

            if( val.length!==0 && val.length !== valLength ){
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(numeric, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') );

            if( val.length!==0 && ( isNaN(val) || !exp_numeric.test(val) ) ) {
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(email, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') );

            if ( val.length!== 0 && !exp_email.test(val) ) {
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(date, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') );

            if ( val.length!==0 && !exp_date.test(val) ) {
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(integer, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') );

            if( val.length!==0 && ( val % 1 !== 0 || !exp_integer.test(val) ) ){
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(integer_unsigned, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') );

            if( val.length!==0 && !exp_integer_unsigned.test(val) ) {
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(inlist, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') ),
                list = $(this).data('in').split(','),
                not = 0,
                i = null;

            for ( i = 0; i < list.length; i++ ) {
                if( list[i] !== val ){
                    not++;
                }
            }

            if ( not === list.length ){
                errors++;

                dataError += 1;
                $(this).attr('data-error', dataError);
            }
        });

        $.each(mimes, function () {
            var val = $(this).val(),
                dataError = parseInt( $(this).data('error') ),
                extension = val.split('.'),
                mimesList = $(this).data('mimes').split(','),
                not = 0;

            if ( val !== '' || val === null ){
                extension = extension[ extension.length - 1 ];

                for ( var i = 0; i < mimesList.length; i++ ) {
                    if( mimesList[i].toLowerCase() !== extension ){
                        not++;
                    }
                }

                if ( not === mimesList.length ){
                    errors++;

                    dataError += 1;
                    $(this).attr('data-error', dataError);
                }
            }
        });

        // unique
        // exists
        $.each(elementsDataError, function () {
            var elementsFail = parseInt( $(this).attr('data-error') )

            if ( elementsFail ) {
                $(this).attr('data-accept', false);
                //$(this).siblings('.message-error').text($(this).attr('title'))
            } else {
                $(this).attr('data-accept', true);
            }
        });

        if ( errors !== 0 ){
            return false;
        }
        else{
            return true;
        }
    });
};
