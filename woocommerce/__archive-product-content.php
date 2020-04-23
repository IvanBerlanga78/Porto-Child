<?php

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
<?php

	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


/**********VINOS***********/
if ($url== 'http://lafuente.es/cat-prod/vinos/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_vinos.jpg" class="category-image" alt="VINOS">
		</a>
<?php
}
elseif (strpos($url,'vinos') !== false && strpos($url,'?filter_pais') !== false) {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_vinos.jpg" class="category-image" alt="VINOS">
	</a>
<?php
}
elseif ($url== 'http://lafuente.es/cat-prod/vinos/tinto/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_tinto.jpg" class="category-image" alt="TINTO">
	</a>
<?php

}elseif ($url== 'http://lafuente.es/cat-prod/vinos/oporto/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_oporto.jpg" class="category-image" alt="OPORTO">
	</a>
<?php

}elseif ($url== 'http://lafuente.es/cat-prod/vinos/rosado/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_rosado.jpg" class="category-image" alt="ROSADO">
	</a>
<?php

}elseif ($url== 'http://lafuente.es/cat-prod/vinos/madeira/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_madeira.jpg" class="category-image" alt="MADEIRA">
	</a>
<?php

}elseif ($url== 'http://lafuente.es/cat-prod/vinos/generoso/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_generoso.jpg" class="category-image" alt="GENEROSO">
	</a>
<?php
}elseif (strpos($_SERVER['REQUEST_URI'], "&filter_region=doca-rioja") !== false) {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_vinos.jpg" class="category-image" alt="DOCA RIOJA">
		</a>
<?php
/**********ESPUMOSOS***********/
}elseif ($url== 'http://lafuente.es/cat-prod/espumosos/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_espumosos.jpg" class="category-image" alt="ESPUMOSOS">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/espumosos/cava/') {
?>
		<a href="https://lafuente.es/?s=ars+collecta&post_type=product">
			<img src="https://lafuente.es/wp-content/uploads/2020/04/COD_banners_Lafuente_900x200_104.jpg" class="category-image" alt="ARS COLLECTA">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/espumosos/champagne/') {
?>
		<a href="http://lafuente.es/?s=moet+%26+chandon&post_type=product">
			<img src="https://lafuente.es/wp-content/uploads/2020/03/Banner-Lafuente-Moet-4.jpg" class="category-image" alt="MOET&CHANDON">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/espumosos/sidra/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_sidra.jpg" class="category-image" alt="SIDRA">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/espumosos/sangria/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_sangria.jpg" class="category-image" alt="SANGRIA">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/vinificacion/blanco/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2020/04/categorias_vinificacion_blanco.jpg" class="category-image" alt="VINIFICACION-BLANCO">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/vinificacion/rosado/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2020/04/categorias_vinificacion_rosado.jpg" class="category-image" alt="VINIFICACION-ROSADO">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/vinificacion/blanc-de-blancs/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2020/04/categorias_vinificacion_blanc_de_blancs.jpg" class="category-image" alt="VINIFICACION-BLANC-DE-BLANCS">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/vinificacion/blanc-de-noirs/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2020/04/categorias_vinificacion_blanc_de_noirs.jpg" class="category-image" alt="VINIFICACION-BLANC-DE-NOIRS">
		</a>
<?php
/**********DESTILADOS***********/
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_destilados.jpg" class="category-image" alt="ABSENTA">
		</a>
<?php

}elseif ($url== 'http://lafuente.es/cat-prod/destilados/absenta/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_absenta.jpg" class="category-image" alt="ABSENTA">
		</a>
<?php

}elseif ($url== 'http://lafuente.es/cat-prod/destilados/anisado/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_anisado.jpg" class="category-image" alt="ANISADO">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/bitter/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_bitter.jpg" class="category-image" alt="BITTER">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/calvados/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_calvados.jpg" class="category-image" alt="CALVADOS">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/ginebra/') {
?>
		<a href="https://lafuente.es/?s=GIN+ROKU&post_type=product">
			<img src="https://lafuente.es/wp-content/uploads/2020/03/roku2-900x200-1.jpg" class="category-image" alt="ROKU GIN">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/marc/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_marc.jpg" class="category-image" alt="MARC">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/pacharan/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_pacharan.jpg" class="category-image" alt="PACHARAN">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/sake/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_sake.jpg" class="category-image" alt="SAKE">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/vodka/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_vodka.jpg" class="category-image" alt="VODKA">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/ackuavit/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_ackuavit.jpg" class="category-image" alt="ACKUAVIT">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/aperitivo/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_aperitivo.jpg" class="category-image" alt="APERITIVO">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/brandy/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_brandy.jpg" class="category-image" alt="BRANDY">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/cognac/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_cognac.jpg" class="category-image" alt="COGNAC">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/grappa/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_grappa.jpg" class="category-image" alt="GRAPPA">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/mezcal/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_mezcal.jpg" class="category-image" alt="MEZCAL">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/pisco/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_pisco.jpg" class="category-image" alt="PISCO">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/tequila-sotol/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_tequila-sotol.jpg" class="category-image" alt="TEQUILA-SOTOL">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/armagnac/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_armagnac.jpg" class="category-image" alt="ARMAGNAC">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/cachaca/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_CACHACA.jpg" class="category-image" alt="CACHACA">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/crema-de-whisky/') {
?>
		<a href="http://www.lafuente.es">
			<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_crema_whisky.jpg" class="category-image" alt="CREMA DE WHISKY">
		</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/licor/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_licor.jpg" class="category-image" alt="LICOR">
	</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/orujo/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_orujo.jpg" class="category-image" alt="ORUJO">
	</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/ron/') {
?>
	<a href="https://lafuente.es/?s=RON+ABUELO&post_type=product">
		<img src="http://lafuente.es/wp-content/uploads/2020/03/BANNER-GENERICO.jpg" class="category-image" alt="RON ABUELO">
	</a>
<?php
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/vermut/') {
?>
	<a href="http://www.lafuente.es">
		<img src="https://lafuente.es/wp-content/uploads/2020/03/banner-900x200-lafuente_Mesa-de-trabajo-1-scaled.jpg" class="category-image" alt="VERMUT DOS DEUS">
	</a>
<?php
/**********WHISKY***********/
}elseif ($url== 'http://lafuente.es/cat-prod/destilados/whisky/') {
?>
	<a href="http://www.lafuente.es">
		<img src="https://lafuente.es/wp-content/uploads/2020/03/auchentoshan-900x200-gama-completab.jpg" class="category-image" alt="AUCHENTOSAN">
	</a>
<?php
}elseif ($url== 'http://lafuente.es/tipo/blended-reserve/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_whisky.jpg" class="category-image" alt="ESCOCÉS BLENDED">
	</a>
<?php
}elseif ($url== 'http://lafuente.es/tipo/blended/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_whisky.jpg" class="category-image" alt="BLENDED RESERVE">
	</a>
<?php
}elseif ($url== 'http://lafuente.es/tipo/single-malt/') {
?>
	<a href="http://www.lafuente.es">
		<img src="http://lafuente.es/wp-content/uploads/2019/12/categorias_whisky.jpg" class="category-image" alt="SINGLE MALT">
	</a>
<?php

} else {
	    echo 'No banner.';
	}
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


	if ( is_shop() && ! is_product_category() ) {
		$woocommerce_loop['columns']        = $porto_settings['shop-product-cols'];
		$woocommerce_loop['columns_mobile'] = $porto_settings['shop-product-cols-mobile'];
	}
	?>

	<div class="archive-products">

		<?php
			$skeleton_lazyload = apply_filters( 'porto_skeleton_lazyload', ! empty( $porto_settings['show-skeleton-screen'] ) && in_array( 'shop', $porto_settings['show-skeleton-screen'] ) && ! porto_is_ajax(), 'archive-product' );
		if ( $skeleton_lazyload ) {
			global $porto_woocommerce_loop;
			if ( ! $porto_woocommerce_loop ) {
				$porto_woocommerce_loop = array();
			}
			if ( ! isset( $porto_woocommerce_loop['el_class'] ) || empty( $porto_woocommerce_loop['el_class'] ) ) {
				$porto_woocommerce_loop['el_class'] = 'skeleton-loading';
			} else {
				$porto_woocommerce_loop['el_class'] .= ' skeleton-loading';
			}
			$porto_settings['skeleton_lazyload'] = true;

			remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
		}
			woocommerce_product_loop_start();

		if ( $skeleton_lazyload ) {
			$porto_woocommerce_loop['el_class'] = str_replace( 'skeleton-loading', 'skeleton-body', $porto_woocommerce_loop['el_class'] );
			$skeleton_body_start                = woocommerce_product_loop_start( false );

			$sp_class = 'product product-col';
			if ( ( function_exists( 'wc_get_loop_prop' ) && ! wc_get_loop_prop( 'is_paginated' ) ) || isset( $porto_woocommerce_loop['view'] ) || ! isset( $_COOKIE['gridcookie'] ) || 'list' != $_COOKIE['gridcookie'] ) {
				if ( isset( $woocommerce_loop['addlinks_pos'] ) && 'quantity' == $woocommerce_loop['addlinks_pos'] ) {
					$sp_class .= ' product-wq_onimage';
				} elseif ( isset( $woocommerce_loop['addlinks_pos'] ) ) {
					if ( 'outimage_aq_onimage2' == $woocommerce_loop['addlinks_pos'] ) {
						$sp_class .= ' product-outimage_aq_onimage with-padding';
					} elseif ( 'onhover' == $woocommerce_loop['addlinks_pos'] ) {
						$sp_class .= ' product-default show-links-hover';
					} else {
						$sp_class .= ' product-' . $woocommerce_loop['addlinks_pos'];
					}
				}
			}

			ob_start();
			echo woocommerce_maybe_show_product_subcategories();
			$products_count = 0;
		}
		?>
		<?php
		if ( ! function_exists( 'wc_get_loop_prop' ) || wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );
				if ( $skeleton_lazyload ) {
					$products_count++;
				}
			}
		}
		if ( $skeleton_lazyload ) {
			$archive_content = ob_get_clean();
			echo '<script type="text/template">' . json_encode( $archive_content ) . '</script>';
		}
			woocommerce_product_loop_end();
		if ( $skeleton_lazyload ) {
			if ( $products_count < 1 ) {
				global $porto_products_cols_lg;
				$products_count = $porto_products_cols_lg;
			}
			echo porto_filter_output( $skeleton_body_start );
			for ( $i = 0; $i < $products_count; $i++ ) {
				echo '<li class="' . esc_attr( $sp_class ) . '"></li>';
			}
			woocommerce_product_loop_end();

			add_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
		}
		?>

	</div>

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
		do_action( 'woocommerce_no_products_found' );
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
?>
