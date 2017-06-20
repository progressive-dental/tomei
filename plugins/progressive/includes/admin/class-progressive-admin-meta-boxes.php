<?php
/**
 * Progressive Meta Boxes
 *
 * Sets up the write panels used by pages and custom post types
 *
 * @author      Progressive
 * @category    Admin
 * @package     Progressive/Admin/Meta Boxes
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Progressive_Meta_Boxes
 */
class Progressive_Meta_Boxes {

  private static $saved_meta_boxes = false;
  public static $meta_box_errors = array();

  /**
   * Constructor
   */
  public function __construct() {
    //add_action( 'add_meta_boxes', array( $this, 'pd_add_meta_boxes' ), 1 );
    //add_action( 'save_post', array( $this, 'pd_save_meta_boxes' ), 1, 2 );
    //add_action( 'edit_form_before_permalink', array( $this, 'pd_move_meta_boxes' ) );
  }

  /**
   * Add WC Meta boxes
   */
  public function pd_add_meta_boxes() {
    // Products
    add_meta_box( 'progressive_seo_box', __( 'Seo Fields', 'progressive' ), array( $this, 'pd_meta_box_output' ), 'page', 'advanced', 'high' );
  }

  public function pd_meta_box_output( $post ) {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['seo-page-title'] ) ? esc_attr( $values['seo-page-title'][0] ) : '';
    wp_nonce_field( 'progressive_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <div class="titlewrap">
        <label for="seo-page-title">H1 Page Title</label>
        <input type="text" name="seo-page-title" id="seo-page-title" value="<?php echo $text; ?>" />
      </p>
    </div>
    <?php
  }

  public function pd_save_meta_boxes( $post_id ) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Verify nonce
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'progressive_meta_box_nonce' ) ) return;

    // Check user permissions
    if( !current_user_can( 'edit_post', $post_id ) ) return;

    if( isset( $_POST['seo-page-title'] ) )
      update_post_meta( $post_id, 'seo-page-title', $_POST['seo-page-title'] );
  }

  public function pd_move_meta_boxes() {
    global $post, $wp_meta_boxes;
    do_meta_boxes( get_current_screen(), 'advanced', $post );
    unset( $wp_meta_boxes[get_post_type( $post )]['advanced'] );
  }
}

new Progressive_Meta_Boxes();