<?php
	session_start();
	
	define('BASE_PATH', '/Lapinouss/');

	require_once 'common/exceptions/fatal_exception.php';
	require_once 'common/exceptions/web_exception.php';

	require_once 'common/utils/session_util.php';
	require_once 'common/utils/date_util.php';
	require_once 'common/utils/data_util.php';

	function action($controller, $action = 'index') {
		if (empty($action)) {
			$action = 'index';
		}
		
		if ($action == 'index') {
			return BASE_PATH . $controller;
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
