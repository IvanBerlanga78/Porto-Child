<?php

add_action( 'wp_enqueue_scripts', 'porto_child_css', 1001 );

// Load CSS
function porto_child_css() {
	// porto child theme styles
	wp_deregister_style( 'styles-child' );
	wp_register_style( 'styles-child', esc_url( get_stylesheet_directory_uri() ) . '/style.css' );
	wp_enqueue_style( 'styles-child' );

	if ( is_rtl() ) {
		wp_deregister_style( 'styles-child-rtl' );
		wp_register_style( 'styles-child-rtl', esc_url( get_stylesheet_directory_uri() ) . '/style_rtl.css' );
		wp_enqueue_style( 'styles-child-rtl' );
	}
}

add_action( 'wp_enqueue_scripts', 'checkout_scripts', 12 );
function checkout_scripts() { 
    if (is_page( 'checkout' ) ) {
    wp_enqueue_script( 'jqueryScrollTo', esc_url( get_stylesheet_directory_uri() ) . '/js/jquery.scrollTo.min.js' );
    wp_enqueue_script( 'jqueryUI', esc_url( get_stylesheet_directory_uri() ) . '/js/jquery-ui.min.js' );
    wp_enqueue_script( 'jquervalidate', esc_url( get_stylesheet_directory_uri() ) . '/js/jqueryvalidation/jquery.validate.min.js' );
     wp_enqueue_script( 'jquervalidate_aditional_methods', esc_url( get_stylesheet_directory_uri() ) . '/js/jqueryvalidation/additional-methods.min.js' );
     wp_enqueue_script( 'jquervalidate_localization', esc_url( get_stylesheet_directory_uri() ) . '/js/jqueryvalidation/localization/messages_es.min.js' );

    
    };

}

add_action( 'wp_enqueue_scripts', 'general_script', 12 );      
function general_script() { 
    wp_enqueue_script( 'general_script', esc_url( get_stylesheet_directory_uri() ) . '/js/script.js' );
}

add_action( 'wp_enqueue_scripts', 'awesomplete_script', 12 );     
function awesomplete_script() { 
  
    wp_enqueue_script( 'awesomplete', esc_url( get_stylesheet_directory_uri() ) . '/js/awesomplete-custom.js' );
    wp_enqueue_script( 'search_script', esc_url( get_stylesheet_directory_uri() ) . '/js/script-search.js' );
    wp_enqueue_style( 'awesomplete-css', esc_url( get_stylesheet_directory_uri() ) . '/css/awesomplete.css' );
    
}




add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
function woo_remove_product_tabs( $tabs ) {
 
    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
 
    return $tabs;
 }


add_action( 'woocommerce_after_add_to_cart_form', 'get_product_tab_templates_displayed', 2 );


function get_product_tab_templates_displayed() {

wc_get_template( 'single-product/tabs/description.php' );

wc_get_template( 'single-product/tabs/additional-information.php' );

comments_template();
}



/**
 * Hides the product's weight and dimension in the single product page.
 */
add_filter( 'wc_product_enable_dimensions_display', '__return_false' );

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


    
/**
 * @snippet       Shipping by Weight | WooCommerce
 */
  
add_filter( 'woocommerce_package_rates',  'modify_shipping_rate', 15, 2 );

function modify_shipping_rate( $available_shipping_methods, $package ){

    global $woocommerce;
	$shipping_zone = WC_Shipping_Zones::get_zone_matching_package( $package );
    $zone=$shipping_zone->get_zone_name();
    $total_weight = WC()->cart->cart_contents_weight;
    $total_coast = WC()->cart->get_cart_contents_total();
	
	if($zone=='Barcelona Ciudad'){
		if($total_coast >= 100  ){
			unset($available_shipping_methods['apg_shipping:7']);
		}
		else {
			unset($available_shipping_methods['free_shipping:9']);
		}
		
	}
	/*
	elseif ($zone=='Península'){
		if( $total_weight > 50  ){
        unset($available_shipping_methods['free_shipping:15']); //Remove flat rate for coat abobe 150€
   	 }elseif($total_coast >= 150  ){
        unset($available_shipping_methods['apg_shipping:17']); // remove free shipping for below 20$ 
        //$available_shipping_methods['flat_rate:16']; // add 2$ if weight exceeds 10KG
    }else{
        unset($available_shipping_methods['free_shipping:15']); // remove free shipping for below 20$ 
    }

	}

    */
    return $available_shipping_methods;
}

/**
 * @snippet       Notice with $$$ remaining to Free Shipping @ WooCommerce Cart
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.6.2
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
//add_action( 'woocommerce_before_checkout_form', 'bbloomer_free_shipping_cart_notice', 10 );
add_action( 'woocommerce_review_order_before_shipping', 'bbloomer_free_shipping_cart_notice', 10 );
 	
function bbloomer_free_shipping_cart_notice($shipping_packages){

	global $woocmmerce;
	$min_amount = 100;
	$current = WC()->cart->subtotal;
	$shipping_packages =  WC()->cart->get_shipping_packages();
	$shipping_zone = wc_get_shipping_zone( reset( $shipping_packages ) );
    $zone=$shipping_zone->get_zone_name();
    if(($zone=='Barcelona Ciudad')&& ($current < $min_amount)){ 
		$min_amount = 100;
		$added_text = esc_html__('Consigue envío gratuito comprando ', 'woocommerce' ) . wc_price( $min_amount - $current ) . esc_html__(' más!', 'woocommerce' );
           $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
           $notice = sprintf( '<a href="%s" style="text-decoration:underline;" class="wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( '¿Quieres continuar comprando?', 'woocommerce' ), $added_text );
           wc_print_notice( $notice, 'notice' );

    }
	/* elseif($zone=='Península'&& $current < $min_amount){
        $min_amount = 150;
		$added_text = esc_html__('Consigue envío gratuito comprando ', 'woocommerce' ) . wc_price( $min_amount - $current ) . esc_html__(' más!', 'woocommerce' );
   $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
   $notice = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continuar Comprando', 'woocommerce' ), $added_text );
   wc_print_notice( $notice, 'notice' );
    } */
}

/**
 * Cambiar el método de pago por defecto
 * 
 */
//add_action( 'template_redirect', 'define_default_payment_gateway' );
function define_default_payment_gateway(){
    if( is_checkout() && ! is_wc_endpoint_url() ) {
        // HERE define the default payment gateway ID
        $default_payment_id = 'payment_method_redsys';

        WC()->session->set( 'chosen_payment_method', $default_payment_id );
    }
}
/**
 * Personaliza el título en la página de pedido recibido
 * 
 */

add_filter( 'the_title', 'woo_personalize_order_received_title', 10, 2 );
function woo_personalize_order_received_title( $title, $id ) {
    if ( is_order_received_page() && get_the_ID() === $id ) {
	    global $wp;
        // Get the order. Line 9 to 17 are present in order_received() in includes/shortcodes/class-wc-shortcode-checkout.php file
        $order_id  = apply_filters( 'woocommerce_thankyou_order_id', absint( $wp->query_vars['order-received'] ) );
        $order_key = apply_filters( 'woocommerce_thankyou_order_key', empty( $_GET['key'] ) ? '' : wc_clean( $_GET['key'] ) );
        if ( $order_id > 0 ) {
            $order = wc_get_order( $order_id );
            if ( $order->get_order_key() != $order_key ) {
                $order = false;
            }
        }
        if ( isset ( $order ) ) {
            //$title = sprintf( "You are awesome, %s!", esc_html( $order->billing_first_name ) ); // use this for WooCommerce versions older then v2.7
	    $title = sprintf( "Gracias por tu compra, %s!", esc_html( $order->get_billing_first_name() ) );
        }
    }
    return $title;
}

/**
 * @snippet       Deny Checkout Based on Cart Weight - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21748
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_action( 'woocommerce_after_checkout_validation', 'bbloomer_deny_checkout_if_weight' );
 
function bbloomer_deny_checkout_if_weight( $posted ) {
$max_weight = 100;
if ( WC()->cart->cart_contents_weight > $max_weight ) {
   $notice = 'Lo sentimos, el peso de tu pedido excede nuestro máximo de  ' . $max_weight . get_option( 'woocommerce_weight_unit' );
   wc_add_notice( $notice, 'error' );
}
}


// Remove the product description Title
add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
 return '';
}

/** 
 * remove on single product panel 'Additional Information' since it already says it on tab.
 */
add_filter('woocommerce_product_additional_information_heading', 'isa_product_additional_information_heading');
 
function isa_product_additional_information_heading() {
    return '';
}

/**
 * Rename product data tabs
 */
// Change the reviews heading to product name
add_filter( 'gettext', 'misha_no_reviews_heading', 20, 3 );
function misha_no_reviews_heading( $translated, $text, $domain ) {
 
    if( is_product() && $translated == 'Valoraciones' && $domain == 'woocommerce' ) {
        $translated = '';
    }
 
    return $translated;
 
}

/**
* Hook: woocommerce_before_single_product_summary.
 *
 * @hooked woocommerce_show_product_sale_flash - 10
 * @hooked woocommerce_show_product_images - 20
 */
add_filter( 'woocommerce_show_page_title', 'not_a_shop_page' );
function not_a_shop_page() {
    return boolval(!is_shop());
}


// define the woocommerce_single_product_summary callback function

function my_custom_action() { 
    echo '<p>This is my custom action function</p>';
};


// Product thumbnail in checkout
        add_filter( 'woocommerce_cart_item_name', 'product_thumbnail_in_checkout', 20, 3 );
        function product_thumbnail_in_checkout( $product_name, $cart_item, $cart_item_key ){
            if ( is_checkout() ) {

                $thumbnail   = $cart_item['data']->get_image(array( 90, 90));
                $image_html  = '<div class="product-item-thumbnail">'.$thumbnail.'</div> ';

                $product_name = $image_html . $product_name;
            }
            return $product_name;
        }


/**
* Add custom field to the checkout page - Recogida en tienda
*/

//add_action('woocommerce_review_order_after_shipping', 'custom_checkout_field');

function custom_checkout_field($checkout)

{
    
echo '<div id="custom_checkout_field" class="hiddenLocales">
    <h3><label>
     
        <span>' . __('¿Recogida en tienda?') . '</span></label></h3>';
echo '<div class="wrapper_shop_options">';
echo '<p>' . __('Para recogida en cualquiera de nuestras tiendas consultar disponibilidad en el 932011513') . '</p>';
woocommerce_form_field('opcion-tienda', array(  
'type' => 'radio',
'options' => array('Rambla' => 'Rambla de Catalunya, 65 Barcelona', 'Bach' => 'Juan Sebastián Bach, 20, Barcelona', 'Fontcoberta' => 'Fontcoberta, 6, Barcelona', 'Ferran' => 'Ferran, 20, Barcelona', 'Cerdanyola' => 'Avda. de Cerdanyola, 8-10, Sant Cugat del Vallès', 'Arago' => 'Aragó, 241, Barcelona', 'Ayala' => 'Ayala, 3, Madrid' ),
'class' => array(
'my-field-class form-row-wide'
) ,
'label' => __('Selecciona una tienda') ,
'placeholder' => __('Selecciona la tienda') ,
'input_class' => array(
'option-input radio')   ,
) ,
$checkout->get_value('opcion-tienda'));
echo '</div>';
echo '</div>';
}


/**
 * Añade columna a panel de pedidos del dashboard
 */

add_filter('manage_edit-shop_order_columns', 'misha_order_items_column' );
function misha_order_items_column( $order_columns ) {
    $order_columns['order_products'] = "Recoge en";
    return $order_columns;
}


/**
 * Muestra la tienda en la que recoge el cliente en la columna del panel de pedidos
 */
add_action('manage_shop_order_posts_custom_column','column_page_template',10,2);
function column_page_template($column_name, $post) {
    global $post, $woocommerce, $the_order;


    if ($column_name == 'order_products') {
       $custom_field_value = get_post_meta( $post->ID, 'opcion-tienda', true );
            if( ! empty( $custom_field_value ) )
                echo $custom_field_value;
    }
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {

    if ($_POST['opcion-tienda']) update_post_meta( $order_id, 'opcion-tienda', esc_attr($_POST['opcion-tienda']));
}


//* Process the checkout
 add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;
    // Check if set, if its not set add an error.
    if ($_POST['opcion-tienda'] == "blank")
     wc_add_notice( '<strong>Please select a day part under Delivery options</strong>', 'error' );
 }

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_order_details', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<br><h3>'.__('Recogida en tienda').':' . get_post_meta( $order->id, 'opcion-tienda', true ) . '</h3>';
}


/**
 * Add the field to the checkout - Nota regalo
 */
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    //echo '<div id="my_custom_checkout_field"><h3>' . __('¿Añadir nota regalo?') . '</h3>';

    woocommerce_form_field( 'nota-regalo', array(
        'type'          => 'textarea',
        'class'         => array('nota-regalo form-row-wide'),
        'label'         => __('¿Añadir nota regalo?'),
        'placeholder'   => __('Añade aquí tu texto'),
        ), $checkout->get_value( 'nota-regalo' ));

    //echo '</div>';

}


/**
 * Add the field to the checkout - Recoger en tienda
 */
add_action( 'woocommerce_before_order_notes', 'recoger_tienda_checkout_field' );

function recoger_tienda_checkout_field( $checkout ) {

    //echo '<div id="my_custom_checkout_field"><h3>' . __('¿Añadir nota regalo?') . '</h3>';

    woocommerce_form_field( 'recoger-local', array(
        'type'          => 'select',
        'class'         => array('recoger_local form-row-wide'),
        'label'         => __('Elige el local (sólo si has seleccionado esta forma de envío)'),
        'options'       => array(
            'blank'     => __( 'Selecciona una tienda', 'porto' ),
            'Rambla'   => __( 'Rambla de Catalunya, 65 Barcelona', 'porto' ),
            'Ferran' => __( 'Ferran, 20, Barcelona', 'porto' ),
            'Cerdanyola'   => __( 'Avda. de Cerdanyola, 8-10, Sant Cugat del Vallès', 'porto' ),
            'Arago'   => __( 'Aragó, 241, Barcelona', 'porto' ),
            'Ayala'   => __( 'Ayala, 3, Madrid', 'porto' )
        )
        ), $checkout->get_value( 'recoger-local' ));

    // echo '</div>';

}

/**
 * Añade el campo NIF a la página de checkout de WooCommerce
 */
add_action( 'woocommerce_before_checkout_billing_form', 'agrega_mi_campo_personalizado' );
 
function agrega_mi_campo_personalizado( $checkout ) {
 
    //echo '<div id="additional_checkout_field"><h2>' . __('Información adicional') . '</h2>';
 
    echo '<div>';
    woocommerce_form_field( 'nif', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('NIF-DNI'),
        'required'      => false,
        //'placeholder'   => __('Introduzca el Nº NIF-DNI'),
        ), $checkout->get_value( 'nif' ));
 
    echo '</div>';
 
}

/**
 * Actualiza la información del pedido con el nuevo campo
 */
add_action( 'woocommerce_checkout_update_order_meta', 'actualizar_info_pedido_con_nuevo_campo' );
 
function actualizar_info_pedido_con_nuevo_campo( $order_id ) {
    if ( ! empty( $_POST['nif'] ) ) {
        update_post_meta( $order_id, 'NIF', sanitize_text_field( $_POST['nif'] ) );
    };
    if ( ! empty( $_POST['nota-regalo'] ) ) {
        update_post_meta( $order_id, 'NOTA REGALO', sanitize_text_field( $_POST['nota-regalo'] ) );
    };
    if ( ! empty( $_POST['recoger-local'] ) ) {
        update_post_meta( $order_id, 'RECOGER EN LOCAL', sanitize_text_field( $_POST['recoger-local'] ) );
    };
}

/**
 * Muestra custom fields del checkout en la página de edición del pedido
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'mostrar_campo_personalizado_en_admin_pedido', 10, 1 );
 
function mostrar_campo_personalizado_en_admin_pedido($order){
    echo '<p><strong>'.__('NIF').':</strong> ' . get_post_meta( $order->id, 'NIF', true ) . '</p>';
    echo '<p><strong>'.__('NOTA REGALO').':</strong> ' . get_post_meta( $order->id, 'NOTA REGALO', true ) . '</p>';
    echo '<p><strong>'.__('RECOGER EN LOCAL').':</strong> ' . get_post_meta( $order->id, 'RECOGER EN LOCAL', true ) . '</p>';
}

/**
 * Incluye custom fields del checkout en el email de notificación del cliente
 */
 
add_filter('woocommerce_email_order_meta_keys', 'muestra_campo_personalizado_email');
 
function muestra_campo_personalizado_email( $keys ) {
    $keys[] = 'NIF';
    return $keys;
}

/**
*Incluir custom fields del checkout en la factura (necesario el plugin WooCommerce PDF Invoices & Packing Slips)
*/
 
add_filter( 'wpo_wcpdf_billing_address', 'incluir_campos_en_factura' );
 
function incluir_campos_en_factura( $address ){
  global $wpo_wcpdf;
 
  echo $address . '<p>';
  $wpo_wcpdf->custom_field( 'NIF', 'NIF: ' );
  echo '</p>';

  echo '<p>';
  $wpo_wcpdf->custom_field( 'NOTA REGALO', 'NOTA REGALO: ' );
  echo '</p>';

  echo '<p>';
  $wpo_wcpdf->custom_field( 'RECOGER EN LOCAL', 'RECOGER EN LOCAL: ' );
  echo '</p>';
}

?>

<?php

add_action( 'woocommerce_before_checkout_form', 'print_donation_notice', 10 );
function print_donation_notice() {
    wc_print_notice( sprintf(
        __("¿Quieres añadir una caja o estuche a tu compra? Cómpralo <a href='https://lafuente.es/cat-prod/embalaje/'>aquí</a>", "porto"),
        '<strong>' . __("No la olvides:", "porto") . '</strong>',
        strip_tags( wc_price( WC()->cart->get_subtotal() * 0.03 ) )
    ), 'success' );
}


// Quitar el order review (Finalizar Compra) para ponerlo en la función 'websites_depot_order_fragments_split_shipping'

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );


/**
 * Moving the payments
 */
add_action( 'woocommerce_checkout_after_customer_details', 'my_custom_display_payments', 20 );

/**
 * Displaying the Payment Gateways 
 */
function my_custom_display_payments() {
  if ( WC()->cart->needs_payment() ) {
    $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
    WC()->payment_gateways()->set_current_gateway( $available_gateways );
  } else {
    $available_gateways = array();
  }
  ?>
  <div id="checkout_payments">
    <h3><?php esc_html_e( 'Billing', 'woocommerce' ); ?></h3>
    <?php if ( WC()->cart->needs_payment() ) : ?>
    <ul class="wc_payment_methods payment_methods methods">
    <?php
    if ( ! empty( $available_gateways ) ) {
      foreach ( $available_gateways as $gateway ) {
        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
      }
    } else {
      echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
    }
    ?>
    </ul>
  <?php endif; ?>
  </div>
<?php
}

/**
 * Adding the payment fragment to the WC order review AJAX response
 */
add_filter( 'woocommerce_update_order_review_fragments', 'my_custom_payment_fragment' );

/**
 * Adding our payment gateways to the fragment #checkout_payments so that this HTML is replaced with the updated one.
 */
function my_custom_payment_fragment( $fragments ) {
    ob_start();

    my_custom_display_payments();

    $html = ob_get_clean();

    $fragments['#checkout_payments'] = $html;

    return $fragments;
}
?>

<?php
/**
 * Moving the shipping form
 */
add_action( 'woocommerce_review_order_before_shipping', 'my_custom_display_shipping_form', 20 );

/**
 * Displaying the Shipping Form 
 */
function my_custom_display_shipping_form() {
  ?>
  <div class="woocommerce-shipping-fields" id="woocommerce-shipping-fields">
    <?php 
        $checkout = WC()->checkout();
         if ( true === WC()->cart->needs_shipping_address() ) : ?>

        <h3 id="ship-to-different-address">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php esc_html_e( 'Ship to a different address?', 'woocommerce' ); ?></span>
            </label>
        </h3>

        <div class="shipping_address">

            <?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

            <div class="woocommerce-shipping-fields__field-wrapper">
                <?php
                $fields = $checkout->get_checkout_fields( 'shipping' );

                foreach ( $fields as $key => $field ) {
                    woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                }
                ?>
            </div>

            <?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

        </div>

    <?php endif; ?>
</div>
<?php
}

/**
 * Adding the shipping fragment to the WC order review AJAX response
 */
//add_filter( 'woocommerce_update_order_review_fragments', 'my_custom_shipping_form' );

/**
 * Adding shipping form data to #checkout_payments so that this HTML is replaced with the updated one.
 */
function my_custom_shipping_form( $fragments ) {
    ob_start();

    my_custom_display_shipping_form();

    $html = ob_get_clean();

    $fragments['#woocommerce-shipping-fields'] = $html;

    return $fragments;
}



/**
 * Moving the shipping options
 */
add_action( 'woocommerce_review_order_after_shipping', 'my_custom_display_shipping_options', 20 );

/**
 * Displaying the Shipping Options 
 */
function my_custom_display_shipping_options() {
  ?>
  <table class="shop_table websites-depot-checkout-review-shipping-table">
        <?php wc_cart_totals_shipping_html(); ?>
    </table>
<?php
}


/**
 * Adding the shipping options fragment to the WC order review AJAX response
 */
add_filter( 'woocommerce_update_order_review_fragments', 'my_custom_payment_fragment_2' );

/**
 * Adding our payment gateways to the fragment #checkout_payments so that this HTML is replaced with the updated one.
 */
function my_custom_payment_fragment_2( $fragments ) {
    ob_start();

    my_custom_display_shipping_options();

    $html = ob_get_clean();

    $fragments['.websites-depot-checkout-review-shipping-table'] = $html;

    return $fragments;
}



// To test this code, open a private/incognito window, add an item to the cart and then go to cart page.
// Once an option is choosen, it will be the default option from that moment onwards.

// Code to clear default shipping option.
//add_filter( 'woocommerce_shipping_chosen_method', '__return_false', 99);

// Code to clear default payment option.
//add_filter( 'pre_option_woocommerce_default_gateway' . '__return_false', 99 );



/**
Wp_Schedule_Event every day at specific time
**/

function myprefix_custom_cron_schedule( $schedules ) {
    $schedules['every_six_hours'] = array(
        'interval' => 21600, // Every 6 hours
        'display'  => __( 'Every 6 hours' ),
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'myprefix_custom_cron_schedule' );

//Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'myprefix_cron_hook' ) ) {
    wp_schedule_event( time(), 'every_six_hours', 'myprefix_cron_hook' );
}

///Hook into that action that'll fire every six hours
 add_action( 'myprefix_cron_hook', 'write_json' );

//create your function, that runs on cron
function write_json() {
          global $wpdb;

            $sql = "select post_title
            from $wpdb->posts
            where post_type = 'product'
            and post_status='publish'";

        $sql = $wpdb->prepare($sql);  // Replaces the %s in $sql with $input
        $results = $wpdb->get_results($sql, OBJECT);  // Get the rows from the database

        // Build an array of matching post titles
        $post_titles = array();
        foreach ($results as $r) {
            $post_titles[] = addslashes($r->post_title);
        }

        $fp = fopen('aw_database_data.json', 'w');
        if ( !$fp ) {
          echo 'fopen failed. reason: ', $php_errormsg;
        }
        fwrite($fp, json_encode($post_titles));
        fclose($fp);
}