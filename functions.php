<?php
/**
 * Presstronic Legacy Theme
 */

if ( ! defined('ABSPATH') ) { exit; }

function presstronic_legacy_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
  add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 300,
    'flex-height' => true,
    'flex-width'  => true,
  ));

  register_nav_menus(array(
    'primary' => __('Primary Menu', 'presstronic-legacy'),
  ));
}
add_action('after_setup_theme', 'presstronic_legacy_setup');

function presstronic_legacy_enqueue_assets() {
  $ver = wp_get_theme()->get('Version');

  // Theme stylesheet (required by WP)
  wp_enqueue_style('presstronic-legacy-style', get_stylesheet_uri(), array(), $ver);

  // Main CSS/JS
  wp_enqueue_style('presstronic-legacy-main', get_template_directory_uri() . '/assets/css/main.css', array(), $ver);
  wp_enqueue_script('presstronic-legacy-main', get_template_directory_uri() . '/assets/js/main.js', array(), $ver, true);

  // Hero image as CSS var (keeps CSS cache-friendly)
  $hero_url = presstronic_legacy_get_hero_image_url();
  $inline = ':root{ --hero-url: url("' . esc_url($hero_url) . '"); }';
  wp_add_inline_style('presstronic-legacy-main', $inline);
}
add_action('wp_enqueue_scripts', 'presstronic_legacy_enqueue_assets');

function presstronic_legacy_get_hero_image_url() {
  $custom = get_theme_mod('presstronic_hero_image');
  if ($custom) return $custom;

  // Default bundled image
  return get_template_directory_uri() . '/assets/img/hero.jpg';
}

/**
 * Customizer: minimal controls for the homepage copy + hero image.
 */
function presstronic_legacy_customize_register($wp_customize) {

  $wp_customize->add_section('presstronic_home', array(
    'title'    => __('Homepage', 'presstronic-legacy'),
    'priority' => 30,
  ));

  // Hero image
  $wp_customize->add_setting('presstronic_hero_image', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'presstronic_hero_image_control',
    array(
      'label'    => __('Hero Background Image', 'presstronic-legacy'),
      'section'  => 'presstronic_home',
      'settings' => 'presstronic_hero_image',
    )
  ));

  // Text settings helper
  $add_text = function($id, $label, $default) use ($wp_customize) {
    $wp_customize->add_setting($id, array(
      'default'           => $default,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control($id, array(
      'label'   => $label,
      'section' => 'presstronic_home',
      'type'    => 'text',
    ));
  };

  $wp_customize->add_setting('presstronic_hero_body', array(
    'default'           => 'We build and ship our own line of software products with a focus on thoughtful design, reliability, and long-term value. We are also open to collaboration for the right project.',
    'sanitize_callback' => 'wp_kses_post',
  ));
  $wp_customize->add_control('presstronic_hero_body', array(
    'label'   => __('Hero Paragraph', 'presstronic-legacy'),
    'section' => 'presstronic_home',
    'type'    => 'textarea',
  ));

  $add_text('presstronic_hero_title', __('Hero Title', 'presstronic-legacy'), 'We craft our own software products.');
  $add_text('presstronic_hero_button', __('Hero Button Text', 'presstronic-legacy'), "See What’s Coming");

  $add_text('presstronic_about_title', __('About Title', 'presstronic-legacy'), 'Focused on products, open to contracts.');
  $wp_customize->add_setting('presstronic_about_body', array(
    'default'           => 'Presstronic LLC is where our own ideas become real, useful products. When a contract aligns with our strengths and timeline, we’re open to building software for others—especially if it helps solve a tough, meaningful problem.',
    'sanitize_callback' => 'wp_kses_post',
  ));
  $wp_customize->add_control('presstronic_about_body', array(
    'label'   => __('About Paragraph', 'presstronic-legacy'),
    'section' => 'presstronic_home',
    'type'    => 'textarea',
  ));
  $add_text('presstronic_about_button', __('About Button Text', 'presstronic-legacy'), "Let’s Talk");

  $add_text('presstronic_services_title', __('Services Title', 'presstronic-legacy'), 'Current Projects');

  $wp_customize->add_section('presstronic_contact', array(
    'title'    => __('Contact', 'presstronic-legacy'),
    'priority' => 31,
  ));
  $add_text('presstronic_contact_title', __('Contact Title', 'presstronic-legacy'), "Let’s DO This!");
  $wp_customize->add_setting('presstronic_contact_body', array(
    'default'           => 'Have a project in mind or want to follow our product releases? Reach out and we’ll get back to you soon.',
    'sanitize_callback' => 'wp_kses_post',
  ));
  $wp_customize->add_control('presstronic_contact_body', array(
    'label'   => __('Contact Paragraph', 'presstronic-legacy'),
    'section' => 'presstronic_contact',
    'type'    => 'textarea',
  ));
  $add_text('presstronic_twitter_handle', __('Twitter Handle (text)', 'presstronic-legacy'), '@Presstronic');
  $add_text('presstronic_twitter_url', __('Twitter URL', 'presstronic-legacy'), 'https://twitter.com/Presstronic');
  $add_text('presstronic_contact_email', __('Contact Email', 'presstronic-legacy'), 'sales@presstronic.com');
}
add_action('customize_register', 'presstronic_legacy_customize_register');

/**
 * Simple helper for safe theme mods with defaults.
 */
function presstronic_legacy_mod($key, $default = '') {
  $val = get_theme_mod($key, $default);
  return $val;
}

// CF7 anti-spam: honeypot + time check.
function presstronic_cf7_add_honeypot($content) {
  if (strpos($content, 'presstronic_hp') !== false) {
    return $content;
  }

  $field = '<span class="presstronic-hp" aria-hidden="true">'
    . '<label>Leave this field empty'
    . '<input type="text" name="presstronic_hp" value="" tabindex="-1" autocomplete="off" />'
    . '</label></span>';

  return $content . $field;
}
add_filter('wpcf7_form_elements', 'presstronic_cf7_add_honeypot');

function presstronic_cf7_hidden_fields($fields) {
  $fields['presstronic_ts'] = time();
  return $fields;
}
add_filter('wpcf7_form_hidden_fields', 'presstronic_cf7_hidden_fields');

function presstronic_cf7_spam_check($spam) {
  if ($spam) {
    return $spam;
  }

  $submission = WPCF7_Submission::get_instance();
  if (!$submission) {
    return $spam;
  }

  $posted = $submission->get_posted_data();
  if (!empty($posted['presstronic_hp'])) {
    return true;
  }

  if (empty($posted['presstronic_ts'])) {
    return true;
  }

  $age = time() - intval($posted['presstronic_ts']);
  if ($age < 3 || $age > DAY_IN_SECONDS) {
    return true;
  }

  return false;
}
add_filter('wpcf7_spam', 'presstronic_cf7_spam_check');
