<?php

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

global $porto_settings;


$js_wc_prdctfltr = false;
if ( class_exists( 'WC_Prdctfltr' ) ) {
	$porto_settings['category-ajax'] = false;
}

if ( $porto_settings['category-ajax'] ) {
	// fix price slider issue
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_register_script( 'wc-jquery-ui-touchpunch', WC()->plugin_url() . '/assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch' . $suffix . '.js', array( 'jquery-ui-slider' ), WC_VERSION, true );
	wp_register_script( 'wc-price-slider', WC()->plugin_url() . '/assets/js/frontend/price-slider' . $suffix . '.js', array( 'jquery-ui-slider', 'wc-jquery-ui-touchpunch' ), WC_VERSION, true );
	wp_enqueue_script( 'wc-price-slider' );
}
?>


<?php
	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	do_action( 'woocommerce_before_main_content' );
?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

	<h2 class="page-title"><?php woocommerce_page_title(); ?></h2>

<?php endif; ?>

<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
?>

<?php if ( ( function_exists( 'woocommerce_product_loop' ) && woocommerce_product_loop() ) || ( ! function_exists( 'woocommerce_product_loop' ) && have_posts() ) ) { ?>

	<?php
		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked woocommerce_output_all_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );
	?>

	<?php
		global $woocommerce_loop;

	if ( ! ( isset( $woocommerce_loop['category-view'] ) && $woocommerce_loop['category-view'] ) ) {
		$woocommerce_loop['category-view'] = isset( $porto_settings['category-view-mode'] ) ? $porto_settings['category-view-mode'] : '';

		$term = get_queried_object();
		if ( $term && isset( $term->taxonomy ) && isset( $term->term_id ) ) {
			$cols = get_metadata( $term->taxonomy, $term->term_id, 'product_cols', true );
			if ( ! $cols ) {
				$cols = $porto_settings['product-cols'];
			}

			$addlinks_pos = get_metadata( $term->taxonomy, $term->term_id, 'addlinks_pos', true );
			if ( ! $addlinks_pos ) {
				$addlinks_pos = $porto_settings['category-addlinks-pos'];
			}

			$view_mode = get_metadata( $term->taxonomy, $term->term_id, 'view_mode', true );

			$woocommerce_loop['columns']        = $cols;
			$woocommerce_loop['columns_mobile'] = $porto_settings['product-cols-mobile'];
			$woocommerce_loop['addlinks_pos']   = $addlinks_pos;
			if ( $view_mode ) {
				$woocommerce_loop['category-view'] = $view_mode;
			}
		}
	}


	if ( ($post->ID == 190021) ) {
		$woocommerce_loop['columns']        = $porto_settings['shop-product-cols'];
		$woocommerce_loop['columns_mobile'] = $porto_settings['shop-product-cols-mobile'];
	}
	?>


  <?php
  /**
 * Handle a custom 'customvar' query var to get products with the 'customvar' meta.
 * @param array $query - Args for WP_Query.
 * @param array $query_vars - Query vars from WC_Product_Query.
 * @return array modified $query
 */
function handle_custom_query_var( $query, $query_vars ) {
	if ( ! empty( $query_vars['customvar'] ) ) {
		$query['meta_query'][] = array(
			'key' => 'customvar',
			'value' => esc_attr( $query_vars['customvar'] ),
		);
	}

	return $query;
}
add_filter( 'woocommerce_product_data_store_cpt_get_products_query', 'handle_custom_query_var', 10, 2 );


    if(!function_exists('wc_get_products')) {
      return;
    }

    $paged                   = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $ordering                = WC()->query->get_catalog_ordering_args();
    $ordering['orderby']     = array_shift(explode(' ', $ordering['orderby']));
    $ordering['orderby']     = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
    $products_per_page       = apply_filters('loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page());

    $featured_products       = wc_get_products(array(
      'meta_key'             => '_price',
      'status'               => 'publish',
      'limit'                => $products_per_page,
      'page'                 => $paged,
      /*'featured'             => true,*/
      'include'              => wc_get_product_ids_on_sale(),
      'paginate'             => true,
      'return'               => 'ids',
      'orderby'              => $ordering['orderby'],
      'order'                => $ordering['order'],

    ));

    wc_set_loop_prop('current_page', $paged);
    wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
    wc_set_loop_prop('page_template', get_page_template_slug());
    wc_set_loop_prop('per_page', $products_per_page);
    wc_set_loop_prop('total', $featured_products->total);
    wc_set_loop_prop('total_pages', $featured_products->max_num_pages);
?>

<?php    if($featured_products) {
      do_action('woocommerce_before_shop_loop');
?>
      <div class="archive-products">
<?php   woocommerce_product_loop_start();
        foreach($featured_products->products as $featured_product) {
          $post_object = get_post($featured_product);
          setup_postdata($GLOBALS['post'] =& $post_object);

          wc_get_template_part('content', 'product');
        }
        wp_reset_postdata();
      woocommerce_product_loop_end();?>
      </div>
    <?php   do_action('woocommerce_after_shop_loop');?>
      <?php


    } else {
      do_action('woocommerce_no_products_found');
    }

   ?>


	<?php
		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
	?>

	<?php
} else {

	global $porto_shop_filter_layout;
	if ( isset( $porto_shop_filter_layout ) && 'horizontal2' == $porto_shop_filter_layout ) {
		do_action( 'woocommerce_before_shop_loop' );
	} else {
		?>
	<div class="shop-loop-before clearfix" style="display:none;"> </div>
<?php } ?>

	<div class="archive-products">
	<?php
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		//do_action( 'woocommerce_no_products_found' );
	?>
	</div>

	<div class="shop-loop-after clearfix" style="display:none;"> </div>

	<?php
}
	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
?>

<?php
	/**
	 * Hook: woocommerce_sidebar.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action( 'woocommerce_sidebar' );

  get_footer( 'shop' );
?>
<style>
.shop-loop-after,.shop-loop-before {display: block!important}
</style>
