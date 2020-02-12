/*
 * Comportamiento de apertura y cierre del modal buscador
 *
 */

jQuery(document).ready(function( $ ) {

    if($('body').is('.woocommerce-checkout') && !$('body').is('.woocommerce-checkout.woocommerce-order-received') ){

    //Botones acordeón Checkout
    $('#accordion').accordion({
        heightStyle: "content",
        activate: function( event, ui ) {
        if(!$.isEmptyObject(ui.newHeader.offset())) {
            theOffset = $(this).offset();
            $('html:not(:animated), body:not(:animated)').animate({ scrollTop: ui.newHeader.offset().top-60 }, 'slow');
        }
    }
    });
    $('#accordion .btn').click(function (e) {
        e.preventDefault();
        var delta = ($(this).is('.next') ? 1 : -1);
        $('#accordion').accordion('option', 'active', ($('#accordion').accordion('option', 'active') + delta));
    });

}//end if//



    jQuery( document.body ).on( 'updated_checkout', function(){


        if($('#shipping_method_0_local_pickup5').is(':checked')|| $('#shipping_method_0_local_pickup30').is(':checked')) {
             $('.recoger_local').show();
        }else {
            $('.recoger_local').hide();
        }

});




 /*
 * Cierra por defecto los acordeones de los filtros de categoria
 * todos, menos el filtro de precio
 */

jQuery.extend(theme.WooWidgetToggle.prototype, {

    build: function() {
        var $el = this.options.wrapper;


            //$el.parent().addClass('closed');


            if (window.location.href.indexOf("?filter") > -1){
                $('.woocommerce-widget-layered-nav ul').show();
                /*$(".woocommerce-widget-layered-nav-list li.woocommerce-widget-layered-nav-list__item--chosen")
                .parent().show(200,function() {


                //$el.parent().removeClass('closed');
                console.log("done");
                });*/
            }else {
                $('.woocommerce-widget-layered-nav ul').hide();
            }


            if (!$el.find('.toggle').length) {

                $el.append('<span class="toggle"></span>');
            }
            $el.find('.toggle').click(function() {
                if ($el.next().is(":visible")){
                    $el.parent().addClass('closed');
                } else {
                    $el.parent().removeClass('closed');
                }
                $el.next().stop().slideToggle(200);
                theme.refreshVCContent();
            });

            return this;
        }
    });


}); //end document-ready//
