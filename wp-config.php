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
define( 'DB_NAME', 'rosiehouse_db' );

/** MySQL database username */
define( 'DB_USER', 'quanvh81' );

/** MySQL database password */
define( 'DB_PASSWORD', '271081' );

/** MySQL hostname */
define( 'DB_HOST', 'choxeoto.com' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'V(o#C_Df+dRN%HRdqY6/[:_Q8HTxQe:T:#p sYglxu.g{TUTp!x/QBy+!/`S88T%' );
define( 'SECURE_AUTH_KEY',  't2voJxKCKi~ h%#)4gb-y&-:RAaqwm^ESScM#O^Cac[3bm45g0uGwe-JJ;02aCOX' );
define( 'LOGGED_IN_KEY',    'mLqHdEY2(^r. mT]oHQ!jTc<$+R(O+`v,50uenFsU*?*VdmWf,W:Y??Kv/TBwucZ' );
define( 'NONCE_KEY',        'YCXkcQQ.</OpS{Fc4e&Oc7[+}xFeBH[zF1yDtwE-%M;!@Ku3</5Veawt}kvG]s7w' );
define( 'AUTH_SALT',        'xm[K%xN2WHeEA7{Vx25,,x7eS21VN2P+C5-/|Ztit{!mZNV=uI6YBo{)UD_{56s3' );
define( 'SECURE_AUTH_SALT', ')]zOHN7+Q~+Vcq5<|F.5^e3;la<Y7I|2+Aws $ujyA1x& [h-)lTzHc1x:{Xk7|9' );
define( 'LOGGED_IN_SALT',   '2Rnl-#?Qrsc]fz)P6Px^W6j=ym2{}Ov0T}zYQk74@}-RX_:c{%p%vuMaa(J+{[)E' );
define( 'NONCE_SALT',       '=sv?>X@X[&nV1v!j,X&dbQZJT13<07huxNd=,j.uTWh{ k9-wq<|+fNC!l4t w8(' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

define('WP_HOME','/');
define('WP_SITEURL','/');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
