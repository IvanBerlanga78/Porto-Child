<?php
/**
 * Checkout Form V1
 *
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$porto_woo_version = porto_get_woo_version_number();
$checkout          = WC()->checkout();

// filter hook for include new pages inside the payment method
$get_checkout_url = version_compare( $porto_woo_version, '2.5', '<' ) ? apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ) : wc_get_checkout_url(); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="row" id="customer_details">


			<div class="col-lg-5">
				<div class="align-left sticky">
					<div class="box-content">


						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action( 'woocommerce_checkout_order_review' ); ?>
						</div>


					</div>


				</div>
			</div>

			<div class="col-lg-7">
				<div class="align-left">
					<div class="box-content">
						<div class="accordion" id="accordion">
							<h4><a href="#"><span class="number">1</span>Datos de Facturación</a></h4>
							    <div class="panel">
							        <?php /* facturación*/
							      	do_action( 'woocommerce_checkout_billing' ); ?>
							        <a class="button next">Siguiente</a>
							    </div>
							 <h4><a href="#"><span class="number">2</span>Seleccionar Método de Pago</a></h4>
							    <div class="panel">
							        <?php
							      	/* Pago */
							      	do_action( 'woocommerce_checkout_after_customer_details' ); ?>

							        <a class="button previuous">Anterior</a>
							        <a class="button next">Siguiente</a>
							    </div>
							 <h4><a href="#"><span class="number">3</span>Envío</a></h4>
							    <div class="panel">
							        <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
							      	<!-- Envío -->

							      	<!-- End Envío -->
							      	<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
							      	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>
							        <a class="button previuous">Anterior</a>
							        <a class="button next">Siguiente</a>
							    </div>
							 <h4><a href="#"><span class="number">4</span>Finalizar Compra</a></h4>
							    <div class="panel">
							        <?php
							      	/* Pago */
							      	do_action( 'woocommerce_checkout_shipping' ); ?>
							        
							    </div>
						</div>

				</div>
			</div>
		</div>



	<?php endif; ?>


	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>


</form>
