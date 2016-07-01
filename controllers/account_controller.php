<?php
	require_once 'repositories/account_repository.php';
	require_once 'repositories/child_repository.php';

	class AccountController {

		private $accountRepository;
		private $childRepository;

		public function __construct() {
			$this->accountRepository = new AccountRepository();
			$this->childRepository = new ChildRepository();

			if (isset($_SESSION['user'])) {
				//TODO: Instanciate repositories for user
			}
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
			$account = $_SESSION['user'];
			require_once 'views/pages/account/index_child.php';
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

			if ($user != null) {
				$_SESSION['user'] = $user;

				redirect('account');
			}
			else {
				new WebException("Adresse e-mail/mot de passe incorrect !");
			}
		}

		private function loginChild() {
			$user = $this->childRepository->login(
				$_POST['username'],
				$_POST['password']
			);

			if ($user != null) {
				$_SESSION['user'] = $user;

				redirect('account');
			}
			else {
				new WebException("Adresse e-mail/mot de passe incorrect !");
			}
		}

		public function register() {
			if (isset($_POST['register'])) {
				if ($_POST['password'] == $_POST['re-password']) {
					if (strlen($_POST['password']) >= 8) {
						$user = $this->accountRepository->exists($_POST['email']);

						if ($user == false) {
							$user = $this->accountRepository->register(
								$_POST['firstname'],
								$_POST['lastname'],
								$_POST['permission'],
								$_POST['birth'],
								$_POST['email'],
								$_POST['password']
							);

							if ($user != null) {
								$user = $this->accountRepository->login($_POST['email'], $_POST['password']);

								if ($user != null) {
									$_SESSION['user'] = $user;

									redirect('account');
								}
								else {
									new WebException("Erreur lors de l'inscription.");
								}
							}
							else {
								new WebException("Erreur lors de l'inscription.");
							}
						}
						else {
							new WebException("L'adresse email est deja utlisée !");
						}
					}
					else {
						new WebException("Le mot de passe doit contenir au moins 8 caractères.");
					}
				}
				else {
					new WebException("Les mots de passes doivent etre identiques !");
				}
			}

			require_once 'views/pages/account/register_adult.php';
		}

		public function registerChild() {
			if (isset($_POST['register'])) {
				if ($_POST['password'] == $_POST['re-password']) {
					if (strlen($_POST['password']) >= 6) {
						$user = $this->childRepository->exists($_POST['username']);

						if ($user == false) {
							$user = $this->childRepository->register(
								$_POST['firstname'],
								$_POST['lastname'],
								$_POST['birth'],
								$_POST['username'],
								$_POST['password'],
								$_SESSION['user']
							);

							if ($user == true) {

								redirect('account');
							}
							else {
								new WebException("Oops une erreur est survenue lors de l'inscription :/");
							}
						}
						else {
							new WebException("L'adresse email est deja utlisée !");
						}
					}
					else {
						new WebException("Le mot de passe doit contenir au moins 6 caractères.");
					}
				}
				else {
					new WebException("Les mots de passes doivent etre identiques !");
				}
			}

			require_once 'views/pages/account/register_child.php';
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
