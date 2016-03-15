<?php
	function call($controller, $action) {
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
								'signin', 
								'signup'
								]
					);

	if (array_key_exists($controller, $controllers)
		&& in_array($action, $controllers[$controller])) {
		call($controller, $action);
	}
	else {
		call('pages', 'error');
	}
?>