<?php

/*
 * Display featured images on individual posts
 */
function shoestrap_featured_image() {
  add_theme_support('post-thumbnails');
  $width  = shoestrap_content_width_px();
  if ( is_single() ) {
    // Do not process if we don't want images on single posts
    if ( shoestrap_getVariable( 'feat_img_post' ) != 1 )
      return;

    $url      = wp_get_attachment_url( get_post_thumbnail_id() );

    if (shoestrap_getVariable( 'feat_img_post_custom_toggle' ) == 1)
      $width  = shoestrap_getVariable( 'feat_img_post_width' );

    $height   = shoestrap_getVariable( 'feat_img_post_height' );
  } else {
    // Do not process if we don't want images on post archives
    if ( shoestrap_getVariable( 'feat_img_archive' ) == 0 )
      return;

    $url      = wp_get_attachment_url( get_post_thumbnail_id() );

    if (shoestrap_getVariable( 'feat_img_archive_custom_toggle' ) == 1)
      $width  = shoestrap_getVariable( 'feat_img_archive_width' );

    $height   = shoestrap_getVariable( 'feat_img_archive_height' );
  }


  $crop     = true;
  $retina   = false;
  if ( shoestrap_getVariable( 'retina_toggle' ) == 1 ) {
    $retina   = true;
    // Create the retina image so that it may later be used bt retina.js
    matthewruddy_image_resize( $url, $width, $height, $crop, $retina );
  }

  if ( has_post_thumbnail() && '' != get_the_post_thumbnail() ):
    $image = matthewruddy_image_resize( $url, $width, $height, $crop, false );
    echo '<a href="' . get_permalink() . '"><img src="' . $image['url'] . '" /></a>';
  endif;
}
add_action( 'shoestrap_before_the_content', 'shoestrap_featured_image' );
add_action( 'shoestrap_single_pre_content', 'shoestrap_featured_image' );