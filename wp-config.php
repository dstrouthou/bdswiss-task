<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bdswiss-db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h,nI^uynuZWBIuRvXhh;FPEB9L8p2%B4I;u*]:g*?NhP3Cl1s#~0ngl=S38:B-*=' );
define( 'SECURE_AUTH_KEY',  '*e*h<te50m3`Sa1vm} V2g=/ qtGZwW|<6Y!h:pa*?)KW)ok41LK|_?oj.Ea:[gc' );
define( 'LOGGED_IN_KEY',    '3unPpJm[EvgyCw;&Y&tm.EBx<m4eobnG]5x=;)p:Vt)YbU Vsr;&YA4Ei65lS&}V' );
define( 'NONCE_KEY',        'Q4n[yyhu3ZW z5.bO!?~GF;|trVXscCcS~5?GT|sfwu]VOef/.GO^XR@{;KnDZ7%' );
define( 'AUTH_SALT',        'jLAABT?;t=nphm*X+bvh=JT-4+;g.hFP}wbFfA;1b:]@sK>ebTOr*Yk<DUR6%o/m' );
define( 'SECURE_AUTH_SALT', 'JK]NUw+c_sN${CR<wv85cgu{8]tZoKQ8S$z}PIR|=_K9b}defJ(7KU;zt4/@Joj?' );
define( 'LOGGED_IN_SALT',   '9R!0gd+@JwZ?e@6>-Qqk@kd gg,s^^MOr~^>(zFH.+;]Sx+ety?&K69F`6/YU k ' );
define( 'NONCE_SALT',       ',W&hsn0OXwt0/GK7{)L<7qnQH]$Dg?f6pWNZe51}k$qbHQAfD5LP{DEpv1, CexD' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
