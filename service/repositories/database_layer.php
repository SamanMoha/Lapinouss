<?php
    require_once './common/config.php';

    class DatabaseLayer {

        private static $_db = null;

        private function __construct() {}

        private function __clone() {}

        public static function getInstance() {
            if (self::$_db == null) {
                try {
                    self::$_db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
                }
                catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }

            return self::$_db;
        }
    }
?>