<?php
class Wpse8170_Menu_Walker extends Walker_Nav_Menu {

  var $number = 1;

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $hasDropdown = false;
    if( !empty($item->classes) && is_array($item->classes) && in_array('menu-item-has-children', $item->classes) ) {
      $hasDropdown = true;
    }
    $icon = get_post_meta($item->ID, 'menu-item-icon', true);
    $button = get_post_meta($item->ID, 'menu-item-make_button', true);

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    if($hasDropdown) {
      $classes[] .= ' has-dropdown';
    }
    if( $button == "yes" ) {
      $classes[] .= ' site-nav__item--btn';
    } 

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="site-nav__item  ' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

        // add span with number here

    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
    $atts['class'] = 'site-nav__link';
    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

    if( $button == "yes" ) {
      $atts['class'] .= ' site-nav__link--btn';
    }

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
      if ( ! empty( $value ) ) {
        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }
    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    if($icon) {
      $item_output .= '<i class="icon  icon--' . $icon . '"></i>';
      $item_output .= '<span>';
    }
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    if($icon) {
      $item_output .= '</span>';
    }
    if($hasDropdown) {
      $item_output .= ' <span class="icon  icon--caret-down"></span>';
    }
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = str_repeat( $t, $depth );
    $output .= "{$n}{$indent}<ul class=\"site-nav__sub-menu\">{$n}";
  }

}