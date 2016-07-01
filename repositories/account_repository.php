<?php
    require_once 'base_repository.php';
    require_once 'queries/account_queries.php';

    class AccountRepository extends BaseRepository {

        public function __construct() {
            parent::__construct();
        }

        public function login($email, $password) {
            if (!empty($email) && !empty($password)) {
                $login = $this->db->prepare(AccountQueries::LOGIN);

                $login->bindParam(':email', $email, PDO::PARAM_STR);
                $login->bindParam(':password', $password, PDO::PARAM_STR);

                if ($login
                    && !($login instanceof PDOException)
                    && $login->execute()
                    && $login->rowCount() == 1) {

                    return $login->fetchObject('Account');
                }
            }

            return null;
        }

        public function register($firstname, $lastname, $permission, $birth, $email, $password) {
            if (!empty($firstname)
                && !empty($lastname)
                && !empty($permission)
                && !empty($birth)
                && !empty($email)
                && !empty($password)) {

                $uid = DataUtil::generateUid();
                $created = DateUtil::now();
                $birth = DateUtil::format($birth);

                $register = $this->db->prepare(AccountQueries::REGISTER_ADULT);

                $register->bindParam(':permission', $permission, PDO::PARAM_STR);
                $register->bindParam(':uid', $uid, PDO::PARAM_STR);
                $register->bindParam(':email', $email, PDO::PARAM_STR);
                $register->bindParam(':password', $password, PDO::PARAM_STR);
                $register->bindParam(':first_name', $firstname, PDO::PARAM_STR);
                $register->bindParam(':last_name', $lastname, PDO::PARAM_STR);
                $register->bindParam(':birth_date', $birth, PDO::PARAM_STR);
                $register->bindParam(':created_date', $created, PDO::PARAM_STR);

                if ($register
                    && !($register instanceof PDOException)
                    && $register->execute()) {

                    return $this->login($email, $password);
                }
            }

            return null;
        }

        public function update($firstname, $lastname, $email, $password, $uid) {
            if (!empty($firstname)
                && !empty($lastname)
                && !empty($email)
                && !empty($password)
                && !empty($uid)) {

                $update = $this->db->prepare(AccountQueries::UPDATE);

                $update->bindParam(':first_name', $firstname, PDO::PARAM_STR);
                $update->bindParam(':last_name', $lastname, PDO::PARAM_STR);
                $update->bindParam(':email', $email, PDO::PARAM_STR);
                $update->bindParam(':password', $password, PDO::PARAM_STR);
                $update->bindParam(':uid', $uid, PDO::PARAM_STR);

                if ($update
                    && !($update instanceof PDOException)
                    && $update->execute()) {

                    return $update;
                }
            }

            return null;
        }
        
        public function delete($uid, $email) {
            if (!empty($uid)
                && !empty($email)) {

                $delete = $this->db->prepare(AccountQueries::DELETE);

                $delete->bindParam(':uid', $uid, PDO::PARAM_STR);
                $delete->bindParam(':email', $email, PDO::PARAM_STR);

                if ($delete
                    && !($delete instanceof PDOException)
                    && $delete->execute()) {

                    return true;
                }
            }

            return false;
        }
        
        public function children(Account $account) {
            $children = $this->db->prepare(AccountQueries::FIND_ALL_CHILDREN);

            $children->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if ($children
                    && !($children instanceof PDOException)
                    && $children->execute()) {
                
                return $children->fetchAll(PDO::FETCH_CLASS, 'ChildAccount');
            }

            return null;
        }

        public function findById($id_account) {
            $account = $this->db->prepare(AccountQueries::FIND_BY_ID);

            $account->bindParam(':id_account', $id_account, PDO::PARAM_INT);

            if ($account
                && !($account instanceof PDOException)
                && $account->execute()) {

                return $account->fetchObject('Account');
            }

            return null;
        }

        public function exists($email) {
            $account = $this->db->prepare(AccountQueries::EXISTS);

            $account->bindParam(':email', $email, PDO::PARAM_STR);

            if ($account
                && !($account instanceof PDOException)
                && $account->execute()
                && $account->rowCount() == 1) {

                return true;
            }

            return false;
        }
    }
