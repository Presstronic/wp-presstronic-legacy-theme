<?php
/**
 * Single post template.
 *
 * @package presstronic-legacy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main-content" class="content">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail( 'large' ); ?>
						</div>
					<?php endif; ?>
					<h1><?php the_title(); ?></h1>
					<p class="post-date"><?php echo esc_html( get_the_date() ); ?></p>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'presstronic-legacy' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>
					<?php if ( has_tag() ) : ?>
						<p class="post-tags"><?php the_tags( '', ', ', '' ); ?></p>
					<?php endif; ?>
				</article>
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
