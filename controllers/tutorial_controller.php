<?php
    class TutorialController {

        public function index() {
            require_once('views/pages/tutorial/index.php');
        }

        public function downloadGame() {
            require_once('views/pages/tutorial/download_game.php');
        }

        public function downloadGameType() {
            require_once('views/pages/tutorial/download_game_type.php');
        }

        public function addChildren() {
            require_once('views/pages/tutorial/add_children.php');
        }

        public function permissions() {
            require_once('views/pages/tutorial/permissions.php');
        }
    }
