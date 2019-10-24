<?php
/*
 * This file is a part of the second concept of website 
 * for the Las Pegasus Radio project.
 * It's licensed under the GNU AGPLv3-only license.
 * https://github.com/tlpr/www-concept-deux
 */

function InitLang()
{
	
	// Common
	define('L10N_LANGCODE', 'en');
	define('L10N_BRAND', 'Las Pegasus Radio');
	define('L10N_DESC_SHORT', 'Your favorite radio station.');
	define('L10N_DESC_LONG', '! TO DO !');
	define('L10N_META_AUTHOR', 'Finn Lis (finn at netc.pl)');
	
	// Navbar
	define('L10N_NAV_INDEX', 'News');
	define('L10N_NAV_ABOUT', 'About');
	define('L10N_NAV_SCHEDULE', 'Schedule');
	define('L10N_NAV_IRC', 'Chat');
	define('L10N_NAV_COMMUNITY', 'Community');
	define('L10N_NAV_CONTACT', 'Contact');
	
	define('L10N_NAV_LOGIN', 'Log in');
	define('L10N_NAV_LOGOUT', 'Log out');
	define('L10N_NAV_REGISTER', 'Register');
	define('L10N_NAV_USERLAND', 'User Land');
	
	// Player bar
	define('L10N_NAV_PLAYING', 'Now playing:');
	define('L10N_NAV_LISTEN', 'Listen Now!');
	define('L10N_NAV_REQUEST', 'Request song');
	define('L10N_NAV_PLAYING_NOSCRIPT', 'Cannot retrieve song title'.
		' without JavaScript.');
	
	// index.php
	define('L10N_INDEX_TITLE', 'News, main page');
	
}
