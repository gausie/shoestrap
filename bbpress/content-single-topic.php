<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div id="bbpress-forums">

  <?php
    $breadcrumb_args = array(

    // HTML
    'before'          => '<ul class="breadcrumb">',
    'after'           => '</ul>',
    
    // Separator
    'sep'             => '/',
    'pad_sep'         => 1,
    'sep_before'      => '<span class="divider">',
    'sep_after'       => '</span>',
    
    // Crumbs
    'crumb_before'    => '<li>',
    'crumb_after'     => '</li>',

    // Home
    'include_home'    => false,
    // 'home_text'       => $pre_front_text,

    // Forum root
    // 'include_root'    => $pre_include_root,
    // 'root_text'       => $pre_root_text,

    // Current
    // 'include_current' => $pre_include_current,
    // 'current_text'    => $pre_current_text,
    'current_before'  => '<li class="active">',
    // 'current_after'   => '</span>',
  );
  
  bbp_breadcrumb( $breadcrumb_args );
  
  do_action( 'bbp_template_before_single_topic' );
  
  if ( post_password_required() ) {
    bbp_get_template_part( 'form', 'protected' );
  } else {
    bbp_topic_tag_list();
    bbp_single_topic_description();
    
    if ( bbp_show_lead_topic() ) {
      bbp_get_template_part( 'content', 'single-topic-lead' );
    }
    
    if ( bbp_has_replies() ) {
      bbp_get_template_part( 'pagination', 'replies' );
      bbp_get_template_part( 'loop',       'replies' );
      bbp_get_template_part( 'pagination', 'replies' );
    }
    
    bbp_get_template_part( 'form', 'reply' );
  }
  
  do_action( 'bbp_template_after_single_topic' ); ?>
</div>