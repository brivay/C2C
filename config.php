<?php

// error messages to be displayed in the browser. This is good for debugging, but it should be set to false on a live site since it can be a security risk.
ini_set( "display_errors", true );

// As our CMS will use PHP's date() function, we need to tell PHP our server's timezone (otherwise PHP generates a warning message).
date_default_timezone_set( "America/New_York" );

$DB_HOST = "localhost"; 
$DB_NAME = "C2C";
$DB_USERNAME = "root";
$DB_PASSWORD = "Genesee1!";
// $TEMPLATE_PATH = "templates";     //where script should look for HTML template files
$ADMIN_USERNAME = "briannaevay@gmail.com";
$ADMIN_PASSWORD = "Genesee1!";
 
require_once ( "classes/Resource.php" );

// function handleException ($exception) {
// 	echo "Sorry, a problem occurred. Please try later";
// 	error_log ($exception->getMessage() );
// 	// he function displays a generic error message, and logs the actual exception message to the web server's error log.
// }

// // Once we've defined handleException(), we set it as the exception handler by calling PHP's set_exception_handler() function.
// set_exception_handler ( 'handleException' );

?>

<!-- SECURITY NOTE
In a live server environment it'd be a good idea to place config.php somewhere outside your website's document root, since it contains usernames and passwords. While it's not usually possible to read the source code of a PHP script via the browser, it does happen sometimes if the web server is misconfigured. 

You could also use hash() to make a hash from your admin password, and store the hash in config.php instead of the plaintext password. Then, at login time, you can hash() the entered password and see if it matches the hash in config.php.

-->