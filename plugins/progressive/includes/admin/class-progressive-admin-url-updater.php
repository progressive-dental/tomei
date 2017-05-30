<?php
/**
 * Progressive URL Updater
 *
 * Updates URLS when switching environments.
 *
 * @author      Progressive
 * @category    Admin
 * @package     Progressive/Admin/URL Updater
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Progressive_Url_Updater
 */
class Progressive_Url_Updater {

  const NONCE = 'progressive-url-updater';

  public $oldurl = false;

  public $newurl = false;

  /**
   * Constructor
   */
  public function __construct() {
    add_action( 'admin_menu', array( $this, 'url_updater_admin_menu' ) );

    if( !empty( $_POST[ 'progressive-url-submit' ] ) ) {
      add_action( 'init', array( $this, 'maybe_update_url' ) );
    }
  }

  public function url_updater_admin_menu() {
    add_management_page( 'URL Updater', 'URL Updater', 'manage_options', 'progressive-url-updater', array( $this, 'url_updater_admin_page' ) );
  }

  public function url_updater_admin_page() {
    require( PROGRESSIVE_VIEWS_DIR . 'html-admin-page-url-updater.php' );
  }

  public function maybe_update_url() {
    if( !wp_verify_nonce( $_POST[ self::NONCE ], self::NONCE ) ){
      wp_die( __('Ouch! That hurt! You should not be here!', 'progressive' ) );
    }

    $this->oldurl = trim( strip_tags( $_POST[ 'oldurl' ] ) );
    $this->newurl = trim( strip_tags( $_POST[ 'newurl' ] ) );

    if( $this->update_urls() ){
      add_action( 'admin_notices', array( $this, 'url_updater_success' ) );
    } else {
      add_action( 'admin_notices', array( $this, 'url_updater_fail' ) );
    }
  }

  public function url_updater_success() {
    $message = apply_filters( 'progressive-url-updater-success-message', __( 'The URLS have been updated.', 'progressive' ) );
    ?>
    <div id="message" class="updated fade">
      <p>
        <strong>
          <?php echo $message; ?>
        </strong>
      </p>
    </div>
    <?php
  }

  public function url_updater_fail() {
    ?>
    <div id="message" class="error fade">
      <p>
        <strong><?php _e( 'You must fill out both boxes to make the update!.', 'progressive' ); ?></strong>
      </p>
    </div>
    <?php
  }

  public function update_urls() {
    global $wpdb;

    if( empty( $this->oldurl ) || empty( $this->newurl ) ) {
      return false;
    }

    $redux = get_option( 'progressive' );

    if( $redux !== false ) {
      foreach( $redux as $key => $value ) {
        $redux[$key] = str_replace( urlencode( $this->oldurl ), urlencode( $this->newurl ), $value );
        $redux[$key] = str_replace( $this->oldurl, $this->newurl, $value );
      }
      
      update_option( 'progressive', $redux );
    }

    $query = "SELECT ID,post_content FROM `wp_posts` WHERE `post_type` = 'page';";

    foreach( $wpdb->get_results( $query ) as $key => $row) {
      $row->post_content = str_replace( urlencode( $this->oldurl ), urlencode( $this->newurl ), $row->post_content );
      $row->post_content = str_replace( $this->oldurl, $this->newurl, $row->post_content );

      $new_post = array(
        'ID' => $row->ID,
        'post_content' => $row->post_content
      );
      wp_update_post( $new_post );
    }

    wp_cache_flush();

    return true;

  }
  function makeTheUpdates(){
        global $wpdb;

      if( empty( $this->oldurl ) || empty( $this->newurl ) ){
        return false;
      }

        @set_time_limit( 0 );
        @ini_set( 'memory_limit', '256M' );
        @ini_set( 'max_input_time', '-1' );

        $updaters = (array)Go_Live_Update_Urls_Container::get_instance()->get_updaters()->get_updaters();

        // If the new domain is the old one with a new sub-domain like www
        if( strpos( $this->newurl, $this->oldurl ) !== false ){
            list( $subdomain ) = explode( '.', $this->newurl );
            $this->double_subdomain = $subdomain . '.' . $this->newurl;
        }

        $serialized_tables = $this->getSerializedTables();

        //Go through each table sent to be updated
        foreach( array_keys( $this->tables ) as $table ){
          //backward compatibility with pro
          if( $table == 'submit' && $table == 'oldurl' && $table == 'newurl' ){
            continue;
          }

            if( in_array( $table, array_keys( $serialized_tables ) ) ){
                if( is_array( $serialized_tables[ $table ] ) ){
                    foreach( $serialized_tables[ $table ] as $column ){
                        $this->UpdateSeralizedTable( $table, $column );
                    }
                } else {
                    $this->UpdateSeralizedTable( $table, $serialized_tables[ $table ] );
                }
            }

          $column_query = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='" . $wpdb->dbname . "' AND TABLE_NAME='" . $table . "'";
          $columns      = $wpdb->get_col( $column_query );

          foreach( $columns as $_column ){
            $update_query = "UPDATE " . $table . " SET " . $_column . " = replace(" . $_column . ", %s, %s)";
            $wpdb->query( $wpdb->prepare( $update_query, array( $this->oldurl, $this->newurl ) ) );



            //Run each updater
                //@todo convert all the steps to their own updater class
            foreach( $updaters as $_updater_class ){
                if( class_exists( $_updater_class ) ){
                  /** @var \Go_Live_Update_Urls\Updaters\_Updater $_updater */
                  $_updater = new $_updater_class( $table, $_column, $this->oldurl, $this->newurl );
                  $_updater->update_data();
                  //run each updater through double sub-domain if applicable
                  if( $this->double_subdomain ){
                    $_updater = new $_updater_class( $table, $_column, $this->double_subdomain, $this->newurl );
                    $_updater->update_data();
                  }
                }
            }


            //Fix the dub dubs if this was the old domain with a new sub
            if( $this->double_subdomain ){
              $wpdb->query( $wpdb->prepare( $update_query, array(
                $this->double_subdomain,
                $this->newurl,
              ) ) );
              //Fix the emails breaking by being appended the new subdomain
              $wpdb->query( $wpdb->prepare( $update_query, array(
                "@" . $this->newurl,
                "@" . $this->oldurl,
              ) ) );
            }
          }

        }

        wp_cache_flush();

        return true;
    }

}

new Progressive_Url_Updater();