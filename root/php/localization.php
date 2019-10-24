<?php
/*
 * This file is a part of the second concept of website 
 * for the Las Pegasus Radio project.
 * It's licensed under the GNU AGPLv3-only license.
 * https://github.com/tlpr/www-concept-deux
 */


function ObtainLocaleDirectory ()
{
	
	// Get running script, not executing one.
	$ScriptDirectory = realpath(
		dirname(__FILE__));
	
	return $ScriptDirectory . DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'locale';
	
}

// requires: short locale code/file name without extension
// returns none, but creates a constant with localization array
function LoadLocalization ()
{
	
	$LocaleDir = ObtainLocaleDirectory();
	
	$UsedLanguage = DEFAULT_LANGUAGE;
	$UserLanguages = ReadHeader();
	
	$AvailableLanguages = array_diff(
		scandir($LocaleDir), array('.', '..'));
	
	for ($i = 0; $i < sizeof($UserLanguages); $i++)
	{
		if ( in_array($UserLanguages[$i], $AvailableLanguages) )
		{
			$UsedLanguage = $UserLanguages[$i];
			break;
		}
	}

	$FileToLoad = $LocaleDir .DIRECTORY_SEPARATOR ."$UsedLanguage.php";
	
	if ( !file_exists($FileToLoad) )
		die('Fatal error: Localization file unreadable.');
	
	require_once($FileToLoad);
	InitLang();
	
	if ( !defined('L10N_LANGCODE') )
		die('Fatal error: Missing language constants.');
	
}

// requires none, returns an array of requested
// languages as defined in AcceptLanguage HTTP header.
function ReadHeader ()
{
	
	$AcceptLanguage = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	if ( !$AcceptLanguage ) return array('en');
	
	$UserLanguages = explode(';', $AcceptLanguage, 16);
	
	return $UserLanguages;
	
}
