<?php
/**
 * Sidebar template.
 *
 * @package presstronic-legacy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
