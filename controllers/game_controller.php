<?php
    require_once 'repositories/game_repository.php';

    class GameController {

        private $gameRepository;

        public function __construct() {
            $this->gameRepository = new GameRepository();
        }

        public function index() {
            if (!isset($_SESSION['user']))
                redirect('game', 'store');

            require_once 'views/pages/game/index.php';
        }

        public function store() {
            $games = $this->gameRepository->all();

            require_once 'views/pages/store/index.php';
        }
    }
