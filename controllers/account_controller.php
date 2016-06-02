<?php
	require_once 'repositories/account_repository.php';

	class AccountController {

		private $accountRepository;

		public function __construct() {
			$this->accountRepository = new AccountRepository();

			if (isset($_SESSION['user'])) {
				//TODO: Instanciate repositories for user
			}
		}

		public function index() {
			if (!isset($_SESSION['user']))
				redirect('account', 'login');
			
			$account = $_SESSION['user'];

			require_once 'views/pages/account/index.php';
		}
		
		public function login() {
			if (isset($_POST['login'])) {
				$user = $this->accountRepository->login(
					$_POST['email'],
					$_POST['password']
				);
				
				if ($user == null) {
					throw new WebException("Adresse e-mail/mot de passe incorrect !");
				}

				$_SESSION['user'] = $user;
				
				redirect('account');
			}

			require_once 'views/pages/accounts/login.php';
		}

		public function register() {
			if (isset($_POST['register'])) {
				$user = $this->accountRepository->register(
					$_POST['firstname'],
					$_POST['lastname'],
					$_POST['age'],
					$_POST['email'],
					$_POST['password']
				);

				if ($user == null) {
					throw new WebException("Erreur lors de l'inscription");
				}

				$_SESSION['user'] = $user;

				redirect('account');
			}

			require_once 'views/pages/accounts/register.php';
		}

		public function settings() {
			if (isset($_POST['update'])) {
				$user = $this->accountRepository->update(
					$_POST['firstname'],
					$_POST['lastname'],
					$_SESSION['user']->email,
					$_POST['password']
				);

				if ($user == null) {
					throw new WebException("Erreur lors de l'inscription.");
				}

				$_SESSION['user'] = $user;

				redirect('account');
			}

			require_once 'views/pages/accounts/settings.php';
		}

		public function delete() {
			if (isset($_POST['delete'])) {
				$delete = $this->accountRepository->delete(
					$_SESSION['user']->email,
					$_SESSION['user']->token
				);

				if (!$delete) {
					throw new WebException("Erreur lors de la suppression du compte.");
				}

				$this->logout();
			}
		}

		public function logout() {
			$_SESSION['user'] = null;

			session_unset();
			session_destroy();

			redirect('home');
		}
	}
?>