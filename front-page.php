<?php
if ( ! defined('ABSPATH') ) { exit; }
get_header();

$hero_title   = presstronic_legacy_mod('presstronic_hero_title', 'We craft our own software products.');
$hero_body    = presstronic_legacy_mod('presstronic_hero_body', 'We build and ship our own line of software products with a focus on thoughtful design, reliability, and long-term value. We are also open to collaboration for the right project.');
$hero_btn     = presstronic_legacy_mod('presstronic_hero_button', 'Find Out More');

$about_title  = presstronic_legacy_mod('presstronic_about_title', 'We make your internet home, worry free!');
$about_body   = presstronic_legacy_mod('presstronic_about_body', "Presstronic Studios LLC is here to make sure you can have a little bit less to worry about, and a lot more to be excited about with your businesses web presence. It's that simple!");
$about_btn    = presstronic_legacy_mod('presstronic_about_button', "Let's DO this!");

$services_title = presstronic_legacy_mod('presstronic_services_title', 'How Can we Help?');

$contact_title = presstronic_legacy_mod('presstronic_contact_title', "Let's DO This!");
$contact_body  = presstronic_legacy_mod('presstronic_contact_body', "Ready to start your next project with us? That's great! Send us an email and we will get back to you as soon as possible!");
$tw_text       = presstronic_legacy_mod('presstronic_twitter_handle', '@Presstronic');
$tw_url        = presstronic_legacy_mod('presstronic_twitter_url', 'https://twitter.com/Presstronic');
$email         = presstronic_legacy_mod('presstronic_contact_email', 'sales@presstronic.com');
?>

<main id="main-content" class="hero" role="main" aria-label="Homepage hero">
  <div class="hero-inner">
    <h1><?php echo esc_html($hero_title); ?></h1>
    <div class="divider" aria-hidden="true"></div>
    <p><?php echo wp_kses_post(nl2br(esc_html($hero_body))); ?></p>
    <a class="btn" href="#about"><?php echo esc_html($hero_btn); ?></a>
  </div>
</main>

<section class="section section--orange" aria-label="About">
  <span class="anchor" id="about"></span>
  <div class="wrap">
    <h2 class="h2"><?php echo esc_html($about_title); ?></h2>
    <div class="divider light" aria-hidden="true"></div>
    <p><?php echo wp_kses_post(nl2br(esc_html($about_body))); ?></p>
    <a class="btn-outline" href="#services"><?php echo esc_html($about_btn); ?></a>
  </div>
</section>

<section class="section section--white" aria-label="Services">
  <span class="anchor" id="services"></span>
  <div class="wrap">
    <h2 class="h2"><?php echo esc_html($services_title); ?></h2>
    <div class="divider dark" aria-hidden="true"></div>

    <div class="services-grid" role="list">
      <div class="service-card" role="listitem">
        <svg class="service-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M2 9l10-5 10 5-10 5-10-5z"/>
          <path d="M6 12v4a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-4"/>
          <path d="M22 9v5"/>
        </svg>
        <h3>Presstronic Academy<br><span class="service-status">In Development</span></h3>
        <p>Presstronic Academy is an interactive learning platform where developers sharpen their craft through a branching, story-driven adventure. Every decision shapes the path with hands-on coding, narrative challenges, and meaningful progression.</p>
        <div class="service-cta"><span class="btn btn--ghost btn--small">Coming Soon</span></div>
      </div>

      <div class="service-card" role="listitem">
        <svg class="service-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M3 7h18"/>
          <path d="M3 17h18"/>
          <path d="M7 7v10"/>
          <path d="M12 7v10"/>
          <path d="M17 7v10"/>
        </svg>
        <h3>Station<br><span class="service-status">In Development</span></h3>
        <p>Station is a full-stack portal for managing gaming guilds and organizations, with member tools, secure data handling, and robust services. Built for cloud orchestration, scaling, and CI/CD, it is powerful and scalable.</p>
        <div class="service-cta"><span class="btn btn--ghost btn--small">Coming Soon</span></div>
      </div>

      <div class="service-card" role="listitem">
        <svg class="service-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M12 2s-5 3-5 8a5 5 0 0 0 10 0c0-5-5-8-5-8z"/>
          <path d="M12 12a2 2 0 0 0 2-2"/>
        </svg>
        <h3>Kalsumed<br><span class="service-status">In Development</span></h3>
        <p>Kalsumed is an application built to track user daily food intake (Kilocalorie Consumed is where the name came from). Eventually, it will use a third-party API and focused AI tooling to lighten the burden of food and portion recognition via photos.</p>
        <div class="service-cta"><span class="btn btn--ghost btn--small">Coming Soon</span></div>
      </div>

      <div class="service-card" role="listitem">
        <svg class="service-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <rect x="3" y="4" width="18" height="12" rx="2"/>
          <path d="M8 20h8"/>
          <path d="M12 16v4"/>
        </svg>
        <h3>Vulntronic Labs<br><span class="service-status">In Development</span></h3>
        <p>A one-stop Docker lab of intentionally vulnerable web apps and APIs (DVWA, Juice Shop, Mutillidae, VAmPI, crAPI, etc.) for safe web and API hacking practice.</p>
        <div class="service-cta"><span class="btn btn--ghost btn--small">Coming Soon</span></div>
      </div>
    </div>
  </div>
</section>

<section class="section section--dark" aria-label="Contact">
  <span class="anchor" id="contact"></span>
  <div class="wrap">
    <h2 class="h2"><?php echo esc_html($contact_title); ?></h2>
    <div class="divider" aria-hidden="true"></div>
    <p><?php echo wp_kses_post(nl2br(esc_html($contact_body))); ?></p>

  </div>
</section>

<?php get_footer(); ?>
