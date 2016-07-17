<?php
    class Game {

        public $id_game;
        public $title;
        public $picture;
        public $description;
        public $price;
        public $created_date;
        public $file;
        public $id_game_type;
        public $available;
        
        //Related object
        public $comments;

        public $isAlreadyBought;
    }