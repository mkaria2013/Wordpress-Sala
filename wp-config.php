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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sala' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'ZX-mswen%VX=Fer09n#8(^g]~xRT@a1NgwU8_/h m hO>DAhV.Ri[<&0?[18=hTW' );
define( 'SECURE_AUTH_KEY',  'W@fVPp6[#]i{t4%NW%[q2/vs$~*qy;3M3ZW2 qG)9YRB# DGgcPn.Hn,fbKT_QAp' );
define( 'LOGGED_IN_KEY',    '6.AD,>7&`6_2%mZT11G~Z,lu]Cm0/nQkx88/PGtRNd|o-ITRag*0__6wg>5}V`Y}' );
define( 'NONCE_KEY',        ':JHgW%|hqp~%bFk}J}En>, iO0MfQB9T4b1O_j3hP2ZR2D2~n{esBKAid$^5jK!Q' );
define( 'AUTH_SALT',        'Wfl1tZFc%[)p6A2K4S>b!h[]dH6Yy;Y{?k5YXpC9~jrL(%E}mE&XZH|n+,zXQEiB' );
define( 'SECURE_AUTH_SALT', 'xAkOYs0PUU[Y@Lnjuh)lP^m62qN/f~x33w@;#({R2k &kA&/W;DCq^%9}9%,X9=d' );
define( 'LOGGED_IN_SALT',   'b^-ju:hFsaC8v6(4[- SK|4D)k0[*o),q<HG/DAHbL(7!k4X/h!rkVWmkWMn7GQD' );
define( 'NONCE_SALT',       'HSKQZ5OcKKlzn2c&C[F-ro)mu5WdwyjuA~q_7ZHq8q5Ul;yDmV7xJUmP8@9h;u`:' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
