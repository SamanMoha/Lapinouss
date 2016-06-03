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
				require_once('models/child_account.php');
				$controller = new AccountController();
				break;

			case 'contact':
				$controller = new ContactController();
				break;

			case 'tutorial':
				$controller = new TutorialController();
				break;

			case 'game':
				require_once('models/game.php');
				$controller = new GameController();
				break;
		}

		$controller->{ $action }();
	}

	$controllers = array(
		'home'
		=> [
			'index',
			'error'
		],

		'contact'
		=> [
			'index'
		],

		'tutorial'
		=> [
			'index'
		],

		'account'
		=> [
			'index',
			'login',
			'register',
			'logout'
		],

		'game'
		=> [
			'index',
			'store'
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