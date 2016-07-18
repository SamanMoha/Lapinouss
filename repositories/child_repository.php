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

        public function delete($id_child_account) {
            if (empty($id_child_account))
                return false;

            $delete = $this->db->prepare(ChildQueries::DELETE);

            $delete->bindParam(':id_child_account', $id_child_account, PDO::PARAM_INT);

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

        public function played($id_child_account, $id_game) {
            $played = $this->db->prepare(ChildQueries::PLAYED);

            $played->bindParam(':id_child_account', $id_child_account, PDO::PARAM_INT);
            $played->bindParam(':id_game', $id_game, PDO::PARAM_INT);

            if (!$played || ($played instanceof PDOException) || !$played->execute())
                return null;

            return $played->fetchObject('Played');
        }

        public function trophy($id_child_account, $id_game) {
            $trophy = $this->db->prepare(ChildQueries::TROPHY);

            $trophy->bindParam(':id_child_account', $id_child_account, PDO::PARAM_INT);
            $trophy->bindParam(':id_game', $id_game, PDO::PARAM_INT);

            if (!$trophy || ($trophy instanceof PDOException) || !$trophy->execute())
                return null;

            return $trophy->fetchAll(PDO::FETCH_CLASS, 'Trophy');
        }
    }
