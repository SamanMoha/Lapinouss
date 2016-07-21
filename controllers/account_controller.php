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

			foreach ($children as $child) {
				$child->played = $this->childRepository->played($child->id_child_account);
			}

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
				new WebException("USER_INCORRECT");
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
				new WebException("UNKNOWN_USER");
				return;
			}

			$_SESSION['user'] = $user;

			redirect('account');
		}

		public function register() {
			require_once 'views/pages/account/register_adult.php';

			if (isset($_POST['register'])) {
				if ($_POST['password'] != $_POST['re-password']) {
					new WebException("PWD_EQUAL");
					return;
				}

				if (strlen($_POST['password']) < 8) {
					new WebException("PWD_LENGTH_8");
					return;
				}

				if ($this->accountRepository->exists($_POST['email'])) {
					new WebException("EMAIL_USED");
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
					new WebException("REGISTRATION");
					return;
				}

				$user = $this->accountRepository->login($_POST['email'], $_POST['password']);
				if ($user == null) {
					new WebException("REGISTRATION");
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
					new WebException("PWD_EQUAL");
					return;
				}

				if (strlen($_POST['password']) < 6) {
					new WebException("PWD_LENGTH_6");
					return;
				}

				$user = $this->childRepository->register(
					$_POST['firstname'],
					$_POST['lastname'],
					$_POST['password'],
					$_SESSION['user']
				);

				if ($user == false) {
					new WebException("REGISTRATION");
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
					 new WebException("REGISTRATION");
					return;
				}

				$_SESSION['user'] = $user;

				redirect('account');
			}

			require_once 'views/pages/account/settings.php';
		}

		public function deleteChild() {
			if (!isset($_GET['id']) || empty($_GET['id']))
				return;

			$delete = $this->childRepository->delete($_GET['id']);

			if (!$delete) {
				 new WebException("CHILD_DELETE");
				return;
			}

			redirect('account', 'children');
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
