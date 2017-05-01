<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'Progressive' ) ) {
  class Progressive {

    /**
     * The single instance of Progressive.
     * @var   object
     * @access  private
     * @since   1.0.0
     */
    private static $_instance = null;
    /**
     * The version number.
     * @var     string
     * @access  private
     * @since   1.0.0
     */
    private $_version;
    /**
     * The token.
     * @var     string
     * @access  private
     * @since   1.0.0
     */
    private $_token;
    /**
     * The main plugin file.
     * @var     string
     * @access  private
     * @since   1.0.0
     */
    private $file;
    /**
     * The main plugin directory.
     * @var     string
     * @access  private
     * @since   1.0.0
     */
    private $dir;
    /**
     * The plugin assets directory.
     * @var     string
     * @access  private
     * @since   1.0.0
     */
    private $assets_dir;
    /**
     * The plugin assets URL.
     * @var     string
     * @access  private
     * @since   1.0.0
     */
    private $assets_url;
    /**
     * Suffix for Javascripts.
     * @var     string
     * @access  private
     * @since   1.0.0
     */
    private $script_suffix;
    /**
     * Constructor function.
     * @access  public
     * @since   1.0.0
     * @return  void
     */

    public function __construct( $file, $version = '1.0.0' ) {
      $this->_version = $version;
      $this->_token = 'progressive';

      $this->file = $file;
      $this->dir = dirname( $this->file );
      $this->assets_dir = trailingslashit( $this->dir ) . 'assets';
      $this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', __FILE__ ) ) );

      // Load styles
      //add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );

      // Handle localisation
      $this->load_plugin_textdomain();

      // Plugin includes
      $this->get_includes();
    }

    /**
     * Include files
     */
    public function get_includes() {
      include_once( 'class-progessive-post-types.php' );
      include_once( 'admin/class-progressive-admin-assets.php' );
      include_once( 'admin/class-progressive-admin-meta-boxes.php' );
      include_once( 'progressive-template-hooks.php' );
      include_once( 'progressive-template-functions.php' );
    }

    /**
     * Load plugin textdomain.
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function load_plugin_textdomain() {
      $domain = 'progressive';

      $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

      load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '-' . $locale . '.mo' );
      load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( $this->file ) ) . '/lang/' );
    } // End load_plugin_textdomain()

    /**
     * Main Progressive Instance
     *
     * Ensures only one instance of Progressive is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see Progressive()
     * @return Main Progressive instance
     */
    public static function instance( $file, $version = '1.0.0' ) {
      if ( is_null( self::$_instance ) )
        self::$_instance = new self( $file, $version );
      return self::$_instance;
    } // End instance()

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone() {
      _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
    } // End __clone()

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup() {
      _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
    } // End __wakeup()
  }
}