<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package road_runner
 */

global $progressive, $post;
$seo_page_title = get_post_meta( $post->ID, 'seo-page-title', true );

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel='preconnect' href='//www.google-analytics.com' />
  <link rel='preconnect' href='//fonts.googleapis.com' />
  <?php if( $progressive['theme-color'] ) : ?>
  <meta content="<?php echo $progressive['theme-color']; ?>" name="theme-color">
  <meta content="<?php echo $progressive['theme-color']; ?>" name="msapplication-TileColor">
  <?php endif; ?>
  <?php if( $progressive['favicon'] ) : ?>
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
</head>

<body <?php body_class(); ?>>

  <header class="page-head  is-fixed">
    <div class="page-head__subhead  page-subhead  valign">
      <div class="container">
        <h1 class="page-subhead__title"><?php if( $seo_page_title ) echo $seo_page_title; ?></h1>
        <span class="page-subhead__right">
          <?php 
          if( $progressive['enable-current-patient-number'] == 1 ) :
            echo $progressive['top-current-patient-text']; ?> <a href="tel:<?php echo preg_replace( "/[^0-9]/", "", $progressive['top-current-patient-number'] ); ?>" class="page-subhead__link"><?php echo $progressive['top-current-patient-number']; ?></a>
          <?php
          endif;
          if( $progressive['enable-new-patient-number'] == 1 ) :
            echo $progressive['top-new-patient-text']; ?> <a href="tel:<?php echo preg_replace( "/[^0-9]/", "", $progressive['top-new-patient-number'] ); ?>" class="page-subhead__link"><?php echo $progressive['top-new-patient-number']; ?></a>
          <?php
          endif;
          ?>
        </span>
      </div>
    </div>
    <div class="container" id="js-ph-container">
      <div class="page-head__logo">
        <a href="<?php echo esc_url( home_url() ); ?>" class="page-head__home">
          <img src="<?php echo $progressive['nav-logo']['url']; ?>" class="" alt="Enhance Dental Care of Lawrence">
        </a>
      </div>
      <div class="page-head__nav">
        <nav class="site-nav">
          <ul class="site-nav__list  list-inline">
            <li class="site-nav__item  site-nav__item--close">
              <a href="#" class="site-nav__link  site-nav__link--close">
                <svg width="21px" height="28px" viewBox="19 16 21 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <path d="M29.9915493,31.6917664 L38.4198304,40.1200475 L39.9830987,38.5567792 L31.5548176,30.1284981 L39.9987669,21.6845488 L38.4354986,20.1212806 L29.9915493,28.5652299 L21.5476,20.1212806 L19.9843318,21.6845488 L28.4282811,30.1284981 L20,38.5567792 L21.5632682,40.1200475 L29.9915493,31.6917664 Z" id="Combined-Shape" stroke="none" fill="#FFFFFF" fill-rule="evenodd"></path>
                </svg>
              </a>
            </li>
            <?php wp_nav_menu( array( 'menu_id' => 'primary-menu', 'items_wrap' => '%3$s', 'container' => false, 'menu_class' => false, 'walker' => new Wpse8170_Menu_Walker() ) ); ?>
          </ul>

        </nav>
        <a href="" class="site-nav__open">
          <span class="top"></span>
          <span class="middle"></span>
          <span class="bottom"></span>
        </a>
      </div>
    </div>
  </header>
