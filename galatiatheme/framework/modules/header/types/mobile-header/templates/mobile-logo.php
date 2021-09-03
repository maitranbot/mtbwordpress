<?php
$attachment_meta = galatia_edge_get_attachment_meta_from_url( $logo_image );
$hwstring        = ! empty( $attachment_meta ) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

do_action( 'galatia_edge_action_before_mobile_logo' ); ?>

<div class="edgtf-mobile-logo-wrapper">
	<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php galatia_edge_inline_style( $logo_styles ); ?>>
		<img itemprop="image" src="<?php echo esc_url( $logo_image ); ?>" <?php echo wp_kses( $hwstring, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'Mobile Logo', 'galatia' ); ?>"/>
	</a>
</div>

<?php do_action( 'galatia_edge_action_after_mobile_logo' ); ?>