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
$el_class = $css = $css_animation = $font_size = $align_text ='';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
  $output = '';
  $strong_pattern = "/(<strong)/";

  if( !empty( $font_size || !empty( $align_text ) ) ) {
    $classes = array(
      $font_size,
      $align_text
    );
    $classes = implode( "  ", array_filter( $classes ) );
    $pattern = "/(<p)/";
    $replace = '<p class="' . $classes . '"';
    if( !empty( $strong_tag_color ) ) {
      $strong_replace = '<strong class="' . $strong_tag_color . '"';
      $output .= preg_replace( $strong_pattern, $strong_replace, preg_replace( $pattern, $replace, wpb_js_remove_wpautop ( $content, true ) ) );
    } else {
      $output .= preg_replace( $pattern, $replace, wpb_js_remove_wpautop ( $content, true ) );
    }
  } else {
    if( !empty( $strong_tag_color ) ) {
      $strong_replace = '<strong class="' . $strong_tag_color . '"';
      $output .= preg_replace( $strong_pattern, $strong_replace, wpb_js_remove_wpautop( $content, true ) );
    } else {
      $output .= wpb_js_remove_wpautop( $content, true );
    }
  }
echo $output;
