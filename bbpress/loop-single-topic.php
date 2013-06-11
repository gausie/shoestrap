<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<tr <?php bbp_topic_class(); ?>>
  <td class="bbp-topic-title">
    <?php if ( bbp_is_user_home() ) : ?>
      <?php if ( bbp_is_favorites() ) : ?>
        <span class="bbp-topic-action">
          <?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>
          <?php bbp_user_favorites_link( array( 'mid' => '+', 'post' => '' ), array( 'pre' => '', 'mid' => '&times;', 'post' => '' ) ); ?>
          <?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>
        </span>
      <?php elseif ( bbp_is_subscriptions() ) : ?>
        <span class="bbp-topic-action">
          <?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>
          <?php bbp_user_subscribe_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>
          <?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>
        </span>
      <?php endif; ?>
    <?php endif; ?>
    
    <?php do_action( 'bbp_theme_before_topic_title' ); ?>
    <a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>" title="<?php bbp_topic_title(); ?>"><h5><?php bbp_topic_title(); ?></h5></a>
    <?php do_action( 'bbp_theme_after_topic_title' ); ?>
    
    <div class="pagination pagination-mini" style="margin: 0;">
      <ul>
        <?php
        $pagination_args = array(
          'topic_id' => bbp_get_topic_id(),
          'before'   => '<li>',
          'after'    => '</li>',
        );
        echo bbp_get_topic_pagination( $pagination_args );
        ?>
      </ul>
    </div>

    <?php do_action( 'bbp_theme_before_topic_meta' ); ?>

    <?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() != bbp_get_forum_id() ) ) : ?>
      <?php do_action( 'bbp_theme_before_topic_started_in' ); ?>
      <small>
        <span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>
      </small>
      <?php do_action( 'bbp_theme_after_topic_started_in' ); ?>
    <?php endif; ?>
    
    <?php do_action( 'bbp_theme_after_topic_meta' ); ?>
    
    <?php bbp_topic_row_actions(); ?>
  </td>
  
  <td class="bbp-topic-voice-count"><?php bbp_topic_voice_count(); ?></td>
  
  <td class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></td>
  
  <td class="bbp-topic-freshness">
    
    <p>
      <?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>
      <small><?php bbp_topic_freshness_link(); ?></small>
      <?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>
    </p>
    
    <p>
      <?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>
      <span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 14 ) ); ?></span>
      <?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>
    </p>
    
    <p>
      <?php do_action( 'bbp_theme_before_topic_started_by' ); ?>
      <small>
        <span class="bbp-topic-started-by"><?php printf( __( 'Started by: %1$s', 'bbpress' ), bbp_get_topic_author_link( array( 'size' => '10' ) ) ); ?></span>
      </small>
      <?php do_action( 'bbp_theme_after_topic_started_by' ); ?>
    </p>
  </td>
  
</tr>
  