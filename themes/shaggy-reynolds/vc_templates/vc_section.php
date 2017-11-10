<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = $masthead = $text_location = $bg_class = $pattern_style = $pattern_bg_color = $pattern_bg_value = $opacity_counter = $enable_pattern = '';
$disable_element = '';
$masthead_class = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

if( $bg_type == "pattern" ) {
	$bg_class = 'section--pattern-bg';
}
$css_classes = array(
	'section',
	$masthead_class,
	$bg_class,
	$padding,
	$text_location,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if( 'yes' == $enable_overlay ) {
	$css_classes[] = 'section--overlay';
}

$wrapper_attributes = array();

if( 'image' == $bg_type || 'video' == $bg_type || 'image_pattern' == $bg_type) {
	$css_classes[] = 'section--bg';
}

// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if( $section_tag != "no") {
	$output .= '<section ' . implode( ' ', $wrapper_attributes ) . '>';
} else {
	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
}

if( $bg_type == "image_pattern" || $bg_type == "pattern" ) {
	if( $pattern_bg_value ) {
		$pattern_style = 'style="background-color: ' . $pattern_bg_value . '";';
	}
	$output .= '<div class="section--pattern  ' . ( $pattern_bg_color != "custom" ? $pattern_bg_color : '' ) . '"' . ( $pattern_style != "" ? " " . $pattern_style : "" ) . '></div>';
}
if( 'image' == $bg_type || 'image_pattern' == $bg_type) {

	$inline_css = 'style="background-image: url(' . wp_get_attachment_url( $bg_image_new ) . '); ' . ( !empty( $opacity_counter ) ? 'opacity: ' . $opacity_counter : '') . '; ' . ( !empty( $background_image_location ) ? 'background-position: ' . $background_image_location : '') . ';"';
	$output .= '<div class="section__background" data-image="' . wp_get_attachment_url( $bg_image_new ) . '" ' . ( $inline_css ? $inline_css : '' ) . '></div>';
}

if( $bg_type == "video") :
$output .= '<div class="section__video-wrap"><video poster="" preload="auto" loop="" autoplay="" muted=""><source src="' . $video_url . '" type="video/mp4"></video></div>';
endif;
$output .= '<div class="' . ( $full_width == 'stretch_row' ? 'container-fluid' : 'container' ) . '">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
if( $section_tag != "no") {
	$output .= '</section>';
} else {
	$output .= '</div>';
}
$output .= $after_output;

echo $output;
