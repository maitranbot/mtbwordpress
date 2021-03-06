<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$edgtf_sidebar_layout  = galatia_edge_sidebar_layout();
$edgtf_grid_space_meta = galatia_edge_options()->getOptionValue( 'woo_list_grid_space' );
$edgtf_holder_classes  = ! empty( $edgtf_grid_space_meta ) ? 'edgtf-grid-' . $edgtf_grid_space_meta . '-gutter' : '';

get_header();
galatia_edge_get_title();
get_template_part( 'slider' );
do_action('galatia_edge_action_before_main_content');

//Woocommerce content
if ( ! is_singular( 'product' ) ) { ?>
	<div class="edgtf-container">
		<div class="edgtf-container-inner clearfix">
			<div class="edgtf-grid-row <?php echo esc_attr( $edgtf_holder_classes ); ?>">
				<div <?php echo galatia_edge_get_content_sidebar_class(); ?>>
					<?php galatia_edge_woocommerce_content(); ?>
				</div>
				<?php if ( $edgtf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo galatia_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="edgtf-container">
		<div class="edgtf-container-inner clearfix">
			<?php galatia_edge_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>