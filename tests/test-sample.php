<?php
class Presstronic_Legacy_Theme_Test extends WP_UnitTestCase {
  public function test_theme_is_active() {
    $this->assertSame( 'presstronic-legacy', get_stylesheet() );
  }
}
