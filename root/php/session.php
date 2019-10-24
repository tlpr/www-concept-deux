<?php
/*
 * This file is a part of the second concept of website 
 * for the Las Pegasus Radio project.
 * It's licensed under the GNU AGPLv3-only license.
 * https://github.com/tlpr/www-concept-deux
 */


session_start();
define( 'SESSION_LOGGED_IN', (@$_SESSION['USER_IN'] == 1) );


function LogIn()
{
	
	$_SESSION['USER_IN'] = 1;
	
}


function LogOut()
{
	
	$_SESSION['USER_IN'] = 0;
	unset($_SESSION['USER_ID']);
	unset($_SESSION['USER_NAME']);
	session_destroy();
	
}

