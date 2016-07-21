<?php
	class HomeController {
		
		public function index() {
			require_once('views/pages/index.php');
		}

		public function error() {
			$message = "Oops une erreur est survenue ...";
			
			if (isset($_GET['id']) && !empty($_GET['id'])) {
				$message = ErrorUtil::getErrorMessage($_GET['id']);
			}
			
			require_once('views/pages/error.php');
		}
	}
