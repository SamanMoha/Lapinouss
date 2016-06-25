	<?php
	require_once 'models/account.php';
	require_once 'models/child_account.php';
	require_once 'models/comment.php';
	require_once 'models/criteria.php';
	require_once 'models/downloaded_game_type.php';
	require_once 'models/game.php';
	require_once 'models/game_has_trophy.php';
	require_once 'models/game_type.php';
	require_once 'models/parent_has_child.php';
	require_once 'models/played.php';
	require_once 'models/success.php';
	require_once 'models/trophy.php';

	session_start();
	
	define('BASE_PATH', '/Lapinouss/');

	require_once 'common/exceptions/fatal_exception.php';
	require_once 'common/exceptions/web_exception.php';

	require_once 'common/utils/session_util.php';
	require_once 'common/utils/date_util.php';
	require_once 'common/utils/data_util.php';

	function action($controller, $action = 'index', $id = null) {
		if (empty($action)) {
			$action = 'index';
		}

		$path = BASE_PATH . $controller;

		if ($action != 'index') {
			$path .= '/' . $action;
		}

		if ($id != null) {
			$path .=  '/' . $id;
		}
		
		return $path;
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