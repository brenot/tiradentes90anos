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
define('DB_NAME', '90anos');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '<53ba_cWM@T292$');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD','direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|<a$y4Z||R/B!{<+-ibz?#=nB2@S~Fs)@~e&}#5+wpR1*58K)J-DDtZ%2%sgHWV2');
define('SECURE_AUTH_KEY',  'mx/q{wW`[jZ>JN$MB>Q$,28IPazmsI~V0F][-9SsQZDAqusKB+fBY467MQ>%PpN3');
define('LOGGED_IN_KEY',    'Y8!h T*6D]v0%Sut0S%|kc>RR):g?Db~q6vyr+!~WY@JKz;qJ=mAJp:L]?EM]o =');
define('NONCE_KEY',        ':QzB}R5CnJ?+bLydt?VHhN1MvU3H%|x9;P[%1iCh>`mq;/ 1FYBg>[`[fZwg@mSW');
define('AUTH_SALT',        '<AmLnsS,s(C+|FCoRRd=.xZZLaWUPi!1RUxdWZUJ:Spdg+ZNugM$Vr%Rp,caB|^0');
define('SECURE_AUTH_SALT', 'CBou3bPw/0RO+]x2TqNI|>5IX#O+k#NZ%fc0?tD!^-qHx6r%HTP2]L*H:2|zL^s~');
define('LOGGED_IN_SALT',   '<%],ge{xk>Wh(W!fALAfDUa8|FeVOb}ma-w?[)g>D3,X`br|m/E?jX2kTOjDu~WZ');
define('NONCE_SALT',       'V`@&6z{<o0eR0.J;%h|]Oh`.L#M+XL/MZA ?)q|&.U2BquP^U;N:uIBX/.tv|+kY');

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
