<?php
/**
 * Post Types
 *
 * Registers post types and taxonomies
 *
 * @class       Progressive_Post_types
 * @version     1.0.0
 * @package     Progressive/Classes/ProgressivePostTypes
 * @category    Class
 * @author      WooThemes
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
/**
 * Progressive_Post_types Class
 */
class Progressive_Post_types {

  public function __construct() {
    $this->init();
  }

  /**
   * Hook in methods.
   */
  public function init() {
    //add_action( 'init', array( $this, 'register_post_types' ), 5 );
    //add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ), 5 );
    //add_filter( 'rest_api_allowed_post_types', array( __CLASS__, 'rest_api_allowed_post_types' ) );
    //add_action( 'save_post', array( $this , 'save_meta_boxes' ), 1, 2 );
  }

  /**
   * Register core post types.
   */
  public function register_post_types() {
    if( post_type_exists( 'location' ) ) {
      return;
    }

    do_action( 'progressive_register_post_type' );

    register_post_type( 'location', 
      apply_filters( 'progressive_register_post_type_location', 
        array(
          'labels' => array(
            'name'                  => __( 'Locations', 'progressive' ),
            'singular_name'         => __( 'Location', 'progressive' ),
            'menu_name'             => _x( 'Locations', 'Admin menu name', 'progressive' ),
            'add_new'               => __( 'Add Location', 'progressive' ),
            'add_new_item'          => __( 'Add New Location', 'progressive' ),
            'edit'                  => __( 'Edit', 'progressive' ),
            'edit_item'             => __( 'Edit Location', 'progressive' ),
            'new_item'              => __( 'New Location', 'progressive' ),
            'view'                  => __( 'View Location', 'progressive' ),
            'view_item'             => __( 'View Location', 'progressive' ),
            'search_items'          => __( 'Search Locations', 'progressive' ),
            'not_found'             => __( 'No Locations found', 'progressive' ),
            'not_found_in_trash'    => __( 'No Locations found in trash', 'progressive' ),
            'parent'                => __( 'Parent Location', 'progressive' ),
            'featured_image'        => __( 'Location Image', 'progressive' ),
            'set_featured_image'    => __( 'Set location image', 'progressive' ),
            'remove_featured_image' => __( 'Remove location image', 'progressive' ),
            'use_featured_image'    => __( 'Use as location image', 'progressive' ),
          ), // end labels array

          'description'         => __( 'This is where you can add new locations for your site.', 'progressive' ),
          'public'              => true,
          'has_archive'         => true,
          'show_ui'             => true,
          'capability_type'     => 'page',
          'map_meta_cap'        => true,
          'publicly_queryable'  => false,
          'exclude_from_search' => true,
          'hierarchical'        => false,
          'rewrite' => array( 'slug' => 'location','with_front' => FALSE),
          'query_var'           => true,
          'supports'            => array( 'title' ),
          'show_in_nav_menus'   => false,
        )
      ) // end apply_filters
    ); // end register_post_type
  } // end register core post types

  public function register_meta_boxes() {

  } // end register meta boxes

  public function save_meta_boxes() {

  } // end save meta boxes
}