<?php
	class AccountsController {
		
		public function index() {
			if (!isset($_GET['signed']))
				return call('accounts', 'signin');
			
			$account = new Account("Ismail", "NGUYEN");

			require_once('views/pages/accounts/index.php');
		}
		
		public function signin() {	
			require_once('views/pages/accounts/signin.php');
		}

		public function signup() {
			require_once('views/pages/accounts/signup.php');
		}
	}
?>