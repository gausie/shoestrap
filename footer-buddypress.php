      </div><!-- /.main -->
      <?php if ( ( get_theme_mod( 'layout' ) != 0 && ( roots_display_sidebar() ) ) || ( is_front_page() && get_theme_mod( 'layout_sidebar_on_front' ) == 1 ) ) : ?>
        <?php if ( !is_front_page() || ( is_front_page() && get_theme_mod( 'layout_sidebar_on_front' ) == 1 ) ) : ?>
          <aside class="sidebar <?php shoestrap_section_class( 'primary', true ); ?>" role="complementary">
            <?php include roots_sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      <?php endif; ?>
      <?php if ( shoestrap_section_class( 'wrap' ) ) : ?></div></div><?php endif; ?>
      <?php if ( get_theme_mod( 'layout' ) >= 3 && is_active_sidebar( 'sidebar-secondary' ) ) : ?>
        <?php if ( !is_front_page() || ( is_front_page() && get_theme_mod( 'layout_sidebar_on_front' ) == 1 ) ) : ?>
          <aside class="sidebar secondary <?php shoestrap_section_class( 'secondary', true ); ?>" role="complementary">
            <?php dynamic_sidebar('sidebar-secondary'); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      <?php endif; ?>
    </div><!-- /.content -->
    <?php do_action('shoestrap_after_content'); ?>
  </div><!-- /.wrap -->
  <?php do_action('shoestrap_after_wrap'); ?>

  <?php if ( shoestrap_getVariable( 'site_style' ) == 'boxed' ) :?><div class="container boxed-container"><?php endif; ?>
  <?php do_action('shoestrap_pre_footer'); ?>
  <?php get_template_part('templates/footer'); ?>
  <?php do_action('shoestrap_after_footer'); ?>
  <?php if ( shoestrap_getVariable( 'site_style' ) == 'boxed' ) :?></div><?php endif; ?>

</body>
</html>
