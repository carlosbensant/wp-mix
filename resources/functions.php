<?php
global $siteVersion;
$siteVersion = '1.0.0';

// Hide Admin Bar
add_filter('show_admin_bar', '__return_false');

// Load CSS Styles
function enqueue_style() {
  global $siteVersion;
  wp_enqueue_style('styles', get_template_directory_uri() . '/css/styles.css', '', $siteVersion);
}
add_action('wp_enqueue_scripts', 'enqueue_style');

// Load JS Scripts
function enqueue_script() {
  global $siteVersion;
  wp_register_script('scripts', get_template_directory_uri() . '/js/app.js', '', $siteVersion, true);

  wp_enqueue_script('scripts');

  $scripts_nonce = wp_create_nonce('lbc_cards');
  wp_localize_script(
    'scripts',
    'scripts_object',
    array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'nonce' => $scripts_nonce
    )
  );
}
add_action('wp_enqueue_scripts', 'enqueue_script');

function dequeue_script() {
  if(!is_admin()) {
    wp_deregister_script('jquery');
    wp_deregister_script('wp-embed');
  }
}
add_action('wp_enqueue_scripts', 'dequeue_script');

add_filter('wpcf7_load_js', '__return_false');

// Register image sizes
function add_custom_sizes() {
  // add_image_size('full-hd-width', 1920);
  // add_image_size('full-hd-cropped', 1920, 1080, true);
}
add_action('after_setup_theme', 'add_custom_sizes');

function register_my_menu() {
  register_nav_menus(
    array(
      'header-menu' => __('Hamburger Menu'),
      'footer-menu' => __('Footer Menu')
    )
  );
}
add_action('init', 'register_my_menu');

// Enable featured image for post
add_theme_support('post-thumbnails');

// Remove WPML Generator Meta Tag
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Disallow Theme and Plugin Editor
define('DISALLOW_FILE_EDIT', true);

// Deactivate Wordpress REST API
// add_filter('rest_enabled', '__return_false');
// add_filter('rest_jsonp_enabled', '__return_false');

// Deactivate Theme Update Check
function deactivateThemeUpdateCheck($r, $url) {
  if (0 !== strpos($url, 'http://api.wordpress.org/themes/update-check'))
    return $r; // Not a theme update request. Bail immediately.

  $themes = unserialize($r['body']['themes']);
  unset( $themes[ get_option('template' )]);
  unset( $themes[ get_option('stylesheet')]);
  $r['body']['themes'] = serialize($themes);
  return $r;
}

add_filter('http_request_args', 'deactivateThemeUpdateCheck', 5, 2);

// Change excerpt length
function wpdocs_custom_excerpt_length($length) {
  return 40;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

// Don't wrap images in p tags
function filter_ptags_on_images($content) {
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

if(function_exists('acf_add_options_page')) {
  $option_page = acf_add_options_page(array(
    'page_title' => 'General Content',
    'menu_title' => 'General Content',
    'menu_slug' => 'general-content',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}

// Allow Editors to edit Menu
$role_object = get_role('editor');
$role_object->add_cap('edit_theme_options');

// Disable WP Emoticons
function disable_emojicons_tinymce($plugins) {
  if(is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  }else{
    return array();
  }
}
function disable_wp_emojicons() {
  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
  add_filter( 'emoji_svg_url', '__return_false' );
}
add_action('init', 'disable_wp_emojicons');
