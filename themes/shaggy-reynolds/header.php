<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shaggy_reynolds
 */

global $progressive

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel='preconnect' href='//www.google-analytics.com' />
  <link rel='preconnect' href='//fonts.googleapis.com' />
  <?php if( !empty( $progressive['theme-color'] ) ) : ?>
  <meta content="<?php echo $progressive['theme-color']; ?>" name="theme-color">
  <meta content="<?php echo $progressive['theme-color']; ?>" name="msapplication-TileColor">
  <?php endif; ?>
  <?php if( !empty( $progressive['favicon']['url'] ) ) : ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $progressive['favicon']['url']; ?>">
  <?php endif; ?>
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php wp_head(); ?>

  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php
  if( $progressive['header-scripts'] ) :
    echo $progressive['header-scripts'];
  endif;
  if( $progressive['header-styles'] ) :
    echo $progressive['header-styles'];
  endif;
  ?>

  <script src="https://use.fontawesome.com/19a16e8b22.js"></script>
</head>
<body <?php body_class(); ?>>
  <div id="page">
    <header class="page-head  Fixed">
      <div class="container">
        <div class="page-head__logo">
          <a href="<?php echo esc_url( home_url() ); ?>" class="logo  logo--header  logo--<?php echo $progressive['nav-logo-location']; ?>">
            <img src="<?php echo $progressive['nav-logo']['url']; ?>" alt="<?php echo get_bloginfo('name'); ?>">
          </a>
        </div>
        <div class="page-head__nav">
          <ul class="site-nav__contact">
            <li class="site-nav__item">
              <?php if( $progressive['enable-ppc'] == 1 ) : ?>
                <a href="tel:+1-<?php echo localize_us_number( $progressive['new-patient-number'] ); ?>" class="site-nav__link  clickToCall" data-call-tracking-number="<?php echo $progressive['new-patient-number']; ?>" data-ppc-tracking-number="<?php echo $progressive['ppc-number']; ?>"><span class="webPpcNumber"><?php echo $progressive['ppc-number']; ?></span></a>
              <?php else : ?>
                <a href="tel:+1-<?php echo localize_us_number( $progressive['new-patient-number'] ); ?>" class="site-nav__link" ><?php echo $progressive['new-patient-number']; ?></a>
              <?php endif; ?>
            </li>
            <li class="site-nav__item">
              <a href="<?php echo get_permalink( $progressive['header-contact-us-link'] ); ?>" class="site-nav__link">CONTACT US</a>
            </li>
          </ul>
          <?php if( has_nav_menu( 'contact-menu' ) ) : ?>
          <ul class="site-nav">
            <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'items_wrap' => '%3$s', 'container' => false, 'menu_class' => false, 'walker' => new Wpse8170_Menu_Walker() ) ); ?>
          </ul>
          <a href="#menu" class="site-nav__open">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </header>
