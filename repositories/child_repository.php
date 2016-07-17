<?php
    require_once 'base_repository.php';
    require_once 'queries/child_queries.php';

    class ChildRepository extends BaseRepository {

        public function __construct() {
            parent::__construct();
        }

        public function login($parent_email, $first_name, $last_name, $password) {
            if (empty($parent_email)|| empty($first_name)|| empty($last_name) || empty($password))
                return null;

            $login = $this->db->prepare(ChildQueries::LOGIN);

            $login->bindParam(':parent_email', $parent_email, PDO::PARAM_STR);
            $login->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $login->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $login->bindParam(':password', $password, PDO::PARAM_STR);

            if (!$login || ($login instanceof PDOException) || !$login->execute() || $login->rowCount() != 1)
                return null;

            return $login->fetchObject('ChildAccount');
        }

        public function register($first_name, $last_name, $password, Account $account) {
            if (empty($first_name) || empty($last_name) || empty($password))
                return false;

            $register = $this->db->prepare(ChildQueries::REGISTER);
            
            $register->bindParam(':password', $password, PDO::PARAM_STR);
            $register->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $register->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $register->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if (!$register || ($register instanceof PDOException) || !$register->execute())
                return false;

            return true;
        }

        public function delete($uid, $email) {
            if (empty($uid) || empty($email))
                return false;

                $delete = $this->db->prepare(ChildQueries::DELETE);

                $delete->bindParam(':uid', $uid, PDO::PARAM_STR);
                $delete->bindParam(':email', $email, PDO::PARAM_STR);

                if (!$delete || ($delete instanceof PDOException) || !$delete->execute())
                    return false;

            return true;
        }

        public function exists($first_name, $last_name, Account $account) {
            $child = $this->db->prepare(ChildQueries::EXISTS);

            $child->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $child->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $child->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if (!$child || ($child instanceof PDOException) || !$child->execute() || $child->rowCount() != 1)
                return false;

            return true;
        }
    }
