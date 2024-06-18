<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'registro-de-asistencia-wordpres' );

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

define('FS_METHOD', 'direct');


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
define( 'AUTH_KEY',         'RvETc1DnV9lnCExqw0j7L5sVGURGAHB5Ifwq8Ga6R6AsZszXxgLr5ddDvfePKxmN' );
define( 'SECURE_AUTH_KEY',  'ABFchb305BXW8uZVndp5N3gvJvT98zNsjFDnnLDNtZJZuB7rbdijmqBNSCDdCnql' );
define( 'LOGGED_IN_KEY',    '2fBRMwQ2J040FmlOaCxHw9MnhRUmzCYjbJUG6nop4FangSLQowZTsmOL37tuiI1f' );
define( 'NONCE_KEY',        'VjFAgAj4cy3hMwd4J8XSrk85kgCgOIa4f4fJJ72QFIqlgBy3GzqCdJk4S4AChUnz' );
define( 'AUTH_SALT',        'ugYxmwvM5JHRqgvrk0iZKVZnxaKO5z1OL4l82tyWgOX1HVIUEhI7X8hr2gT4I9vZ' );
define( 'SECURE_AUTH_SALT', 'bxEM434kawVP9TJjJNQzD1d6qB1F9ewtWZfyUCQxRmzYNjnhmnBulXZf0cGETgaV' );
define( 'LOGGED_IN_SALT',   'fLqRwkJqUcSW79LGxl3Bhzu5jHDuEl4Q5KBbw2rzubrMTSy5kFhzF0XjdkUJi4to' );
define( 'NONCE_SALT',       'ChCDZ6QBarK1Mz8iRWKkoSFCR046HtfsknZY7PYO9Avj06v5Fsqq7YOUKLjIz6E9' );

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
