<?php
	function redirect($controller, $action = 'index') {
		if (empty($action)) {
			$action = 'index';
		}

		header('Location: ?controller='.$controller.'&action='.$action);
	}

	function call($controller, $action = 'index') {
		if (empty($action)) {
			$action = 'index';
		}

		require_once 'controllers/'.$controller.'_controller.php';

		switch ($controller) {
			case 'pages':
				$controller = new PagesController();
			break;
	  
			case 'accounts':
				require_once('models/account.php');
				$controller = new AccountsController();
			break;
		}

		$controller->{ $action }();
	}

	$controllers = array('pages'
							=> [
								'index', 
								'error'
								],

					   'accounts' 
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
		call('pages', 'error');
	}
?>