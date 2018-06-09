<?php
define('DB_NAME', 'wp-demo');
define('DB_USER', 'mysql');
define('DB_PASSWORD', '4cc7d3e4574c4a5a');
define('DB_HOST', 'dokku-mysql-wp-demo');
define('WP_DEBUG', true);

if (!defined('WP_SITEURL')) {
    define('WP_SITEURL', 'http://wp-demo.staging.spot.com.do/cms');
}

if (!defined('WP_HOME')) {
    define('WP_HOME',    'http://wp-demo.staging.spot.com.do');
}

if (!defined('WP_CONTENT_URL')) {
    define('WP_CONTENT_URL', 'http://wp-demo.staging.spot.com.do/wp-content');
}
