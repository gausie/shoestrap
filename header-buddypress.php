<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->

  <?php if ( shoestrap_getVariable( 'site_style' ) == 'boxed' ) :?><div class="container boxed-container"><?php endif; ?>
  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>
  <?php if ( shoestrap_getVariable( 'site_style' ) == 'boxed' ) :?></div><?php endif; ?>

  <?php if ( has_action( 'shoestrap_below_top_navbar' ) ) : ?>
    <div class="before-main-wrapper">
      <?php do_action('shoestrap_below_top_navbar'); ?>
    </div>
  <?php endif; ?>

  <?php do_action('shoestrap_pre_wrap'); ?>
  <div class="wrap main-section <?php echo shoestrap_container_class(); ?>" role="document">
    <?php do_action('shoestrap_pre_content'); ?>
    <div class="content row">
      <?php do_action('shoestrap_pre_main'); ?>
      <?php if ( shoestrap_section_class( 'wrap' ) ) : ?><div class="mp_wrap <?php shoestrap_section_class( 'wrapper', true ); ?>"><div class="row"><?php endif; ?>
      <div class="main <?php shoestrap_section_class( 'main', true ); ?>" role="main">
        <?php do_action('shoestrap_breadcrumbs'); ?>
