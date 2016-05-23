<?php
    require_once './common/config.php';

    class DatabaseLayer {

        private static $_db = null;

        private function __construct() {
            try {
                self::$_db = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                    DB_USER,
                    DB_PASS,
                    array(PDO::ATTR_PERSISTENT => true)
                );
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function __clone() {}

        public static function getInstance() {
            if (self::$_db == null) {
                new self;
            }

            return self::$_db;
        }
    }
?>