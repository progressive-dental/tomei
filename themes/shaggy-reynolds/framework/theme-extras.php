<?php
add_filter( 'wpcf7_form_elements', 'progressive_wpcf7_form_elements' );

function progressive_wpcf7_form_elements( $content ) {
  $content = strip_tags( $content, '<input><textarea><button><label><div><i><small><script><noscript><select><option>');
  $content = str_replace('aria-required="true"', 'aria-required="true" required', $content );
  $content = str_replace('wpcf7-form-control wpcf7-submit', 'wpcf7-form-control wpcf7-submit btn btn--default btn--accent contact__btn', $content );
  $content = str_replace('rows="10"', 'rows="5"', $content );
  return $content;
}

function localize_us_number($phone) {
  $numbers_only = preg_replace("/[^\d]/", "", $phone);
  return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
}

add_filter('body_class','mobile_body_classes');
function mobile_body_classes($c) {

  if( wp_is_mobile() ) {
    $c[] = 'mobile';
  }

  return $c;
}
