<?php
if ( ! defined('ABSPATH') ) { exit; }
get_header();
?>
<main id="main-content" class="content">
  <div class="wrap">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <p style="opacity:.65;margin-top:-8px;"><?php echo esc_html(get_the_date()); ?></p>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </div>
</main>
<?php get_footer(); ?>
