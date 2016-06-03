<?php
    require_once 'base_repository.php';
    require_once 'queries/child_queries.php';

    class ChildRepository extends BaseRepository {

        public function __construct() {
            parent::__construct();
        }

        public function login($email, $password) {
            if (!empty($email) && !empty($password)) {
                $login = $this->db->prepare(ChildQueries::LOGIN);

                $login->bindParam(':email', $email, PDO::PARAM_STR);
                $login->bindParam(':password', $password, PDO::PARAM_STR);

                if ($login
                    && !($login instanceof PDOException)
                    && $login->execute()
                    && $login->rowCount() == 1) {

                    return $login->fetchObject('ChildAccount');
                }
            }

            return null;
        }

        public function register($firstname, $lastname, $birth, $email, $password) {
            if (!empty($firstname)
                && !empty($lastname)
                && !empty($birth)
                && !empty($email)
                && !empty($password)) {

                $uid = DataUtil::generateUid();
                $created = DateUtil::now();
                $permission = 'Enfant';

                $register = $this->db->prepare(AccountQueries::REGISTER);

                $register->bindParam(':permission', $permission, PDO::PARAM_STR);
                $register->bindParam(':uid', $uid, PDO::PARAM_STR);
                $register->bindParam(':email', $email, PDO::PARAM_STR);
                $register->bindParam(':password', $password, PDO::PARAM_STR);
                $register->bindParam(':first_name', $firstname, PDO::PARAM_STR);
                $register->bindParam(':first_name', $lastname, PDO::PARAM_STR);
                $register->bindParam(':birth_date', $birth, PDO::PARAM_STR);
                $register->bindParam(':created_date', $created, PDO::PARAM_STR);

                if ($register
                    && !($register instanceof PDOException)
                    && $register->execute()) {

                    return $register;
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
    }
