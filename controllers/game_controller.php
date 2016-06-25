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

            if ($_SESSION['user'] instanceof ChildAccount) {
                $games = $this->gameRepository->findAllByChild($_SESSION['user']);
            }
            else {
                $games = $this->gameRepository->findAllByParent($_SESSION['user']);
            }

            require_once 'views/pages/game/index.php';
        }

        public function store() {
            $games = $this->gameRepository->all();

            require_once 'views/pages/game/store.php';
        }

        public function download() {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                call('game', 'store');
            }

            $game = $this->gameRepository->downloadGameType($_SESSION['user'], $_GET['id']);
            if ($game == false) {
                call('home', 'error');
            }

            redirect('game', 'store', null, $_GET['id']);
        }

        public function play() {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                call('home', 'error');
            }

            $game = $this->gameRepository->findByChild($_SESSION['user'], $_GET['id']);
            if ($game == null) {
                call('home', 'error');
            }

            require_once 'views/pages/game/play.php';
        }
    }
