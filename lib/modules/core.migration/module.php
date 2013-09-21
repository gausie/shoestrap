<?php

if ( !function_exists( 'shoestrap_module_migration_options' ) ) :
/*
 * The advanced core options for the Shoestrap theme
 */
function shoestrap_module_migration_options( $sections ) {
  $fields[] = array( 
    'title'     => __( 'Migrate options from older versions', 'shoestrap' ),
    'desc'      => __( 'Turn on if you previously had shoestrap 1.5x instaled on your site.
                        This will copy all settings from your old theme to the new version
                        giving you a good head start. Default: On.', 'shoestrap' ),
    'id'        => 'migrate',
    'default'   => 1,
    'customizer'=> array(),
    'type'      => 'switch',
  );
 
  $section['fields'] = $fields;
  $section = apply_filters( 'shoestrap_module_branding_options_modifier', $section );
  $sections[] = $section;
  return $sections;
}
endif;
add_filter( 'shoestrap_module_migration_options', 'shoestrap_module_migration_options_modifier', 95 );

if ( !function_exists( 'shoestrap_migrate_options' ) ) :
/*
 * find old values and copy to the new ones
 */
function shoestrap_migrate_options() {
  if ( get_theme_mod( 'shoestrap_background_color' ) )
    set_theme_mod( 'color_body_bg', get_theme_mod( 'shoestrap_background_color' ) );

  if ( get_theme_mod( 'shoestrap_buttons_color' ) )
    set_theme_mod( 'color_brand_primary', get_theme_mod( 'shoestrap_buttons_color' ) );

  if ( get_theme_mod( 'strp_cb_sansfont' ) )
    set_theme_mod( 'font_base[face]', get_theme_mod( 'strp_cb_sansfont' ) );

  if ( get_theme_mod( 'strp_cb_basefontsize' ) )
    set_theme_mod( 'font_base[size]', get_theme_mod( 'strp_cb_basefontsize' ) );

  if ( get_theme_mod( 'strp_cb_baseborderradius' ) )
    set_theme_mod( 'general_border_radius', get_theme_mod( 'strp_cb_baseborderradius' ) );

  if ( get_theme_mod( 'strp_cb_gridwidth_normal' ) )
    set_theme_mod( 'container_desktop', get_theme_mod( 'strp_cb_gridwidth_normal' ) );

  if ( get_theme_mod( 'strp_cb_gridwidth_wide' ) )
    set_theme_mod( 'container_large_desktop', get_theme_mod( 'strp_cb_gridwidth_wide' ) );

  if ( get_theme_mod( 'strp_cb_gridwidth_narrow' ) )
    set_theme_mod( 'container_tablet', get_theme_mod( 'strp_cb_gridwidth_narrow' ) );

  if ( get_theme_mod( 'strp_cb_gridgutter_wide' ) )
    set_theme_mod( 'layout_gutter', get_theme_mod( 'strp_cb_gridgutter_wide' ) );

  if ( get_theme_mod( 'shoestrap_feat_img_archive' ) )
    set_theme_mod( 'feat_img_archive', get_theme_mod( 'shoestrap_feat_img_archive' ) );

  if ( get_theme_mod( 'shoestrap_feat_img_post' ) )
    set_theme_mod( 'feat_img_post', get_theme_mod( 'shoestrap_feat_img_post' ) );

  if ( get_theme_mod( 'shoestrap_feat_img_archive_width' ) )
    set_theme_mod( 'feat_img_archive_width', get_theme_mod( 'shoestrap_feat_img_archive_width' ) );

  if ( get_theme_mod( 'shoestrap_feat_img_archive_height' ) )
    set_theme_mod( 'feat_img_archive_height', get_theme_mod( 'shoestrap_feat_img_archive_height' ) );

  if ( get_theme_mod( 'shoestrap_feat_img_post_width' ) )
    set_theme_mod( 'feat_img_post_width', get_theme_mod( 'shoestrap_feat_img_post_width' ) );

  if ( get_theme_mod( 'shoestrap_feat_img_post_height' ) )
    set_theme_mod( 'feat_img_post_height', get_theme_mod( 'shoestrap_feat_img_post_height' ) );

  if ( get_theme_mod( 'shoestrap_footer_background_color' ) )
    set_theme_mod( 'footer_background', get_theme_mod( 'shoestrap_footer_background_color' ) );

  if ( get_theme_mod( 'shoestrap_footer_text' ) )
    set_theme_mod( 'footer_text', get_theme_mod( 'shoestrap_footer_text' ) );

  if ( get_theme_mod( 'shoestrap_footer_text_color' ) )
    set_theme_mod( 'footer_color', get_theme_mod( 'shoestrap_footer_text_color' ) );

  if ( get_theme_mod( 'shoestrap_general_no_radius' ) )
    set_theme_mod( 'general_border_radius', 0 );

  if ( get_theme_mod( 'shoestrap_extra_branding' ) )
    set_theme_mod( 'header_toggle', get_theme_mod( 'shoestrap_extra_branding' ) );

  if ( get_theme_mod( 'shoestrap_header_backgroundcolor' ) )
    set_theme_mod( 'header_bg', get_theme_mod( 'shoestrap_header_backgroundcolor' ) );

  if ( get_theme_mod( 'shoestrap_header_textcolor' ) )
    set_theme_mod( 'header_color', get_theme_mod( 'shoestrap_header_textcolor' ) );

  if ( get_theme_mod( 'shoestrap_hero_background' ) ) {
    set_theme_mod( 'jumbotron_background_image', get_theme_mod( 'shoestrap_hero_background' ) );
    set_theme_mod( 'jumbotron_background_image_toggle', 1 );
  }

  if ( get_theme_mod( 'shoestrap_hero_background_color' ) )
    set_theme_mod( 'jumbotron_bg', get_theme_mod( 'shoestrap_hero_background_color' ) );

  if ( get_theme_mod( 'shoestrap_hero_textcolor' ) )
    set_theme_mod( 'jumbotron_color', get_theme_mod( 'shoestrap_hero_textcolor' ) );

  if ( get_theme_mod( 'shoestrap_layout' ) ) {
    if ( get_theme_mod( 'shoestrap_layout' ) == 'm' )
      set_theme_mod( 'layout', 0 );

    if ( get_theme_mod( 'shoestrap_layout' ) == 'mp' || get_theme_mod( 'shoestrap_layout' ) == 'ms' )
      set_theme_mod( 'layout', 1 );

    if ( get_theme_mod( 'shoestrap_layout' ) == 'pm' || get_theme_mod( 'shoestrap_layout' ) == 'sm' )
      set_theme_mod( 'layout', 2 );

    if ( get_theme_mod( 'shoestrap_layout' ) == 'psm' || get_theme_mod( 'shoestrap_layout' ) == 'spm' )
      set_theme_mod( 'layout', 3 );

    if ( get_theme_mod( 'shoestrap_layout' ) == 'mps' || get_theme_mod( 'shoestrap_layout' ) == 'msp' )
      set_theme_mod( 'layout', 4 );

    if ( get_theme_mod( 'shoestrap_layout' ) == 'pms' || get_theme_mod( 'shoestrap_layout' ) == 'smp' )
      set_theme_mod( 'layout', 5 );
  }

  if ( get_theme_mod( 'shoestrap_aside_width' ) )
    set_theme_mod( 'layout_primary_width', get_theme_mod( 'shoestrap_aside_width' ) );

  if ( get_theme_mod( 'shoestrap_secondary_width' ) )
    set_theme_mod( 'layout_secondary_width', get_theme_mod( 'shoestrap_secondary_width' ) );

  if ( get_theme_mod( 'shoestrap_sidebar_on_front' ) )
    set_theme_mod( 'layout_sidebar_on_front', get_theme_mod( 'shoestrap_sidebar_on_front' ) );

  if ( get_theme_mod( 'shoestrap_fluid' ) )
    set_theme_mod( 'site_style', 'fluid' );

  if ( get_theme_mod( 'shoestrap_logo' ) )
    set_theme_mod( 'logo', get_theme_mod( 'shoestrap_logo' ) );

  if ( get_theme_mod( 'shoestrap_navbar_top' ) )
    set_theme_mod( 'navbar_toggle', get_theme_mod( 'shoestrap_navbar_top' ) );

  if ( get_theme_mod( 'shoestrap_navbar_color' ) )
    set_theme_mod( 'navbar_bg', get_theme_mod( 'shoestrap_navbar_color' ) );

  if ( get_theme_mod( 'shoestrap_navbar_textcolor' ) )
    set_theme_mod( 'font_navbar[color]', get_theme_mod( 'shoestrap_navbar_textcolor' ) );

  if ( get_theme_mod( 'shoestrap_navbar_branding' ) )
    set_theme_mod( 'navbar_brand', get_theme_mod( 'shoestrap_navbar_branding' ) );

  if ( get_theme_mod( 'shoestrap_navbar_logo' ) )
    set_theme_mod( 'navbar_logo', get_theme_mod( 'shoestrap_navbar_logo' ) );

  if ( get_theme_mod( 'shoestrap_navbar_social' ) )
    set_theme_mod( 'navbar_social', get_theme_mod( 'shoestrap_navbar_social' ) );

  if ( get_theme_mod( 'shoestrap_p_navbar_searchbox' ) )
    set_theme_mod( 'navbar_search', get_theme_mod( 'shoestrap_p_navbar_searchbox' ) );

  if ( get_theme_mod( 'shoestrap_nav_pull' ) )
    set_theme_mod( 'navbar_nav_right', get_theme_mod( 'shoestrap_nav_pull' ) );

  if ( get_theme_mod( 'shoestrap_navbar_fixed' ) )
    set_theme_mod( 'navbar_fixed', get_theme_mod( 'shoestrap_navbar_fixed' ) );

  if ( get_theme_mod( 'shoestrap_navbar_secondary' ) )
    set_theme_mod( 'secondary_navbar_toggle', get_theme_mod( 'shoestrap_navbar_secondary' ) );

  if ( get_theme_mod( 'shoestrap_facebook_link' ) )
    set_theme_mod( 'facebook_link', get_theme_mod( 'shoestrap_facebook_link' ) );

  if ( get_theme_mod( 'shoestrap_twitter_link' ) )
    set_theme_mod( 'twitter_link', get_theme_mod( 'shoestrap_twitter_link' ) );

  if ( get_theme_mod( 'shoestrap_google_plus_link' ) )
    set_theme_mod( 'google_plus_link', get_theme_mod( 'shoestrap_google_plus_link' ) );

  if ( get_theme_mod( 'shoestrap_pinterest_link' ) )
    set_theme_mod( 'pinterest_link', get_theme_mod( 'shoestrap_pinterest_link' ) );

  if ( get_theme_mod( 'shoestrap_facebook_on_posts' ) )
    set_theme_mod( 'facebook_share', get_theme_mod( 'shoestrap_facebook_on_posts' ) );

  if ( get_theme_mod( 'shoestrap_twitter_on_posts' ) )
    set_theme_mod( 'twitter_share', get_theme_mod( 'shoestrap_twitter_on_posts' ) );

  if ( get_theme_mod( 'shoestrap_gplus_on_posts' ) )
    set_theme_mod( 'google_plus_share', get_theme_mod( 'shoestrap_gplus_on_posts' ) );

  if ( get_theme_mod( 'shoestrap_linkedin_on_posts' ) )
    set_theme_mod( 'linkedin_share', get_theme_mod( 'shoestrap_linkedin_on_posts' ) );

  if ( get_theme_mod( 'shoestrap_pinterest_on_posts' ) )
    set_theme_mod( 'pinterest_share', get_theme_mod( 'shoestrap_pinterest_on_posts' ) );

  if ( get_theme_mod( 'shoestrap_text_color' ) )
    set_theme_mod( 'font_base[color]', get_theme_mod( 'shoestrap_text_color' ) );

  if ( get_theme_mod( 'shoestrap_link_color' ) )
    set_theme_mod( 'color_brand_primary', get_theme_mod( 'shoestrap_link_color' ) );

  if ( get_theme_mod( 'shoestrap_google_webfonts' ) ) {
    set_theme_mod( 'font_base[google]', true );
    set_theme_mod( 'font_base[face]', get_theme_mod( 'shoestrap_google_webfonts' ) );
  }

  if ( get_theme_mod( 'shoestrap_webfonts_weight' ) )
    set_theme_mod( 'twitter_share', get_theme_mod( 'shoestrap_webfonts_weight' ) );

  if ( get_theme_mod( 'shoestrap_webfonts_character_set' ) )
    set_theme_mod( 'twitter_share', get_theme_mod( 'shoestrap_webfonts_character_set' ) );
}
endif;