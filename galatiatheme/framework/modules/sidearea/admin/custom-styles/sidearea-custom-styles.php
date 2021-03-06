<?php

if ( ! function_exists( 'galatia_edge_side_area_slide_from_right_type_style' ) ) {
	function galatia_edge_side_area_slide_from_right_type_style() {
		
		if ( galatia_edge_options()->getOptionValue( 'side_area_type' ) == 'side-menu-slide-from-right' ) {
			
			if ( galatia_edge_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo galatia_edge_dynamic_css( '.edgtf-side-menu-slide-from-right .edgtf-side-menu', array(
					'right' => '-' . galatia_edge_options()->getOptionValue( 'side_area_width' ),
					'width' => galatia_edge_options()->getOptionValue( 'side_area_width' )
				) );
			}
			
			if ( galatia_edge_options()->getOptionValue( 'side_area_content_overlay_color' ) !== '' ) {
				
				echo galatia_edge_dynamic_css( '.edgtf-side-menu-slide-from-right .edgtf-wrapper .edgtf-cover', array(
					'background-color' => galatia_edge_options()->getOptionValue( 'side_area_content_overlay_color' )
				) );
			}
			
			if ( galatia_edge_options()->getOptionValue( 'side_area_content_overlay_opacity' ) !== '' ) {
				
				echo galatia_edge_dynamic_css( '.edgtf-side-menu-slide-from-right.edgtf-right-side-menu-opened .edgtf-wrapper .edgtf-cover', array(
					'opacity' => galatia_edge_options()->getOptionValue( 'side_area_content_overlay_opacity' )
				) );
			}
		}
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_side_area_slide_from_right_type_style' );
}

if ( ! function_exists( 'galatia_edge_side_area_slide_with_content_type_style' ) ) {
	function galatia_edge_side_area_slide_with_content_type_style() {
		
		if ( galatia_edge_options()->getOptionValue( 'side_area_type' ) == 'side-menu-slide-with-content' ) {
			
			if ( galatia_edge_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo galatia_edge_dynamic_css( '.edgtf-side-menu-slide-with-content .edgtf-side-menu', array(
					'right' => '-' . galatia_edge_options()->getOptionValue( 'side_area_width' ),
					'width' => galatia_edge_options()->getOptionValue( 'side_area_width' )
				) );
				
				$side_menu_open_classes = array(
					'.edgtf-side-menu-slide-with-content.edgtf-side-menu-open .edgtf-wrapper',
					'.edgtf-side-menu-slide-with-content.edgtf-side-menu-open footer.uncover',
					'.edgtf-side-menu-slide-with-content.edgtf-side-menu-open .edgtf-sticky-header',
					'.edgtf-side-menu-slide-with-content.edgtf-side-menu-open .edgtf-fixed-wrapper',
					'.edgtf-side-menu-slide-with-content.edgtf-side-menu-open .edgtf-mobile-header-inner',
				);
				
				echo galatia_edge_dynamic_css( $side_menu_open_classes, array(
					'left' => '-' . galatia_edge_options()->getOptionValue( 'side_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_side_area_slide_with_content_type_style' );
}

if ( ! function_exists( 'galatia_edge_side_area_uncovered_from_content_type_style' ) ) {
	function galatia_edge_side_area_uncovered_from_content_type_style() {
		
		if ( galatia_edge_options()->getOptionValue( 'side_area_type' ) == 'side-area-uncovered-from-content' ) {
			
			if ( galatia_edge_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo galatia_edge_dynamic_css( '.edgtf-side-area-uncovered-from-content .edgtf-side-menu', array(
					'width' => galatia_edge_options()->getOptionValue( 'side_area_width' )
				) );
				
				$side_menu_open_classes = array(
					'.edgtf-side-area-uncovered-from-content.edgtf-right-side-menu-opened .edgtf-wrapper',
					'.edgtf-side-area-uncovered-from-content.edgtf-right-side-menu-opened footer.uncover',
					'.edgtf-side-area-uncovered-from-content.edgtf-right-side-menu-opened .edgtf-sticky-header',
					'.edgtf-side-area-uncovered-from-content.edgtf-right-side-menu-opened .edgtf-fixed-wrapper.fixed',
					'.edgtf-side-area-uncovered-from-content.edgtf-right-side-menu-opened .edgtf-mobile-header-inner',
					'.edgtf-side-area-uncovered-from-content.edgtf-right-side-menu-opened .mobile-header-appear .edgtf-mobile-header-inner',
				);
				
				echo galatia_edge_dynamic_css( $side_menu_open_classes, array(
					'left' => '-' . galatia_edge_options()->getOptionValue( 'side_area_width' ),
				) );
			}
		}
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_side_area_uncovered_from_content_type_style' );
}

if ( ! function_exists( 'galatia_edge_side_area_icon_color_styles' ) ) {
	function galatia_edge_side_area_icon_color_styles() {
		$icon_color             = galatia_edge_options()->getOptionValue( 'side_area_icon_color' );
		$icon_hover_color       = galatia_edge_options()->getOptionValue( 'side_area_icon_hover_color' );
		$close_icon_color       = galatia_edge_options()->getOptionValue( 'side_area_close_icon_color' );
		$close_icon_hover_color = galatia_edge_options()->getOptionValue( 'side_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.edgtf-side-menu-button-opener:hover',
			'.edgtf-side-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo galatia_edge_dynamic_css( '.edgtf-side-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo galatia_edge_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo galatia_edge_dynamic_css( '.edgtf-side-menu a.edgtf-close-side-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo galatia_edge_dynamic_css( '.edgtf-side-menu a.edgtf-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_side_area_icon_color_styles' );
}

if ( ! function_exists( 'galatia_edge_side_area_styles' ) ) {
	function galatia_edge_side_area_styles() {
		$side_area_styles = array();
		$background_color = galatia_edge_options()->getOptionValue( 'side_area_background_color' );
		$padding          = galatia_edge_options()->getOptionValue( 'side_area_padding' );
		$text_alignment   = galatia_edge_options()->getOptionValue( 'side_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$side_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$side_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$side_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $side_area_styles ) ) {
			echo galatia_edge_dynamic_css( '.edgtf-side-menu', $side_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo galatia_edge_dynamic_css( '.edgtf-side-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'galatia_edge_action_style_dynamic', 'galatia_edge_side_area_styles' );
}