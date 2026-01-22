<?php
/**
 * Main index template.
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
				<article <?php post_class(); ?> style="margin-bottom:32px;">
					<h2 style="margin-bottom:8px;">
						<a href="<?php echo esc_url( get_permalink() ); ?>" style="text-decoration:none;color:inherit;">
							<?php the_title(); ?>
						</a>
					</h2>
					<div style="opacity:.7;font-size:14px;"><?php echo esc_html( get_the_date() ); ?></div>
					<div class="entry-content" style="margin-top:10px;">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>

			<nav class="pagination">
				<?php the_posts_pagination(); ?>
			</nav>
		<?php else : ?>
			<p><?php esc_html_e( 'No posts found.', 'presstronic-legacy' ); ?></p>
		<?php endif; ?>
		<?php get_sidebar(); ?>
	</div>
</main>
<?php get_footer(); ?>
