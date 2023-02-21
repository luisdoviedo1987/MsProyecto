<?php
/** Enable W3 Total Cache */
define( 'WP_CACHE', true ); // Added by WP Rocket
/**define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.*/
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
define('DB_NAME', "msnet_2020");

/** MySQL database username */
define('DB_USER', "msnet_2020");

/** MySQL database password */
define('DB_PASSWORD', "MediSmart2020");

/** MySQL hostname */
define('DB_HOST', "10.132.226.152");

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
define('AUTH_KEY',         'yxlOQddSWp0Z!fNuhj!owcjStw25(4V5H3QqJv6GpcFCb8I5ypxcQgx(7PlBQztd');
define('SECURE_AUTH_KEY',  'wuUvu8z@I^ZtteAyOCGmcW!B^lQF^m5jr(0i2^PmzeJOKuEiAek0N1i8Fdz*nJVK');
define('LOGGED_IN_KEY',    'p!v#Jt^VBWlp07L7d#2DtO0tTmX8qT!JaJl5v@@!tKa9jDHx3vR(xAE(Shnx#3ah');
define('NONCE_KEY',        'o@DNRBEOLpoM#%2fHAQbIHSGIJ@4*0DO78O5sWq&CXD*2OMru&jpHhRFi1H(Hlij');
define('AUTH_SALT',        'SZ^huGpY7UGX^Wgw6lJ5QIUAmd#b)%C#B#DGmtTp(Cs*#tYaOTFDD(XZuPnHzIUm');
define('SECURE_AUTH_SALT', 'Dia*mNwUomFyeYxlRN3Qp)H&6PGCb^F%33p6!)6^BnbO!Uc!K21sPxBVWr3veqUs');
define('LOGGED_IN_SALT',   'FZkA@AtKbgmujZoWP#6ZZE2#eOc6RuOgWD@1OK5gd#O#42wIVfxWe(WG6Sxy1bru');
define('NONCE_SALT',       'dMh0bH#uPRXIuO!e4w!v*rgfG3*mSR3Wg#(yVswqJyeq1eieOtdb(scikrOVI9CK');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dkoal_';

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
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_time', '300' );

// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings 
define('WP_DEBUG_DISPLAY', true);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);

define('WP_DEBUG', true);

error_reporting(E_ALL);



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define ('FS_METHOD', 'direct');
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);
define('ALLOW_UNFILTERED_UPLOADS', true);

