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
define( 'DB_NAME', 'wordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'wordpress_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'my_password' );

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
define( 'AUTH_KEY',         'fJJp:@7&jJ58Hb4[dD/&sK1E+C,BS0j$FG!5u]IOO/chyklo~a|nFew*XC*o]G:P' );
define( 'SECURE_AUTH_KEY',  '!VL}]%@/eS/o_l7,iX2B0}1B8[x0zS{kq@cuHBb!%IXgZyNp{8~uit3`|h~7.j< ' );
define( 'LOGGED_IN_KEY',    'N(M)Z]zY 3x}%2E#%QG%T5t`K_~a9r>)p):`a5}_WX]#aQuQ!7[Z0Ch)[as>xf!+' );
define( 'NONCE_KEY',        'WKw[7wxR@.BfK2q]ldDui7vqV_hQi}oBE!6(}UXdT`}Lizvq9U-MKKD2wN&yb54d' );
define( 'AUTH_SALT',        ';%~P;H(|-fGKBfGLhm%)hb*R1W!,x`7x4(2@KW_^_CYJs 2]8glM=V;SEd)1}PE(' );
define( 'SECURE_AUTH_SALT', 'NB.>OppsFd[fobp*-SSJ)%ah7Oh7]( m=Srxxwk[r>f`$ve]{%_*kv/sW51K(}lx' );
define( 'LOGGED_IN_SALT',   '~8:U5m?Ekwg(S46U#5DUXiJE(UUp:EV~nQV-vp+<GXl<Jm+^J9D^gDs80yZA~ML(' );
define( 'NONCE_SALT',       '0W^Zu)ey46,V$fd|aBW#.5_{y^[:U =0N B.xaJu!a?VFRIl[hx1BmX+w|qf#/a`' );

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

define ('FS_METHOD','direct');
