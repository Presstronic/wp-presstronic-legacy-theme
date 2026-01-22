#!/usr/bin/env bash
set -euo pipefail

DB_NAME=${1:-wordpress_test}
DB_USER=${2:-root}
DB_PASS=${3:-}
DB_HOST=${4:-localhost}
WP_VERSION=${5:-latest}
SKIP_DB_CREATE=${6:-}

WP_TESTS_DIR=${WP_TESTS_DIR:-/tmp/wordpress-tests-lib}
WP_CORE_DIR=${WP_CORE_DIR:-/tmp/wordpress}

if [ "$WP_VERSION" = "latest" ]; then
  WP_VERSION=trunk
fi

download() {
  if command -v curl >/dev/null 2>&1; then
    curl -sS "$1" -o "$2"
  elif command -v wget >/dev/null 2>&1; then
    wget -qO "$2" "$1"
  else
    echo "curl or wget required" >&2
    exit 1
  fi
}

install_wp() {
  mkdir -p "$WP_CORE_DIR"
  if [ ! -f "$WP_CORE_DIR/wp-load.php" ]; then
    if [ "$WP_VERSION" = "trunk" ]; then
      download https://wordpress.org/latest.tar.gz /tmp/wordpress.tar.gz
    else
      download "https://wordpress.org/wordpress-${WP_VERSION}.tar.gz" /tmp/wordpress.tar.gz
    fi
    tar --strip-components=1 -zxmf /tmp/wordpress.tar.gz -C "$WP_CORE_DIR"
  fi
}

install_test_suite() {
  local svn_url="https://develop.svn.wordpress.org/${WP_VERSION}"
  mkdir -p "$WP_TESTS_DIR"

  if [ ! -d "$WP_TESTS_DIR/includes" ]; then
    svn export --quiet --force "$svn_url/tests/phpunit/includes/" "$WP_TESTS_DIR/includes"
  fi

  if [ ! -d "$WP_TESTS_DIR/data" ]; then
    svn export --quiet --force "$svn_url/tests/phpunit/data/" "$WP_TESTS_DIR/data"
  fi

  if [ ! -f "$WP_TESTS_DIR/wp-tests-config.php" ]; then
    download "$svn_url/wp-tests-config-sample.php" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i.bak "s/youremptytestdbnamehere/$DB_NAME/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i.bak "s/yourusernamehere/$DB_USER/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i.bak "s/yourpasswordhere/$DB_PASS/" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i.bak "s|localhost|$DB_HOST|" "$WP_TESTS_DIR/wp-tests-config.php"
    sed -i.bak "s|define( 'ABSPATH'.*|define( 'ABSPATH', '$WP_CORE_DIR/' );|" "$WP_TESTS_DIR/wp-tests-config.php"
  fi
}

install_db() {
  if [ -z "$SKIP_DB_CREATE" ]; then
    mysqladmin -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" drop "$DB_NAME" --force || true
    mysqladmin -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" create "$DB_NAME"
  fi
}

install_wp
install_test_suite
install_db
