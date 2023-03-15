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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_assignment' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'lxPCH GP Xf[x&W,Ka@X[1[<BWooI{[rn.o<p?Q4<)JPS%`<b4s5O>%W;N,%9.s&' );
define( 'SECURE_AUTH_KEY',   '3;4.z&4~5kq&bez~mAq+9phf}2&`l)1zFR)4b. Ki[eonoVK@kZ<cuLOf7L3fgIV' );
define( 'LOGGED_IN_KEY',     'Q1p$7O=lq=o>=r[:8w)sP{g!EcmN,wI~t`*66zD~)xYZQ+#w)kiloSQIG*1T=0N$' );
define( 'NONCE_KEY',         'Lfm~gk)a4@KR_ab/:i4vL7g&P^040%]Arv |A*YScF:]eZ]ib1_E-0)1Rt4?,@Y_' );
define( 'AUTH_SALT',         '=`Vd#}QtJu3A%k!;Cm`Qy:(fBO7lq#DCqzGu)956doQ1@|>]n;n-<%QI/ThRns<-' );
define( 'SECURE_AUTH_SALT',  '^Gd.(qWI(@%y$HN(71Rs;s)#(.?NNzVtDTL)gW|2.Bnl@}p,Deh ]]e+JoBr3JdO' );
define( 'LOGGED_IN_SALT',    '(r96J0aS?cWDYsoe,&@J)c(L#1hHg;_qphV/ScL>rQ3PS$/kmqTYf>ZNp>@~[C}f' );
define( 'NONCE_SALT',        '@Rk#wnrvys2OScPVG@`K~8 c5d4|Qam!+(2 -}n&-Oz3+!p?Lr#p3{|!<]StwMRG' );
define( 'WP_CACHE_KEY_SALT', '/Cq^SI~t]}pY!`U,`i]!;Ri([P9$96Y4~n~Ez~2m+#yzI`8t7iifeapM6}E6N>-8' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
