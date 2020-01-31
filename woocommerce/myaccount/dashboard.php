<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h2><?php

	printf(
		__( 'Mi cuenta', 'woocommerce' )
	);
?></h2>

<p><?php

	printf(
		/* translators: 1: user display name 2: logout url */
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url() )
	);
?></p>

<p><?php
	/*
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);*/
?></p>

<div class="porto-wrap-container container">
	<div class="row">
		<div class="vc_column_container col-md-6">
			<div class="cell" onclick="location.href='https://lafuente.es/mi-cuenta/orders/';" style="cursor: pointer;">
					<div class="a-box-inner">
						<div class="row">
							<div class="vc_column_container col-md-3">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/icon-box.png">
							</div>
							<div class="vc_column_container col-md-9">
								<h2>PEDIDOS RECIENTES</h2>
								<p>Realizar el seguimiento, consultar productos y repetir compras anteriores 
								</p>
							</div>
						</div>
					</div>
			</div>
		</div>	
		<div class="vc_column_container col-md-6">
			<div class="cell">
					<div class="a-box-inner" onclick="location.href='https://lafuente.es/mi-cuenta/edit-address/';" style="cursor: pointer;">
						<div class="row">
							<div class="vc_column_container col-md-3">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/icon-marker.png">
							</div>
							<div class="vc_column_container col-md-9">
								<h2>DIRECCIONES</h2>
								<p>Editar direcciones de envío y facturación de sus productos 
								</p>
							</div>
						</div>
					</div>
			</div>
		</div>	
	</div><!-- end row -->
	<div class="row">
		<div class="vc_column_container col-md-6">
			<div class="cell">
					<div class="a-box-inner" onclick="location.href='https://lafuente.es/mi-cuenta/edit-account/';" style="cursor: pointer;">
						<div class="row">
							<div class="vc_column_container col-md-3">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/icon-lock.png">
							</div>
							<div class="vc_column_container col-md-9">
								<h2>SEGURIDAD</h2>
								<p>Editar inicio de sesión, nombre y apellido y contraseñas 
								</p>
							</div>
						</div>
					</div>
			</div>
		</div>	
		<div class="vc_column_container col-md-6">
			<div class="cell">
					<div class="a-box-inner last">
						<div class="row">
							<div class="vc_column_container col-md-3">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/icon-search.png">
							</div>
							<div class="vc_column_container col-md-9">
								<h2>LINKS DE SEGUIMIENTO</h2>
								
								<p><a href="https://seguimiento.impackta.com/">Pedidos nacionales</a><br>  
									<a href="">Pedidos internacionales</a> 
								</p>
							</div>
						</div>
					</div>
			</div>
		</div>	
	</div><!-- end row -->

	
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
