<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shaggy_reynolds
 */

global $progressive; ?>

    <footer class="site-foot">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="site-foot__column">
              <a href="<?php echo esc_url( home_url() ); ?>" class="site-foot__header"><img src="<?php echo $progressive['footer-logo']['url']; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
              <ul class="contact-list">
                <?php if( $progressive['enable-current-patient-number'] == 1 ) : ?>
                <li class="contact-list__item">
                  Current Patient: <a class="site-foot__link  site-foot__link--phone" href="tel:+1<?php echo preg_replace( "/[^0-9]/", "", $progressive['current-patient-number'] ); ?>"><?php echo $progressive['current-patient-number']; ?></a>
                </li>
                <?php endif; ?>
                <?php if( $progressive['enable-new-patient-number'] == 1 ) : ?>
                <li class="contact-list__item">
                  <?php if( $progressive['enable-ppc'] == 1 ) : ?>
                    New Patient: <a href="+1<?php echo preg_replace("/[^0-9]/","", $progressive['new-patient-number'] ); ?>" class="site-foot__link  site-foot__link--phone  clickToCall" data-call-tracking-number="<?php echo $progressive['new-patient-number']; ?>" data-ppc-tracking-number="<?php echo $progressive['ppc-number']; ?>"><span class="webPpcNumber"><?php echo $progressive['ppc-number']; ?></span></a>
                  <?php else : ?>
                    New Patient: <a class="site-foot__link  site-foot__link--phone" href="tel:+1<?php echo preg_replace( "/[^0-9]/", "", $progressive['new-patient-number'] ); ?>"><?php echo $progressive['new-patient-number']; ?></a>
                  <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php if( $progressive['enable-practice-address'] == 1 ) : ?>
                <li class="contact-list__item">
                  <address><?php echo $progressive['address-line-one']; ?><?php echo ( !empty( $progressive['address-line-two'] ) ? ', ' . $progressive['address-line-two'] : '' ); ?><br> <?php echo $progressive['address-city']; ?>, <?php echo $progressive['address-state']; ?> <?php echo $progressive['address-zip']; ?></address>
                </li>
                <?php endif; ?>
                <?php if( $progressive['enable-youtube'] == 1 || $progressive['enable-google-plus'] == 1 || $progressive['enable-twitter'] == 1 || $progressive['enable-facebook'] == 1 ) : ?>
                <li class="contact-list__item">
                  <ul class="social-list">
                    <?php if( $progressive['enable-facebook'] == 1 ) : ?>
                    <li class="social-list__item"><a href="<?php echo $progressive['facebook-link']; ?>" class="site-foot__link" target="_blank"><i class="icon  icon--facebook"></i></a></li>
                    <?php endif; ?>
                    <?php if( $progressive['enable-google-plus'] == 1 ) : ?>
                    <li class="social-list__item"><a href="<?php echo $progressive['google-plus-link']; ?>" class="site-foot__link" target="_blank"><i class="icon  icon--google-plus"></i></a></li>
                    <?php endif; ?>
                    <?php if( $progressive['enable-twitter'] == 1 ) : ?>
                    <li class="social-list__item"><a href="<?php echo $progressive['twitter-link']; ?>" class="site-foot__link" target="_blank"><i class="icon  icon--twitter"></i></a></li>
                    <?php endif; ?>
                    <?php if( $progressive['enable-youtube'] == 1 ) : ?>
                    <li class="social-list__item"><a href="<?php echo $progressive['youtube-link']; ?>" class="site-foot__link" target="_blank"><i class="icon  icon--youtube"></i></a></li>
                    <?php endif; ?>
                  </ul>
                </li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="site-foot__column  site-foot__column--center">
              <span class="site-foot__header">Our Dentistry</span>
              <?php 
                wp_nav_menu(
                  array(
                    'theme_location' => 'footer-menu-1',
                    'container' => false,
                    'menu_class' => 'site-foot__list',
                    'fallback_cb' => 'default_header_nav',
                  )
                ); 
                wp_nav_menu(
                  array(
                    'theme_location' => 'footer-menu-2',
                    'container' => false,
                    'menu_class' => 'site-foot__list',
                    'fallback_cb' => 'default_header_nav',
                  )
                ); 
                wp_nav_menu(
                  array(
                    'theme_location' => 'footer-menu-3',
                    'container' => false,
                    'menu_class' => 'site-foot__list',
                    'fallback_cb' => 'default_header_nav',
                  )
                ); 
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="site-foot__column  site-foot__column--right">
              <span class="site-foot__header">Get In Touch</span>
              <a href="<?php echo get_permalink( $progressive['contact-us-link'] ); ?>" class="btn  btn--accent  btn--small">CONTACT US</a>
            </div>
          </div>
        </div>  
      </div>
      <?php if( $progressive['enable-google-reviews'] == 1 ) : ?>
      <div class="site-foot__reviews">
        <div class="section--pattern"></div>
        <a href="<?php echo $progressive['google-reviews-link']; ?>" target="_blank">See Our Reviews on Google</a>
      </div>
    <?php endif; ?>
    </footer>
  </div>
  <nav id="menu" data-call-tracking-number="<?php echo $progressive['new-patient-number']; ?>">

  </nav>
  <?php
  /**
   * The template for displaying the footer
   */
  wp_footer(); 

  if( $progressive['footer-scripts'] ) :
    echo $progressive['footer-scripts'];
  endif; 
  if( $progressive['footer-styles'] ) :
    echo $progressive['footer-styles'];
  endif;

  ?>
  <script>
    function init() {
      var imgDefer = document.getElementsByTagName('img');
      for (var i=0; i<imgDefer.length; i++) {
        if(imgDefer[i].getAttribute('data-src')) {
          imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
          imgDefer[i].onload = function() {
            if($(this).parents('.vc_row-o-equal-height').length) {
              $('.vc_row-o-equal-height > div').matchHeight();
            }
          };
        } 
      } 
    }
    window.onload = init;
    
  </script>
 
</body>
</html>