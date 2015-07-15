$( function () {
    "use strict";

    edcBar();
    edcCortinilla();
    edcMenuOptions();
    edcOptionsList();
    edcSelect();
    edcAlert();
    edcShowHide();
    edc_close();
    edc_dropdowMenu();

});

/*
 * Función que borra la clase .open de todos los elementos que la contengan
 * al dar click sobre el elemento body
 */
var edc_close = function () {
    "use strict";

    $('body').click( function () {
        $('.open').removeClass('open');
    } );
};

/*
 * funcion que hace visible el dropdownMenu
 *
 * DOM html: div>button.trigger-dropdown{Menu}+ul.dropdown-menu>li*3>a{Option n}
 * trigger: .trigger-dropdown
 */
var edc_dropdowMenu = function () {
    "use strict";

    var trigger  = $('.trigger-dropdown'),
        elementP = null;

    $('body').click( function (e) {
        elementP = ( e === null ) ? e.srcElement : e.target;
    } );

    trigger.click( function (e) {
        e.preventDefault();
        e.stopPropagation();

        var element = ( e === null ) ? e.srcElement : e.target;

        $('.open').removeClass('open');

        $(this).parent().addClass('open');

        if ( elementP === element ) {
            $('.open').removeClass('open');
            elementP = null;
        }
        else {
            elementP = element;
        }
    } );

};

var edcShowHide = function () {
    "use strict";

    var father  = null,
        button  = $('.edc-hide-show-trigger'),
        element = null;

    button.click( function (e) {
        e.preventDefault();

        father = $(this).parents('.edc-hide-show');
        element = father.find('.edc-hide-show-element');

        element.slideToggle();
    });
};

var edcAlert = function (){
    "use strict";

    var button         = $('.edcButtonAlert'),
        button_close   = $('#'+ button.attr('data-alertId') +' .btn-danger'),
        element_alert  = $( '#' + button.attr('data-alertId') );

    element_alert.hide();

    button.css('cursor', 'pointer');
    button.on('click', function () {
        element_alert.addClass('window_info');
        element_alert.show();
    });

    button_close.on('click', function (e) {
        e.preventDefault();
        element_alert.hide();
    });
};

/*
 * Función que elimina del arbol DOM a los elementos padre
 * que contienen a un elemento con la clase .edcButtonClose
 */
var edcBar = function (){
    "use strict";

    var elemento = $('.edcButtonClose');

    elemento.on('click', function () {
        var padre = $(this).parent().parent();

        padre.fadeOut(250);
    });
};

var edcCortinilla = function () {
    "use strict";

    var button  = $('.edcCortinilla-btn');
    button.append(' <i class="fa fa-sort"></i>');

    button.on('click', function (e) {
        e.preventDefault();

        var data_id = $(this).attr('data-cortinillaId'),
            element = $('#'+data_id);

        element.slideToggle('fast');
    });
};

/*
 * Función que muestra u oculta las opciones del menu desplegable.
 */
var edcMenuOptions = function () {
    "use strict";

    var element = $('.edcMenuOptions .button');

    element.on('click', function(e) {
        e.preventDefault();

        var son = $(this).siblings('.list');
        son.slideToggle('fast');
    });
};

/*
 * Función que muestra u oculta un menu de opciones para el usuario
 */
var edcOptionsList = function () {
    "use strict";

    var elemento = $('.optionList > .icon');
    var lista    = $('.optionList > .list');

    hideControls(lista);

    elemento.on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        lista.slideToggle('fast');
    });
};

/*
 * Función que activa los select hechos con elemetos div
 */
var edcSelect = function () {
    "use strict";

    var selects = $('.selectEdc');

    selects.on('click', function (e) {
        e.stopPropagation();
        var id       = $(this).attr('id'),
            text     = $('#' + id + ' div.text'),
            lista    = $('#' + id + ' div.lista'),
            opciones = $('#' + id + ' div.option'),
            input    = $("[name='" + id + "']");

        hideControls(lista);
        lista.slideToggle('fast');

        opciones.on('click', function (e) {
            e.stopPropagation();
            var texto = $(this).text();

            input.val($(this).data('value'));
            text.text(texto);
            lista.slideUp('fast');
        });
    });
};

/*
 * Función que oculta un elemento al dar click en el body del documento
 */
var hideControls = function (element) {
    "use strict";

    var element = $(element);

    $('body').on('click', function () {
        element.slideUp('fast');
    });
};

var pad = function (str, max) {
    'use strict';

    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
};

var replace_specials = function (str) {
    'use strict';

    var characters = [
        'á', 'é', 'í', 'ó', 'ú',
        'ñ', '{', '}', '[', ']',
        '^', '~', '\\', '/', ';',
        ':', '-', '_'
    ];

    for (var i=0; i<characters.length; i++) {
        str = str.replace(characters[i], '');
    }

    return str;
};