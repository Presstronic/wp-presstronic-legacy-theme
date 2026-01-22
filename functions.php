<?php
/**
 * Presstronic Legacy Theme.
 *
 * @package presstronic-legacy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup.
 */
function presstronic_legacy_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support(
		'custom-header',
		array(
			'width'       => 2000,
			'height'      => 1200,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'presstronic-legacy' ),
		)
	);
}
add_action( 'after_setup_theme', 'presstronic_legacy_setup' );

/**
 * Register widget areas.
 */
function presstronic_legacy_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'presstronic-legacy' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Main sidebar area.', 'presstronic-legacy' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'presstronic_legacy_widgets_init' );

/**
 * Enqueue theme assets.
 */
function presstronic_legacy_enqueue_assets() {
	$ver = wp_get_theme()->get( 'Version' );

	// Theme stylesheet (required by WP).
	wp_enqueue_style( 'presstronic-legacy-style', get_stylesheet_uri(), array(), $ver );

	// Main CSS/JS.
	wp_enqueue_style( 'presstronic-legacy-main', get_template_directory_uri() . '/assets/css/main.css', array(), $ver );
	wp_enqueue_script( 'presstronic-legacy-main', get_template_directory_uri() . '/assets/js/main.js', array(), $ver, true );

	// Hero image as CSS var (keeps CSS cache-friendly).
	$hero_url = presstronic_legacy_get_hero_image_url();
	$inline   = ':root{ --hero-url: url("' . esc_url( $hero_url ) . '"); }';
	wp_add_inline_style( 'presstronic-legacy-main', $inline );
}
add_action( 'wp_enqueue_scripts', 'presstronic_legacy_enqueue_assets' );

/**
 * Enqueue comment reply script when needed.
 */
function presstronic_legacy_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'presstronic_legacy_enqueue_comment_reply' );

/**
 * Get the hero image URL.
 *
 * @return string
 */
function presstronic_legacy_get_hero_image_url() {
	$custom = get_theme_mod( 'presstronic_hero_image' );
	if ( $custom ) {
		return $custom;
	}

	// Default bundled image.
	return get_template_directory_uri() . '/assets/img/hero.jpg';
}

/**
 * Customizer: minimal controls for the homepage copy + hero image.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function presstronic_legacy_customize_register( $wp_customize ) {

	$wp_customize->add_section(
		'presstronic_home',
		array(
			'title'    => __( 'Homepage', 'presstronic-legacy' ),
			'priority' => 30,
		)
	);

	// Hero image.
	$wp_customize->add_setting(
		'presstronic_hero_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'presstronic_hero_image_control',
			array(
				'label'    => __( 'Hero Background Image', 'presstronic-legacy' ),
				'section'  => 'presstronic_home',
				'settings' => 'presstronic_hero_image',
			)
		)
	);

	// Text settings helper.
	$add_text = function( $id, $label, $default_value ) use ( $wp_customize ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $default_value,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label,
				'section' => 'presstronic_home',
				'type'    => 'text',
			)
		);
	};

	$wp_customize->add_setting(
		'presstronic_hero_body',
		array(
			'default'           => 'We build and ship our own line of software products with a focus on thoughtful design, reliability, and long-term value. We are also open to collaboration for the right project.',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'presstronic_hero_body',
		array(
			'label'   => __( 'Hero Paragraph', 'presstronic-legacy' ),
			'section' => 'presstronic_home',
			'type'    => 'textarea',
		)
	);

	$add_text( 'presstronic_hero_title', __( 'Hero Title', 'presstronic-legacy' ), 'We craft our own software products.' );
	$add_text( 'presstronic_hero_button', __( 'Hero Button Text', 'presstronic-legacy' ), 'See What’s Coming' );

	$add_text( 'presstronic_about_title', __( 'About Title', 'presstronic-legacy' ), 'Focused on products, open to contracts.' );
	$wp_customize->add_setting(
		'presstronic_about_body',
		array(
			'default'           => 'Presstronic LLC is where our own ideas become real, useful products. When a contract aligns with our strengths and timeline, we’re open to building software for others—especially if it helps solve a tough, meaningful problem.',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'presstronic_about_body',
		array(
			'label'   => __( 'About Paragraph', 'presstronic-legacy' ),
			'section' => 'presstronic_home',
			'type'    => 'textarea',
		)
	);
	$add_text( 'presstronic_about_button', __( 'About Button Text', 'presstronic-legacy' ), 'Let’s Talk' );

	$add_text( 'presstronic_services_title', __( 'Services Title', 'presstronic-legacy' ), 'Current Projects' );

	$wp_customize->add_section(
		'presstronic_contact',
		array(
			'title'    => __( 'Contact', 'presstronic-legacy' ),
			'priority' => 31,
		)
	);
	$add_text( 'presstronic_contact_title', __( 'Contact Title', 'presstronic-legacy' ), 'Let’s DO This!' );
	$wp_customize->add_setting(
		'presstronic_contact_body',
		array(
			'default'           => 'Have a project in mind or want to follow our product releases? Reach out and we’ll get back to you soon.',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'presstronic_contact_body',
		array(
			'label'   => __( 'Contact Paragraph', 'presstronic-legacy' ),
			'section' => 'presstronic_contact',
			'type'    => 'textarea',
		)
	);
	$add_text( 'presstronic_twitter_handle', __( 'Twitter Handle (text)', 'presstronic-legacy' ), '@Presstronic' );
	$add_text( 'presstronic_twitter_url', __( 'Twitter URL', 'presstronic-legacy' ), 'https://twitter.com/Presstronic' );
	$add_text( 'presstronic_contact_email', __( 'Contact Email', 'presstronic-legacy' ), 'sales@presstronic.com' );
}
add_action( 'customize_register', 'presstronic_legacy_customize_register' );

/**
 * Simple helper for safe theme mods with defaults.
 *
 * @param string $key           Theme mod key.
 * @param string $default_value Default value.
 * @return string
 */
function presstronic_legacy_mod( $key, $default_value = '' ) {
	$val = get_theme_mod( $key, $default_value );
	return $val;
}

/**
 * Register block patterns and styles.
 */
function presstronic_legacy_register_block_assets() {
	if ( function_exists( 'register_block_pattern' ) ) {
		register_block_pattern(
			'presstronic-legacy/hero-cta',
			array(
				'title'       => __( 'Hero CTA', 'presstronic-legacy' ),
				'description' => __( 'A simple hero with heading, text, and button.', 'presstronic-legacy' ),
				'content'     => '<!-- wp:heading {"textAlign":"center"} --><h2 class="has-text-align-center">' . esc_html__( 'Build something memorable.', 'presstronic-legacy' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">' . esc_html__( 'Launch your next product with a fast, focused theme.', 'presstronic-legacy' ) . '</p><!-- /wp:paragraph --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link">' . esc_html__( 'Get Started', 'presstronic-legacy' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons -->',
				'categories'  => array( 'buttons', 'text' ),
			)
		);
	}

	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/button',
			array(
				'name'  => 'presstronic-ghost',
				'label' => __( 'Ghost Button', 'presstronic-legacy' ),
			)
		);
	}
}
add_action( 'init', 'presstronic_legacy_register_block_assets' );

/**
 * Add CF7 honeypot field.
 *
 * @param string $content Form HTML.
 * @return string
 */
function presstronic_cf7_add_honeypot( $content ) {
	if ( strpos( $content, 'presstronic_hp' ) !== false ) {
		return $content;
	}

	$field = '<span class="presstronic-hp" aria-hidden="true">'
		. '<label>Leave this field empty'
		. '<input type="text" name="presstronic_hp" value="" tabindex="-1" autocomplete="off" />'
		. '</label></span>';

	return $content . $field;
}
add_filter( 'wpcf7_form_elements', 'presstronic_cf7_add_honeypot' );

/**
 * Add hidden timestamp field for CF7.
 *
 * @param array $fields Hidden fields.
 * @return array
 */
function presstronic_cf7_hidden_fields( $fields ) {
	$fields['presstronic_ts'] = time();
	return $fields;
}
add_filter( 'wpcf7_form_hidden_fields', 'presstronic_cf7_hidden_fields' );

/**
 * Flag CF7 submissions as spam if honeypot/time checks fail.
 *
 * @param bool $spam Current spam status.
 * @return bool
 */
function presstronic_cf7_spam_check( $spam ) {
	if ( $spam ) {
		return $spam;
	}

	$submission = WPCF7_Submission::get_instance();
	if ( ! $submission ) {
		return $spam;
	}

	$posted = $submission->get_posted_data();
	if ( ! empty( $posted['presstronic_hp'] ) ) {
		return true;
	}

	if ( empty( $posted['presstronic_ts'] ) ) {
		return true;
	}

	$age = time() - intval( $posted['presstronic_ts'] );
	if ( $age < 3 || $age > DAY_IN_SECONDS ) {
		return true;
	}

	return false;
}
add_filter( 'wpcf7_spam', 'presstronic_cf7_spam_check' );
