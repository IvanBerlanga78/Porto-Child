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
							  <div class="card">
							    <div class="card-header" id="headingOne">
							      <h5 class="mb-0">
							        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							          <h4><span class="number">1</span>Datos de Facturación</h4>
							        </button>
							      </h5>
							    </div>

							    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
							      <div class="card-body">
							      <?php /* facturación*/
							      do_action( 'woocommerce_checkout_billing' ); ?>
							       
                					<a class="button next btn btn-md pull-right">Next</a>	
							      </div>
							    </div>
							  </div>
							  <div class="card">
							    <div class="card-header" id="headingTwo">
							      <h5 class="mb-0">
							        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							          <h4><span class="number">2</span>Seleccionar Método de Pago</h4>
							        </button>
							      </h5>
							    </div>
							    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							      <div class="card-body">
							      	<?php 
							      	/* Pago */
							      	do_action( 'woocommerce_checkout_after_customer_details' ); ?>
							      	<a class="button previous btn btn-md pull-right">Previous</a>
							      	<a class="button next btn btn-md pull-right">Next</a>	
							       
							      </div>
							    </div>
							  </div>
							  <div class="card">
							    <div class="card-header" id="headingThree">
							      <h5 class="mb-0">
							        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							          <h4><span class="number">3</span>Envío</h4>
							        </button>
							      </h5>
							    </div>
							    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
							      <div class="card-body">

							      	<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
							      	<!-- Envío -->
							      	<table class="shop_table websites-depot-checkout-review-shipping-table"></table>
							      	<!-- End Envío -->
							      	<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

							      </div>
							    </div>
							  </div>
							  <div class="card">
							    <div class="card-header" id="headingFour">
							      <h5 class="mb-0">
							        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							          <h4><span class="number">4</span>Finalizar compra</h4>
							        </button>
							      </h5>
							    </div>
							    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
							      <div class="card-body">
				
							      	<?php 
							      	/* Pago + enviar a dirección diferente */
							      	do_action( 'woocommerce_checkout_shipping' ); ?>
							    

							      </div>
							    </div>
							  </div>

							</div>
					
				</div>
			</div>
		</div>

		

	<?php endif; ?>


	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>


</form>