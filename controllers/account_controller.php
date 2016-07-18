<?php
	require_once 'repositories/account_repository.php';
	require_once 'repositories/child_repository.php';

	class AccountController {

		private $accountRepository;
		private $childRepository;

		public function __construct() {
			$this->accountRepository = new AccountRepository();
			$this->childRepository = new ChildRepository();
		}

		public function index() {
			if (!isset($_SESSION['user']))
				redirect('account', 'login');

			if ($_SESSION['user'] instanceof ChildAccount) {
				$this->indexChild();
			}
			else {
				$this->indexParent();
			}
		}

		private function indexParent() {
			$account = $_SESSION['user'];
			$children = array_slice($this->accountRepository->children($account), 0, 3);
			
			require_once 'views/pages/account/index_adult.php';
		}

		private function indexChild() {
			redirect('game');
		}
		
		public function login() {
			if (isset($_POST['login-parent'])) {
				$this->loginParent();
			}

			if (isset($_POST['login-child'])) {
				$this->loginChild();
			}

			require_once 'views/pages/account/login.php';
		}

		private function loginParent() {
			$user = $this->accountRepository->login(
				$_POST['email'],
				$_POST['password']
			);

			if ($user == null) {
				new WebException("Adresse e-mail/mot de passe incorrect !");
				return;
			}

			$_SESSION['user'] = $user;

			redirect('account');
		}

		private function loginChild() {
			$user = $this->childRepository->login(
				$_POST['parent_email'],
				$_POST['firstname'],
				$_POST['lastname'],
				$_POST['password']
			);

			if ($user == null) {
				new WebException("Utilisateur non reconnu !");
				return;
			}

			$_SESSION['user'] = $user;

			redirect('account');
		}

		public function register() {
			require_once 'views/pages/account/register_adult.php';

			if (isset($_POST['register'])) {
				if ($_POST['password'] != $_POST['re-password']) {
					new WebException("Les mots de passes doivent etre identiques !");
					return;
				}

				if (strlen($_POST['password']) < 8) {
					new WebException("Le mot de passe doit contenir au moins 8 caracteres.");
					return;
				}

				if ($this->accountRepository->exists($_POST['email'])) {
					new WebException("L'adresse email est deja utlisée !");
					return;
				}

				$user = $this->accountRepository->register(
					$_POST['firstname'],
					$_POST['lastname'],
					$_POST['permission'],
					$_POST['email'],
					$_POST['password']
				);

				if ($user == null) {
					new WebException("Erreur lors de l'inscription.");
					return;
				}

				$user = $this->accountRepository->login($_POST['email'], $_POST['password']);
				if ($user == null) {
					new WebException("Erreur lors de l'inscription.");
					return;
				}

				$_SESSION['user'] = $user;
				redirect('account');
			}
		}

		public function registerChild() {
			require_once 'views/pages/account/register_child.php';

			if (isset($_POST['register'])) {
				if ($_POST['password'] != $_POST['re-password']) {
					new WebException("Les mots de passes doivent etre identiques !");
					return;
				}

				if (strlen($_POST['password']) < 6) {
					new WebException("Le mot de passe doit contenir au moins 6 caractères.");
					return;
				}

				$user = $this->childRepository->register(
					$_POST['firstname'],
					$_POST['lastname'],
					$_POST['password'],
					$_SESSION['user']
				);

				if ($user == false) {
					new WebException("Oops une erreur est survenue lors de l'inscription :/");
					return;
				}

				redirect('account');
			}
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
					 new WebException("Erreur lors de l'inscription.");
				}

				$_SESSION['user'] = $user;

				redirect('account');
			}

			require_once 'views/pages/account/settings.php';
		}

		public function delete() {
			if (isset($_POST['delete'])) {
				$delete = $this->accountRepository->delete(
					$_SESSION['user']->email,
					$_SESSION['user']->token
				);

				if (!$delete) {
					 new WebException("Erreur lors de la suppression du compte.");
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
		
		public function existsParent() {
			if (isset($_POST['email'])) {
				$user = $this->accountRepository->exists(
					$_POST['email']
				);

				http_response_code($user ? 200 : 404);
			}
		}

		public function children() {
			$children = $this->accountRepository->children($_SESSION['user']);

			require_once 'views/pages/account/children.php';
		}
	}
