$(function () {

    $( "#dialogRegister" ).dialog({autoOpen: false,width: $("#dialogRegister").data('width')});
    $( ".openDialog" ).click(function( event ) {$( "#dialogRegister" ).dialog( "open" );event.preventDefault();});

    product_recycle('.btn-recycle');
    product_active('.btn-active');
    element_delete('.btn-delete');
    product_cancel('.btn-cancel');

    keyGen('.key-gen', '#password', 20);

});

var keyGen = function (e_button, e_content, length_pass) {
    "use strict";
    var button = $(e_button),
        content = $(e_content);

    if ( ! length_pass ) {
        length_pass = 6;
    }

    button.click(
        function () {
            var string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890#$%&/()?.,_-",
                length_string = string.length + 1,
                pass = "";

            for ( var i = 0; i<length_pass; i++ )
            {
                var number = Math.floor( Math.random() * length_string );
                pass += string.charAt(number);
            }

            content.val(pass);
        }
    );
};

var product_recycle = function (button) {
    var element = $(button);

    if ( element.length )
    {
        element.on('click', function (e) {

            var id              = $(this).data('id'),
                form            = $('#form-recycle'),
                action          = form.attr('action').replace('PRODUCT_ID', id),
                row             = $(this).parents('tr'),
                msgs            = $('.msgs'),
                dialog_element  = $("#dialogTrash"),
                request         = null,
                cont_name       = $('.data_name');

            e.preventDefault();
            cont_name.text( $(this).data('name') );

            request = function () {
                $.get(action, form.serialize(), function(result) {
                    if (result.code === 200) {
                        var name = result.data.name;

                        if ( name === undefined )
                            name = result.data.username;
                        if ( name === undefined )
                            name = result.data.folio;
                        if ( name === undefined )
                            name = result.data.barcode;

                        show_message(name + ' se envio a la papelera correctamente.');
                        row.slideUp();
                    } else {
                        show_message(result.data.name + ' no se pudo enviar a la papelera, intentelo mas tarde.');
                        row.slideDown();
                    }
                }, 'json');
            };

            dialog_element.dialog({
                autoOpen: false,
                width: $("#dialogTrash").data('width'),
                modal: true,
                buttons: {
                    'Enviar a papelera': function () {
                        row.fadeOut(500);
                        request();

                        $(this).dialog('close');
                    },
                    'Cancelar': function () {
                        $(this).dialog('close');
                    }
                }
            });

            dialog_element.dialog('open');

        });
    }
};

var product_active = function (button) {
    var element = $(button);

    if ( element.length )
    {
        element.on('click', function (e) {

            var id              = $(this).data('id'),
                form            = $('#form-active'),
                action          = form.attr('action').replace('PRODUCT_ID', id),
                row             = $(this).parents('tr'),
                msgs            = $('.msgs'),
                dialog_element  = $("#dialogRestore"),
                request         = null,
                cont_name       = $('.data_name');

            e.preventDefault();
            cont_name.text( $(this).data('name') );

            request = function () {
                $.get(action, form.serialize(), function(result) {
                    if (result.code === 200) {
                        var name = result.data.name;

                        if ( name == undefined )
                            name = result.data.username;
                        if ( name === undefined )
                            name = result.data.folio;
                        if ( name === undefined )
                            name = result.data.barcode;

                        show_message(name + ' se recupero correctamente.');
                        row.slideUp();
                    } else {
                        show_message(result.data.name + ' no se pudo recuperar, intentelo mas tarde.');
                        row.slideDown();
                    }
                }, 'json');
            };

            dialog_element.dialog({
                autoOpen: false,
                width: $("#dialogRestore").data('width'),
                modal: true,
                buttons: {
                    'Recuperar': function () {
                        row.fadeOut(500);
                        request();

                        $(this).dialog('close');
                    },
                    'Cancelar': function () {
                        $(this).dialog('close');
                    }
                }
            });

            dialog_element.dialog('open');

        });
    }
};

var element_delete = function (button) {
    "use strict";

    var element = $(button);

    if ( element.length )
    {
        element.on('click', function (e) {

            var id             = $(this).data('id'),
                form           = $('#form-delete'),
                action         = form.attr('action').replace('PRODUCT_ID', id),
                row            = $(this).parents('tr'),
                msgs           = $('.msgs'),
                dialog_element = $("#dialogConfirm"),
                request        = null,
                cont_name      = $('.data_name');

            e.preventDefault();
            cont_name.text( $(this).data('name') );

            request = function () {
                $.post(action, form.serialize(), function(result) {
                    console.log(result);
                    if (result.code === 200) {
                        var name = result.data.name;

                        if ( typeof(name) == "undefined" )
                            name = result.message;
                        if ( typeof(name) == "undefined" )
                            name = result.data.barcode;
                        if ( typeof(name) == "undefined" )
                            name = result.data.username;
                        if( typeof(name) == "undefined" )
                            name = result.data.folio;
                        if( typeof(name) == "undefined" )
                            name = result.data.description;
                        if( typeof(name) == "undefined" )
                            name = result.data.concept;


                        show_message(name + ' se elimino correctamente.');
                        row.slideUp();
                    } else {
                        var name = result.data.name;

                        if ( typeof (name)  == "undefined")
                            name = result.data.folio;

                        show_message(name + ' no se pudo eliminar, intentelo mas tarde.');
                        row.slideDown();
                    }
                }, 'json');
            };

            dialog_element.dialog({
                autoOpen: false,
                width: $("#dialogConfirm").data('width'),
                modal: true,
                buttons: {
                    'Eliminar': function () {
                        row.fadeOut(500);
                        request();

                        $(this).dialog('close');
                    },
                    'Cancelar': function () {
                        $(this).dialog('close');
                    }
                }
            });

            dialog_element.dialog('open');

        });
    }
};

var product_cancel = function (button) {
    "use strict";

    var element = $(button);

    if ( element.length )
    {
        element.click( function (e) {

            var id             = $(this).data('id'),
                folio          = $(this).data('folio'),
                desc_text      = $('#description_cancel'),
                form           = $('#form-cancel'),
                action         = form.attr('action').replace('PRODUCT_ID', id),
                btn            = $(this),
                msgs           = $('.msgs'),
                dialog_folio   = $('#dialog_folio'),
                dialog_element = $("#dialogConfirm"),
                request        = null;

            e.preventDefault();
            dialog_folio.text( folio );

            request = function () {
                $.post(action, form.serialize(), function(result) {
                    console.log(result.success);
                    desc_text.val('');
                    if (result.success) {
                        setTimeout (function () {
                            btn.remove();
                        }, 100);
                    } else {
                        btn.fadeIn(500);
                    }

                    msgs.html(result.msg).slideDown().delay(3000).slideUp(600);
                }, 'json');
            };

            dialog_element.dialog({
                autoOpen: false,
                width: $("#dialogConfirm").data('width'),
                modal: true,
                buttons: {
                    'Cancelar factura/ticket': function () {
                        var text = desc_text.val();

                        if ( text === null || text.length === 0 || /^\s*$/.test(text) )
                        {
                            msgs.html('Escribe el motivo de cancelación de la factura.').slideDown().delay(3000).slideUp(600);
                        }
                        else
                        {
                            action = action.replace('PRODUCT_DESCRIPTION', text);
                            btn.fadeOut(500);
                            request();
                            $(this).dialog('close');
                        }
                    },
                    'Volver': function () {
                        $(this).dialog('close');
                    }
                }
            });

            dialog_element.dialog('open');

        });
    }
};