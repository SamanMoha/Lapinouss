<?php
    class Played {

        public $id_played;
        public $played_time;
        public $date_game;
        public $id_game;
        public $id_child_account;
        
        //Related object
        public $game;
        public $child_account;
    }
