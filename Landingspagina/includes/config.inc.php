<?php

	$lang = 'en';
		
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
	define('DB_NAME', 'rekentool');
	
	define('SITE_NAME', 'Wijverdienenmeer.nl');
	define('SITE_EMAIL', 'no-reply@wijverdienenmeer.nl');
	define('SITE_CONTACT', 'info@wijverdienenmeer.nl');
	define('SITE_URL', 'http://www.dev.oetzie.nl/rekentool/');
	
	define('LANG', strtolower(isset($_GET['lang']) ? $_GET['lang'] : $lang));

?>