<?php

	$lang = 'nl';
		
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
	define('DB_NAME', 'rekentool');
	
	define('SITE_NAME', 'Verdienbeter.nl');
	define('SITE_EMAIL', 'no-reply@verdienbeter.nl');
	define('SITE_URL', 'http://www.dev.oetzie.nl/rekentool/');
	
	define('LANG', strtolower(isset($_GET['lang']) ? $_GET['lang'] : $lang));

?>