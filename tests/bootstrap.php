<?php
$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
  $_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _presstronic_legacy_load_theme() {
  switch_theme( 'presstronic-legacy' );
}

tests_add_filter( 'setup_theme', '_presstronic_legacy_load_theme' );

require $_tests_dir . '/includes/bootstrap.php';
