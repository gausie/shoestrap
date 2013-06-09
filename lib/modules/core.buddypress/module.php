<?php

/**
 * Uses the $bp->bp_nav global to render out the user navigation when viewing another user other than
 * yourself.
 *
 * @package BuddyPress Core
 * @global BuddyPress $bp The one true BuddyPress instance
 */
function shoestrap_bp_get_displayed_user_nav() {
  global $bp;

  foreach ( (array) $bp->bp_nav as $user_nav_item ) {
    if ( empty( $user_nav_item['show_for_displayed_user'] ) && !bp_is_my_profile() )
      continue;

    $selected = 'class="btn btn-primary"';
    if ( bp_is_current_component( $user_nav_item['slug'] ) ) {
      $selected = ' class="btn btn-primary current selected active"';
    }

    if ( bp_loggedin_user_domain() ) {
      $link = str_replace( bp_loggedin_user_domain(), bp_displayed_user_domain(), $user_nav_item['link'] );
    } else {
      $link = trailingslashit( bp_displayed_user_domain() . $user_nav_item['link'] );
    }

    echo apply_filters_ref_array( 'bp_get_displayed_user_nav_' . $user_nav_item['css_id'], array( '<a id="' . $user_nav_item['css_id'] . '" href="' . $link . '"' . $selected . '>' . $user_nav_item['name'] . '</a>', &$user_nav_item ) );
  }
}
