<?php
	function redirect($controller, $action = 'index') {
		if (empty($action)) {
			$action = 'index';
		}

		header('Location: ' . action($controller, $action));
	}

	function call($controller, $action = 'index') {
		if (empty($action)) {
			$action = 'index';
		}

		require_once 'controllers/'.$controller.'_controller.php';

		switch ($controller) {
			case 'home':
				$controller = new HomeController();
				break;

			case 'account':
				require_once('models/account.php');
				$controller = new AccountController();
				break;
		}

		$controller->{ $action }();
	}

	$controllers = array('home'
	=> [
			'index',
			'error'
		],

		'account'
		=> [
			'index',
			'login',
			'register'
		]
	);

	if (array_key_exists($controller, $controllers)
		&& (in_array($action, $controllers[$controller])
			|| empty($action))) {
		call($controller, $action);
	}
	else {
		call('home', 'error');
	}
?>