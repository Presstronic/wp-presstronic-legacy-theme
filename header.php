<?php if ( ! defined('ABSPATH') ) { exit; } ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content"><?php esc_html_e('Skip to content', 'presstronic-legacy'); ?></a>

<header class="site-nav" role="banner">
  <div class="nav-inner">
    <?php if (has_custom_logo()) : ?>
      <?php the_custom_logo(); ?>
    <?php else : ?>
      <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
        <?php echo esc_html('PRESSTRONIC STUDIOS'); ?>
      </a>
    <?php endif; ?>

    <button class="nav-toggle" type="button" aria-label="<?php esc_attr_e('Toggle menu', 'presstronic-legacy'); ?>" aria-controls="primary-navigation" aria-expanded="false">
      <span class="bar"></span><span class="bar"></span><span class="bar"></span>
    </button>

    <nav id="primary-navigation" aria-label="<?php esc_attr_e('Primary', 'presstronic-legacy'); ?>">
      <ul class="nav-links">
        <?php if (is_front_page()) : ?>
          <?php
            $contact_page = get_page_by_path('contact-us');
            $contact_url = $contact_page ? get_permalink($contact_page) : home_url('/contact-us/');
          ?>
          <li><a href="#about"><?php esc_html_e('ABOUT', 'presstronic-legacy'); ?></a></li>
          <li><a href="#services"><?php esc_html_e('SERVICES', 'presstronic-legacy'); ?></a></li>
          <li><a href="<?php echo esc_url($contact_url); ?>"><?php esc_html_e('CONTACT', 'presstronic-legacy'); ?></a></li>
        <?php else : ?>
          <?php
            // If user set up a menu, render it; otherwise fall back to a Home link.
            if (has_nav_menu('primary')) {
              wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'items_wrap'     => '%3$s', // output <li> items only
                'fallback_cb'    => false,
              ));
            } else {
              echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'presstronic-legacy') . '</a></li>';
            }
          ?>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
