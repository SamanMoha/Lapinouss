<?php
	function redirect($controller, $action = 'index', $key = '', $value = '', $anchor = '') {
		if (empty($action)) {
			$action = 'index';
		}

		if (!empty($key) && !empty($value)) {
			if (!empty($anchor)) {
				header('Location: ' . action($controller, $action, $key, $value, $anchor));
			}
			else {
				header('Location: ' . action($controller, $action, $key, $value));
			}
		}
		else if (!empty($key)) {
			if (!empty($anchor)) {
				header('Location: ' . action($controller, $action, $key, '', $anchor));
			}
			else {
				header('Location: ' . action($controller, $action, $key));
			}
		}
		else if (!empty($anchor)) {
			header('Location: ' . action($controller, $action, '', '', $anchor));
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
			'index',
			'conditions'
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
			'children',
			'deleteChild'
		],

		'game'
		=> [
			'index',
			'store',
			'games',
			'play',
			'played',
			'buy',
			'delete',
			'setting',
			'stats',
			'comments',
			'detail'
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