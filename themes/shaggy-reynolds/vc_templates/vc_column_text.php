<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $css = $css_animation = $align_text ='';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$output = '
	<div class="' . esc_attr( ltrim( $this->getExtraClass( $el_class ) ) ) . ' ' . ( $css_animation != '' ?  $css_animation : '' ) . ' ' . ( $align_text != '' ?  $align_text : '' ) . '">
			' . wpb_js_remove_wpautop( $content, true ) . '
	</div>
';
echo $output;
