<!DOCTYPE html>

<?php

/*
 * This file is a part of the second concept of website 
 * for the Las Pegasus Radio project.
 * It's licensed under the GNU AGPLv3-only license.
 * https://github.com/tlpr/www-concept-deux
 */

require_once('php/misc.php');
require_once('php/localization.php');
require_once('php/api.php');
require_once('php/session.php');

LoadLocalization();
$api = new ApiFront;
$api->ValidateCredentials('finn', 'testing123');

?>

<html lang="<?= L10N_LANGCODE ?>">

	<head>
		<meta charset="UTF-8">
		<meta name="author" content="<?= L10N_META_AUTHOR ?>">
		<title><?= L10N_BRAND ?> &mdash; <?= L10N_INDEX_TITLE ?></title>
		<link rel="stylesheet" type="text/css" media="all" href="css/style.css">
		<script type="text/javascript" src="js/nowplaying.js"></script>
	</head>
	
	<body>
		
		<div class="topbar">
			<a href="."><div id="logo"></div></a>
			<div class="navigation">
				<a href="."><?= L10N_NAV_INDEX ?></a>
				<a href="about.php"><?= L10N_NAV_ABOUT ?></a>
				<a href="schedule.php"><?= L10N_NAV_SCHEDULE ?></a>
				<a href="chat.php"><?= L10N_NAV_IRC ?></a>
				<a href="community.php"><?= L10N_NAV_COMMUNITY ?></a>
				<a href="contact.php"><?= L10N_NAV_CONTACT ?></a>
				<hr>
				<? IF ( SESSION_LOGGED_IN ): ?>
				<a href="user/logout.php"><?= L10N_NAV_LOGOUT ?></a>
				<? ELSE: ?>
				<a href="user/login.php"><?= L10N_NAV_LOGIN ?></a>
				<a href="user/new.php"><?= L10N_NAV_REGISTER ?></a>
				<? ENDIF; ?>
				<a href="user/"><?= L10N_NAV_USERLAND ?></a>
			</div>
		</div>
		
		<div class="playerbar">
			<div class="nowplaying">
				<?= L10N_NAV_PLAYING ?>
				<span id="nowplaying">
					<noscript><?= L10N_NAV_PLAYING_NOSCRIPT ?></noscript>
				</span>
			</div>
		</div>
		
	</body>

</html>
