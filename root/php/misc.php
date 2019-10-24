<?php
/*
 * This file is a part of the second concept of website 
 * for the Las Pegasus Radio project.
 * It's licensed under the GNU AGPLv3-only license.
 * https://github.com/tlpr/www-concept-deux
 */

// Function used to redirect users from imported unusable files
// to /index.php
function RedirectToIndex ()
{
	
	$CurrentAddress .= (
		(@$_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://');
	$CurrentAddress .= $_SERVER['HTTP_HOST'];
	
	header("Location: $CurrentAddress", true, 301);
	exit();
}


// Localization loaded if not found in request headers.
define('DEFAULT_LANGUAGE', 'en');

// Source code URL.
define('SOURCE_CODE', 'https://github.com/tlpr/www-concept-deux');

