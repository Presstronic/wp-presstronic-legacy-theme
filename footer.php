<?php
/**
 * Site footer.
 *
 * @package presstronic-legacy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$privacy_url = '';
if ( function_exists( 'get_privacy_policy_url' ) ) {
	$privacy_url = get_privacy_policy_url();
}
if ( empty( $privacy_url ) ) {
	$privacy_url = home_url( '/privacy-policy/' );
}
$copyright_year = gmdate( 'Y' );
?>

<footer class="site-footer" role="contentinfo">
	<div class="wrap">
		<p class="footer-brand"><?php echo esc_html( 'Presstronic LLC' ); ?></p>
		<div class="footer-links">
			<a href="<?php echo esc_url( $privacy_url ); ?>">Privacy Policy</a>
			<a href="https://bsky.app/profile/presstronic.bsky.social" rel="me noopener" target="_blank">Blue Sky</a>
			<a href="https://x.com/Presstronic" rel="me noopener" target="_blank">Twitter</a>
		</div>
		<p class="footer-meta"><?php echo esc_html( '© ' . $copyright_year . ' Presstronic LLC' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
