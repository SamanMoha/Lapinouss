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

                    return $login->fetch(PDO::FETCH_ASSOC);
                }
            }

            return null;
        }

        public function register($firstname, $lastname, $age, $email, $password) {
            if (!empty($firstname)
                && !empty($lastname)
                && !empty($age)
                && !empty($email)
                && !empty($password)) {

                $token = md5(uniqid(rand(), true));

                $register = $this->db->prepare(AccountQueries::REGISTER);

                $register->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $register->bindParam(':lastname', $lastname, PDO::PARAM_STR);

                //TODO: Use a date of birth instead of age
                $register->bindParam(':age', $age, PDO::PARAM_INT);

                $register->bindParam(':email', $email, PDO::PARAM_STR);
                $register->bindParam(':password', $password, PDO::PARAM_STR);
                $register->bindParam(':token', $token, PDO::PARAM_STR);

                if ($register
                    && !($register instanceof PDOException)
                    && $register->execute()) {

                    return $register;
                }
            }

            return null;
        }

        public function update($firstname, $lastname, $email, $password) {
            if (!empty($firstname)
                && !empty($lastname)
                && !empty($email)
                && !empty($password)) {

                $token = md5(uniqid(rand(), true));

                $update = $this->db->prepare(AccountQueries::UPDATE);

                $update->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $update->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                $update->bindParam(':email', $email, PDO::PARAM_STR);
                $update->bindParam(':password', $password, PDO::PARAM_STR);
                $update->bindParam(':token', $token, PDO::PARAM_STR);

                if ($update
                    && !($update instanceof PDOException)
                    && $update->execute()) {

                    return $update;
                }
            }

            return null;
        }
        
        public function delete($token, $email) {
            if (!empty($token)
                && !empty($email)) {

                $delete = $this->db->prepare(AccountQueries::DELETE);

                $delete->bindParam(':token', $token, PDO::PARAM_STR);
                $delete->bindParam(':email', $email, PDO::PARAM_STR);

                if ($delete
                    && !($delete instanceof PDOException)
                    && $delete->execute()) {

                    return true;;
                }
            }

            return false;
        }
    }
?>