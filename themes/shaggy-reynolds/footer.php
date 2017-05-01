<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package road_runner
 */

global $progressive; ?>

  <footer class="site-foot">
    <div class="valign  site-foot__content">
      <div class="container">
        <div class="row">
          <div class="col-sm-6" data-mh="footer">
            <div class="site-foot__copyright">
              <img src="<?php echo $progressive['footer-logo']['url']; ?>" alt="Enhance Dental Care of Lawrence">
              <p>Powered by <span class="site-foot__highlight">Progressive Dental Marketing</span> <br/> ©2017 Smile Solutions.</p>
            </div>
          </div>
          <div class="col-sm-6" data-mh="footer">
            <ul class="site-foot__list  list-inline">
            <?php if( $progressive['enable-facebook'] == 1 ) : ?>
              <li class="site-foot__item">
                <a href="<?php echo $progressive['facebook-link']; ?>" class="circle  circle--small  site-foot__social"  target="_blank"><i class="icon  icon--facebook"></i></a>
              </li>
            <?php endif; ?>
            <?php if( $progressive['enable-twitter'] == 1 ) : ?>
              <li class="site-foot__item">
                <a href="<?php echo $progressive['twitter-link']; ?>" class="circle  circle--small  site-foot__social"  target="_blank"><i class="icon  icon--twitter"></i></a>
              </li>
            <?php endif; ?>
            <?php if( $progressive['enable-youtube'] == 1 ) : ?>
              <li class="site-foot__item">
                <a href="<?php echo $progressive['youtube-link']; ?>" class="circle  circle--small  site-foot__social" target="_blank"><i class="icon  icon--youtube"></i></a>
              </li>
            <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="site-foot__google">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <p><a class="popform" href="https://www.google.com/search?sclient=psy-ab&rlz=1C1CHBF_enUS721US721&biw=1920&bih=950&q=gordon+wilson+dds+reviews&oq&gs_l&pbx=1&bav=on.2,or.&pf=p#q=gordon+wilson+dds&rflfq=1&rlha=0&rllag=34109951,-111896999,50896&tbm=lcl&rldimm=7326076954731817904&tbs=lrf:!2m1!1e2!3sEAE,lf:1,lf_ui:2">See Our Reviews on <i class="icon  icon--google"></i> Google</a></p>
          </div>
        </div>
      </div>
    </div>

  </footer>

<?php
/**
 * The template for displaying the footer
 */
  wp_footer(); ?>
  <script>
function init() {
var imgDefer = document.getElementsByTagName('img');
for (var i=0; i<imgDefer.length; i++) {
if(imgDefer[i].getAttribute('data-src')) {
imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
} } }
window.onload = init;
</script>


  <?php 
  if( $progressive['footer-scripts'] ) :
    echo $progressive['footer-scripts'];
  endif; 
  if( $progressive['footer-styles'] ) :
    echo $progressive['footer-styles'];
  endif;
  ?>

</body>
</html>
