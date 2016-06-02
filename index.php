<?php
	session_start();
	
	define('BASE_PATH', '/Lapinouss/');

	function action($controller, $action = 'index') {
		if (empty($action)) {
			$action = 'index';
		}
		
		return BASE_PATH . $controller . '/' . $action;
	}

	if (isset($_GET['controller'])) {
		$controller = $_GET['controller'];
		
		$action = isset($_GET['action'])
			? $_GET['action']
			: 'index';
	}
	else {
		
		$controller = 'home';
		$action = 'index';
	}

	require_once 'views/layout.php';
?>