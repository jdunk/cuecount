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
define('DB_NAME', 'cuecount_wp653');

/** MySQL database username */
define('DB_USER', 'cuecount_wp653');

/** MySQL database password */
define('DB_PASSWORD', '3k-6aP6S.3');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'gc7tyjm4si6mz468nubvr5uyadxe2uh3wfbzilfrwfsfxwp4xiomyrvt2psxqwde');
define('SECURE_AUTH_KEY',  'jpogvneuapczxaal9bkf4iycfkxedfs6rgdmxxrf90uhtgomg121k2c9kwy64ltw');
define('LOGGED_IN_KEY',    '8z8xem7wojxfesl4flzsos4lcihuss8rvd0irlwpmfniulmgugo1nb5sycakvfg5');
define('NONCE_KEY',        'vyxmjm1aoiutetlyytrstdiwgtsnzfcibryoh52trdfniikjirafkrkuxznkgms4');
define('AUTH_SALT',        'osvnxfixlqjpcb01mpr6owdxeklk0gosidp1e95nmuyu8p1mrpyvmef3lyiy2jdi');
define('SECURE_AUTH_SALT', 'qjt4vqnlodxf9lufwgsviopr7vlyjzaue8xyihvmnyf5dujfhwsnneg5n7rdmjtu');
define('LOGGED_IN_SALT',   'ebv1xvsijntlnbrlb5bfrakcjemi8lu8r1xf5robg17qj4biefcdjnyepjqzmbtg');
define('NONCE_SALT',       'jpyzpxc56upekf9gql45bo1nbihqz21hc3pdhpfrcvqsas5ssnwmecirszbp1na9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpso_';

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
define( 'WP_MEMORY_LIMIT', '128M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


