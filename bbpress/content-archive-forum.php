<?php

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

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
  
  do_action( 'bbp_template_before_forums_index' );
  
  if ( bbp_has_forums() ) {
    bbp_get_template_part( 'loop', 'forums' );
  } else {
    bbp_get_template_part( 'feedback', 'no-forums' );
  }
  
  do_action( 'bbp_template_after_forums_index' );
  