<?php
    class Game {

        public $id_game;
        public $uid;
        public $title;
        public $picture;
        public $description;
        public $price;
        public $Available;
        public $created_date;
        public $file;
        public $id_game_type;
        public $purchased_date;
        public $activated;
        public $id_account;
        
        //Related object
        public $account;
        public $comments;
    }