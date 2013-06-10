<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Uses the $bp->bp_options_nav global to render out the sub navigation for the current component.
 * Each component adds to its sub navigation array within its own setup_nav() function.
 *
 * This sub navigation array is the secondary level navigation, so for profile it contains:
 *      [Public, Edit Profile, Change Avatar]
 *
 * The function will also analyze the current action for the current component to determine whether
 * or not to highlight a particular sub nav item.
 *
 * @package BuddyPress Core
 * @global BuddyPress $bp The one true BuddyPress instance
 * @uses bp_get_user_nav() Renders the navigation for a profile of a currently viewed user.
 */
function shoestrap_bp_get_options_nav() {
  global $bp;

  // If we are looking at a member profile, then the we can use the current component as an
  // index. Otherwise we need to use the component's root_slug
  $component_index = !empty( $bp->displayed_user ) ? bp_current_component() : bp_get_root_slug( bp_current_component() );

  if ( !bp_is_single_item() ) {
    if ( !isset( $bp->bp_options_nav[$component_index] ) || count( $bp->bp_options_nav[$component_index] ) < 1 ) {
      return false;
    } else {
      $the_index = $component_index;
    }
  } else {
    if ( !isset( $bp->bp_options_nav[bp_current_item()] ) || count( $bp->bp_options_nav[bp_current_item()] ) < 1 ) {
      return false;
    } else {
      $the_index = bp_current_item();
    }
  }

  // Loop through each navigation item
  foreach ( (array) $bp->bp_options_nav[$the_index] as $subnav_item ) {
    if ( !$subnav_item['user_has_access'] )
      continue;

    // If the current action or an action variable matches the nav item id, then add a highlight CSS class.
    if ( $subnav_item['slug'] == bp_current_action() ) {
      $selected = ' class="btn btn-primary current selected active"';
    } else {
      $selected = ' class="btn btn-primary"';
    }

    // List type depends on our current component
    $list_type = bp_is_group() ? 'groups' : 'personal';

    // echo out the final list item
    echo apply_filters( 'bp_get_options_nav_' . $subnav_item['css_id'], '<a id="' . $subnav_item['css_id'] . '" href="' . $subnav_item['link'] . '"' . $selected . '>' . $subnav_item['name'] . '</a>', $subnav_item );
  }
}


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

    $selected = '';
    if ( bp_is_current_component( $user_nav_item['slug'] ) ) {
      $selected = ' class="active current selected"';
    }

    if ( bp_loggedin_user_domain() ) {
      $link = str_replace( bp_loggedin_user_domain(), bp_displayed_user_domain(), $user_nav_item['link'] );
    } else {
      $link = trailingslashit( bp_displayed_user_domain() . $user_nav_item['link'] );
    }

    echo apply_filters_ref_array( 'bp_get_displayed_user_nav_' . $user_nav_item['css_id'], array( '<li id="' . $user_nav_item['css_id'] . '-personal-li" ' . $selected . '><a id="user-' . $user_nav_item['css_id'] . '" href="' . $link . '">' . $user_nav_item['name'] . '</a></li>', &$user_nav_item ) );
  }
}
