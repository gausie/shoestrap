<?php

/**
 * Single Topic Content Part
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
  
  bbp_breadcrumb( $breadcrumb_args ); ?>

	<?php do_action( 'bbp_template_before_single_forum' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php bbp_single_forum_description(); ?>

		<?php if ( bbp_get_forum_subforum_count() && bbp_has_forums() ) : ?>

			<?php bbp_get_template_part( 'loop', 'forums' ); ?>

		<?php endif; ?>

		<?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>

			<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

			<?php bbp_get_template_part( 'loop',       'topics'    ); ?>

			<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

			<?php bbp_get_template_part( 'form',       'topic'     ); ?>

		<?php elseif ( !bbp_is_forum_category() ) : ?>

			<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

			<?php bbp_get_template_part( 'form',       'topic'     ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_forum' ); ?>
