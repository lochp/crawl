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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'crawl');

/** MySQL database username */
define('DB_USER', 'locmysql');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'q_,tZk8S;)<{tj{%NDcYf?yNr^`IVzdBgh!8j{Qm!6T|N(1{EJT{`pYmtmy!|khJ');
define('SECURE_AUTH_KEY',  'PU0Rg2`e/0kO5+s#$9gz)duzt%%I*PZ7?379y_q(e=RSc;>(x7U2:JH:]!b]:8s$');
define('LOGGED_IN_KEY',    'uY/ZE8}?h-<3s$,G;6Ix{f?N*+Y~80gT,_/a#<iCbAj^[7}V4X#v]$={41,fL!i<');
define('NONCE_KEY',        ';h)hE+=YKQhC&z`j-S9~y`s.Pt,tZ$hgxPMgxw;}B?2TeH}H@CtC2-4{x>zp3l}n');
define('AUTH_SALT',        'k?#C95LrFPn&;G8c9$E(.{c!{.$<W8SspZ*vFxz;>&&cG@YucW?QiO.}rEx3 Kg/');
define('SECURE_AUTH_SALT', 'QS>ND+X <1qq:v.LA^hWn|&KFE)vpx9A24y%uf^oFoU43{6)0VPw6C&/^M:2TFY&');
define('LOGGED_IN_SALT',   'y_au23[}t:8sjUTO(B;M%l(Igk/v(vMe7oPEr%X0%%4/p0 zbY.@4?^A^m@pQJ{z');
define('NONCE_SALT',       'C3;$N[)R){CF9QY;v!3__:^x$]z_z*!4L@&xB!Y_1tCzcsOlmth_*g<}yBy-&%3M');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
