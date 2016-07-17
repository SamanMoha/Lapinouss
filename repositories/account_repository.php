<?php
    require_once 'base_repository.php';
    require_once 'queries/account_queries.php';

    class AccountRepository extends BaseRepository {

        public function __construct() {
            parent::__construct();
        }

        public function login($email, $password) {
            if (empty($email) || empty($password))
                return null;

            $login = $this->db->prepare(AccountQueries::LOGIN);

            $login->bindParam(':email', $email, PDO::PARAM_STR);
            $login->bindParam(':password', $password, PDO::PARAM_STR);

            if (!$login || ($login instanceof PDOException) || !$login->execute() || $login->rowCount() != 1)
                return null;

            return $login->fetchObject('Account');
        }

        public function register($firstname, $lastname, $permission, $email, $password) {
            if (empty($firstname) || empty($lastname) || empty($permission)  || empty($email) || empty($password))
                return null;

                $register = $this->db->prepare(AccountQueries::REGISTER);

                $register->bindParam(':permission', $permission, PDO::PARAM_STR);
                $register->bindParam(':email', $email, PDO::PARAM_STR);
                $register->bindParam(':password', $password, PDO::PARAM_STR);
                $register->bindParam(':first_name', $firstname, PDO::PARAM_STR);
                $register->bindParam(':last_name', $lastname, PDO::PARAM_STR);

                if (!$register ||($register instanceof PDOException) || !$register->execute())
                    return null;

            // If registration was successful, proceed to login
            return $this->login($email, $password);
        }
        
        public function children(Account $account) {
            $children = $this->db->prepare(AccountQueries::FIND_ALL_CHILDREN);

            $children->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if (!$children || ($children instanceof PDOException) || !$children->execute())
                return null;

            return $children->fetchAll(PDO::FETCH_CLASS, 'ChildAccount');
        }

        public function childrenPermissions(Account $account, Game $game) {
            $children = $this->db->prepare(AccountQueries::FIND_ALL_CHILDREN_PERMISSIONS);

            $children->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $children->bindParam(':id_game', $game->id_game, PDO::PARAM_INT);

            if (!$children || ($children instanceof PDOException) || !$children->execute())
                return null;

            return $children->fetchAll(PDO::FETCH_CLASS, 'ChildAccount');
        }

        public function findById($id_account) {
            $account = $this->db->prepare(AccountQueries::FIND_BY_ID);

            $account->bindParam(':id_account', $id_account, PDO::PARAM_INT);

            if (!$account || ($account instanceof PDOException) || !$account->execute())
                return null;

            return $account->fetchObject('Account');
        }

        public function exists($email) {
            $account = $this->db->prepare(AccountQueries::EXISTS);

            $account->bindParam(':email', $email, PDO::PARAM_STR);

            if (!$account || ($account instanceof PDOException) || !$account->execute() || $account->rowCount() != 1)
                return false;

            return true;
        }
    }
