<?php
	function redirect($controller, $action = 'index', $id = '', $anchor = '') {
		if (empty($action)) {
			$action = 'index';
		}

		if (!empty($id)) {
			if (!empty($anchor)) {
				header('Location: ' . action($controller, $action, $id, $anchor));
			}
			else {
				header('Location: ' . action($controller, $action, $id));
			}
		}
		else if (empty($id) && !empty($anchor)) {
			header('Location: ' . action($controller, $action, 0, $anchor));
		}
		else {
			header('Location: ' . action($controller, $action));
		}
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
				$controller = new AccountController();
				break;

			case 'contact':
				$controller = new ContactController();
				break;

			case 'tutorial':
				$controller = new TutorialController();
				break;

			case 'game':
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
			'registerChild',
			'logout',
			'existsParent',
			'children'
		],

		'game'
		=> [
			'index',
			'store',
			'play'
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