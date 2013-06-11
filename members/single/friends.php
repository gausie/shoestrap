<?php

/**
 * BuddyPress - Users Friends
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<div class="item-list-tabs no-ajax btn-group" id="subnav" role="navigation">
		<?php if ( bp_is_my_profile() ) shoestrap_bp_get_options_nav(); ?>
</div>

		<?php if ( !bp_is_current_action( 'requests' ) ) : ?>

			<div id="members-order-select" class="last filter pull-right">

				<label class="pull-left" for="members-friends"><?php _e( 'Order By:', 'buddypress' ); ?></label>
				<select class="pull-left" id="members-friends">
					<option value="active"><?php _e( 'Last Active', 'buddypress' ); ?></option>
					<option value="newest"><?php _e( 'Newest Registered', 'buddypress' ); ?></option>
					<option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ); ?></option>

					<?php do_action( 'bp_member_blog_order_options' ); ?>

				</select>
			</div>

		<?php endif; ?>


<?php

if ( bp_is_current_action( 'requests' ) ) :
	 locate_template( array( 'members/single/friends/requests.php' ), true );

else :
	do_action( 'bp_before_member_friends_content' ); ?>

	<div class="members friends">

		<?php locate_template( array( 'members/members-loop.php' ), true ); ?>

	</div><!-- .members.friends -->

	<?php do_action( 'bp_after_member_friends_content' ); ?>

<?php endif;
