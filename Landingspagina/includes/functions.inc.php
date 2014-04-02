<?php

	function escapeVars($vars = array(), $mysqli) {
		return array_map(function($value) use ($mysqli) {
			return mysqli_real_escape_string($mysqli, $value);
		}, $vars);
	}
	
	function parseUBB($content) {
		$content = preg_replace('/\[b\](.+?)\[b\]/si', '<strong>$1</strong>', $content);
		$content = preg_replace('/\[u\](.+?)\[u\]/si', '<u>$1</u>', $content);
		$content = preg_replace('/\[p\](.+?)\[p\]/si', '<p>$1</p>', $content);
		$content = preg_replace('/\[url=(.+?)\](.+?)\[url\]/si', '<a href="$1" target="_blank">$2</a>', $content);
		$content = preg_replace('/\[url\](.+?)\[url\]/si', '<a href="$1" target="_blank">$1</a>', $content);
		$content = preg_replace('/\[br\]/si', '<br />', $content);
		
		return $content;
	}
	
	function getHost() {
		$host = array(trim($_SERVER['HTTP_HOST'], '/'));
		
		$uri = array_filter(array_map(function($value) {
			return trim($value, '/');
		}, explode('/', $_SERVER['REQUEST_URI'])));
		
		foreach (array_filter(array_map(function($value) {
			return trim($value, '/');
		}, explode('/', $_SERVER['SCRIPT_NAME']))) as $key => $value) {
			if (isset($uri[$key]) && $uri[$key] == $value)  {
				$host[] = $value;	
			} else {
				break;
			}
		}
		
		return implode('/', $host).'/';
	}

?>