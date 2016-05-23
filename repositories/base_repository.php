<?php
    require_once 'database_layer.php';

    abstract class BaseRepository {

        protected $db;

        protected function __construct() {
            $this->db = DatabaseLayer::getInstance();
        }
    }
?>