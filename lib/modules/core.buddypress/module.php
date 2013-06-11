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

/**
 * Output the Private Message search form
 *
 * @since BuddyPress (1.6)
 */
function shoestrap_bp_message_search_form() {

  $default_search_value = bp_get_search_default_text( 'messages' );
  $search_value         = !empty( $_REQUEST['s'] ) ? stripslashes( $_REQUEST['s'] ) : $default_search_value; ?>

  <form action="" method="get" id="search-message-form" class="input-group">
    <input type="text" name="s" id="messages_search" <?php if ( $search_value === $default_search_value ) : ?>placeholder="<?php echo esc_html( $search_value ); ?>"<?php endif; ?> <?php if ( $search_value !== $default_search_value ) : ?>value="<?php echo esc_html( $search_value ); ?>"<?php endif; ?> />
    <span class="input-group-btn">
      <input class="btn btn-info" type="submit" id="messages_search_submit" name="messages_search_submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
    </span>
  </form>

<?php
}

/**
 * Display the activity delete link.
 *
 * @since BuddyPress (1.1)
 *
 * @uses bp_get_activity_delete_link()
 */
function shoestrap_bp_activity_delete_link() {
  echo shoestrap_bp_get_activity_delete_link();
}

/**
 * Return the activity delete link.
 *
 * @since BuddyPress (1.1)
 *
 * @global object $activities_template {@link BP_Activity_Template}
 * @uses bp_get_root_domain()
 * @uses bp_get_activity_root_slug()
 * @uses bp_is_activity_component()
 * @uses bp_current_action()
 * @uses add_query_arg()
 * @uses wp_get_referer()
 * @uses wp_nonce_url()
 * @uses apply_filters() To call the 'bp_get_activity_delete_link' hook
 *
 * @return string $link Activity delete link. Contains $redirect_to arg if on single activity page.
 */
function shoestrap_bp_get_activity_delete_link() {
  global $activities_template;

  $url   = bp_get_root_domain() . '/' . bp_get_activity_root_slug() . '/delete/' . $activities_template->activity->id;
  $class = 'delete-activity';

  // Determine if we're on a single activity page, and customize accordingly
  if ( bp_is_activity_component() && is_numeric( bp_current_action() ) ) {
    $url   = add_query_arg( array( 'redirect_to' => wp_get_referer() ), $url );
    $class = 'delete-activity-single';
  }

  $link = '<a href="' . wp_nonce_url( $url, 'bp_activity_delete_link' ) . '" class="btn btn-danger btn-small item-button bp-secondary-action ' . $class . ' confirm" rel="nofollow">' . __( 'Delete', 'buddypress' ) . '</a>';
  return apply_filters( 'bp_get_activity_delete_link', $link );
}

function shoestrap_bp_messages_options() {
?>
  <div class="input-prepend">
    <?php _e( 'Select:', 'buddypress' ) ?>
    <select name="message-type-select" id="message-type-select">
      <option value=""></option>
      <option value="read"><?php _e('Read', 'buddypress') ?></option>
      <option value="unread"><?php _e('Unread', 'buddypress') ?></option>
      <option value="all"><?php _e('All', 'buddypress') ?></option>
    </select> &nbsp;

    <?php if ( ! bp_is_current_action( 'sentbox' ) && bp_is_current_action( 'notices' ) ) : ?>

      <a class="btn btn-primary" href="#" id="mark_as_read"><?php _e('Mark as Read', 'buddypress') ?></a> &nbsp;
      <a class="btn btn-primary" href="#" id="mark_as_unread"><?php _e('Mark as Unread', 'buddypress') ?></a> &nbsp;

    <?php endif; ?>

    <a class="btn btn-primary" href="#" id="delete_<?php echo bp_current_action(); ?>_messages"><?php _e( 'Delete Selected', 'buddypress' ); ?></a> &nbsp;
  </div>

<?php
}

function shoestrap_bp_directory_forums_search_form() {
  global $bp;

  $default_search_value = bp_get_search_default_text( 'forums' );
  $search_value = !empty( $_REQUEST['fs'] ) ? stripslashes( $_REQUEST['fs'] ) : $default_search_value;  ?>

  <form action="" method="get" id="search-forums-form">
    <div class="input-append">
      <input type="text" name="s" id="forums_search" placeholder="<?php echo esc_attr( $search_value ); ?>" />
      <input class="btn" type="submit" id="forums_search_submit" name="forums_search_submit" value="<?php _e( 'Search', 'buddypress' ); ?>" />
    </div>
  </form>

<?php
}
