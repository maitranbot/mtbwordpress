<?php

if ( ! function_exists( 'galatia_edge_get_hide_dep_for_breadcrumbs_title_meta_boxes' ) ) {
	function galatia_edge_get_hide_dep_for_breadcrumbs_title_meta_boxes() {
		$hide_dep_options = apply_filters( 'galatia_edge_filter_breadcrumbs_title_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'galatia_edge_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function galatia_edge_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
	    $hide_dep_options = galatia_edge_get_hide_dep_for_breadcrumbs_title_meta_boxes();
		
		galatia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'galatia' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'galatia' ),
				'parent'      => $show_title_area_meta_container,
                'dependency'  => array(
                    'hide' => array(
                        'edgtf_title_area_type_meta' => $hide_dep_options
                    )
                )
			)
		);
	}
	
	add_action( 'galatia_edge_action_additional_title_area_meta_boxes', 'galatia_edge_breadcrumbs_title_type_options_meta_boxes' );
}