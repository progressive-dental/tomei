<?php

add_filter( 'template_include', 'progressive_page_template', 99 );

function progressive_page_template( $template ) {

  global $post;

  $type = get_post_type();

  $slug = isset( $post->post_name ) && ! empty( $post->post_name ) ? $post->post_name : '';

  if( is_archive() ) {
    $new_template = kelby_get_template( 'archive/archive', $type);

    if ( '' != $new_template ) {
      return $new_template ;
    }

  }

  if( is_single() ) {
    $new_template = kelby_get_template( 'single/single', $type);

    if ( '' != $new_template ) {
      return $new_template ;
    }
  }

  if( is_page() ) {
    $new_template = kelby_get_template( 'pages/page', $slug);

    if ( '' != $new_template ) {
      return $new_template ;
    }
  }

  if ( is_page( 'home' )  ) {
    $new_template = kelby_get_template( 'front-page' );

    if ( '' != $new_template ) {
      return $new_template ;
    }
  }

  if ( is_author()  ) {
    $new_template = kelby_get_template( 'author' );

    if ( '' != $new_template ) {
      return $new_template ;
    }
  }

  if ( is_404()  ) {
    $new_template = kelby_get_template( '404' );

    if ( '' != $new_template ) {
      return $new_template ;
    }
  }

  return $template;
}

function progressive_get_template( $template, $type = NULL ) {

  $template_dir = 'templates/';
  $file = ( $type ? $template . '-' . $type . '.php' : $template . '.php' );
  $new_template = locate_template( array( $template_dir . $file ) );

  return ( $new_template ? $new_template : false );

}