<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<table class="table table-striped bbp-forum-<?php bbp_forum_id(); ?>">
  
  <thead>
    <tr>
      <td class="bbp-topic-title"><?php _e( 'Topic', 'bbpress' ); ?></td>
      <td class="bbp-topic-voice-count"><?php _e( 'Voices', 'bbpress' ); ?></td>
      <td class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></td>
      <td class="bbp-topic-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></td>
    </tr>
  </thead>
  
  <tbody>
    <?php while ( bbp_topics() ) : bbp_the_topic(); ?>

      <?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

    <?php endwhile; ?>
  </tbody>
  
  <tfoot>
    <span class="td colspan<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span>
  </tfoot>
</table>

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
