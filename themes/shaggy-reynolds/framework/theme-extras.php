<?php
add_filter( 'wpcf7_form_elements', 'progressive_wpcf7_form_elements' );

function progressive_wpcf7_form_elements( $content ) {
  $content = strip_tags( $content, '<input><textarea><button><label><div><i><small>');
  $content = str_replace('aria-required="true"', 'aria-required="true" required', $content );
  return $content;  
}