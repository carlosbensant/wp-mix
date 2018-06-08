<?php


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
  include(dirname(__FILE__) . '/local-config.php');
}

// If not include global DB configuration
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if (!defined('DB_NAME')){
  define('DB_NAME', '');
}

/** MySQL database username */
if (!defined('DB_USER')) {
  define('DB_USER', '');
}

/** MySQL database password */
if (!defined('DB_PASSWORD')) {
  define('DB_PASSWORD', '');
}

/** MySQL hostname */
if (!defined('DB_HOST')) {
  define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
  define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
  define('DB_COLLATE', '');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'v(QM%b9?c%1*M!+D[&F_q$jli3QT,P=}h<g|]edV@^aJ MuxRR)m@ILN[!eAZ>av');
define('SECURE_AUTH_KEY',  'S<L`P|W*zZ_-ITYTMQcb{2ep{>+99M#C8jx++y$IG>PR`*oY?4G5#_LW+`czSpEy');
define('LOGGED_IN_KEY',    'q*;{3IKqD;X*)&/X[_(iV1EC*W.rV|JL|_<x~X*`d`p5QRfDj%#ep2/s+O_;3.?T');
define('NONCE_KEY',        'nnfc! }J&;!|.feM=T|n3M_ +FqGGV(bl^9QpP^JiV$N)J|bbGt(7i[M/$z9`,(p');
define('AUTH_SALT',        'lm{M0QUPANSx*@+01cH?h-+@qYX);aoKaO<EfSD,F:xO{y*7`_sfm#l|lf5[l#r<');
define('SECURE_AUTH_SALT', '7H~Rz$m`6s@Hj!c#y^m5fz:I+JM(xQrO1g#9Z4^1Rnt|}$#lQLa8}gTY-QPY}Mg{');
define('LOGGED_IN_SALT',   '~-=T+UI1x2y-O>&]7h+q2G.^?azGD B|S0br_7+{0A$5U?+6IG+o0f;+g$!J(gyt');
define('NONCE_SALT',       '=-qy+kRhzpr.qPq<S)A,@CTm%jS<_Udf1<zT4s?2(5Y^3E9D? b$=og[rGd Gw||');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * Set custom wordpress paths
 *
 * These are required because WordPress is installed in a subdirectory.
 *
 */

if (!defined('WP_SITEURL')) {
  define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/cms');
}

if (!defined('WP_HOME')) {
  define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
}

if (!defined('WP_CONTENT_DIR')) {
  define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
}

if (!defined('WP_CONTENT_URL')) {
  define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content');
}

if (!defined('HTTP_SUCCESS')) {
  define('HTTP_SUCCESS', 200);
}

if(!defined('CDN_BASE_URL')) {
    define('CDN_BASE_URL', WP_HOME);
}


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
if (!defined('WP_DEBUG')) {
  define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
