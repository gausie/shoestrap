<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<table class="table table-striped forums-list">

	<thead>
	  <tr>
	    <td class="bbp-forum-info"><?php _e( 'Forum', 'bbpress' ); ?></td>
	    <td class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></td>
	    <td class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></td>
	    <td class="bbp-forum-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></td>
	  </tr>
	</thead>
	
	<tbody>
    <?php while ( bbp_forums() ) : bbp_the_forum(); ?>

      <?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

    <?php endwhile; ?>
	</tbody>

</table>

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
