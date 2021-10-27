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
define( 'DB_NAME', 'bdswiss_test' );

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
define( 'AUTH_KEY',         '&o.WxtX5nAk*BWdh9s^yB6CQg_PN,GL+i&f&EyTc PCRM`x ;OQyrCXP2WKv#k9A' );
define( 'SECURE_AUTH_KEY',  'yRE}&,lk%lJYN.[ia<3Oq2!@#I4e A8>K)&l/m+]`&-Rj_.JDB)E~u@hoP;-:dp)' );
define( 'LOGGED_IN_KEY',    'pOcYb(SB:w*_@H[3ySA4aToTF4ZvPR :Lby}A_bH41H)I! 3gl#4Xbl1+3Dl-.2r' );
define( 'NONCE_KEY',        '@[JH?9zdyOY2>c95/7pUzs|es*PyP`.yv&XXI/^oP%{3kHU`rNZN].1za=VE}!SN' );
define( 'AUTH_SALT',        '`W,n7lAg*mX(>&?m|#=<#jhD.MJ;JACcWHYx`n(_h+[SzPm/#$AZ|I/tf4g;af6k' );
define( 'SECURE_AUTH_SALT', '^/ I|:p1J}#6Jv#rf~,{M^|OM23=H4R/QAF>7{(Z3;FD;$Ad22WnVp}(O#,L8lQM' );
define( 'LOGGED_IN_SALT',   'J<gww6]U*07JVH.g^aL_G@_{D6z_s?:V(fe` 2$!hG;_mYPKYc+slXHxv(N]lnQ`' );
define( 'NONCE_SALT',       'Fb^mNrff%olbx/^9a@86qDZ=L+`b+x}_+BdvBds:-lX*GytO|g_x`hOO2UH[5@a2' );

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
