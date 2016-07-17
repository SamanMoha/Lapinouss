<?php
    require_once 'repositories/game_repository.php';
    require_once 'repositories/game_type_repository.php';

    class GameController {

        private $gameRepository;
        private $gameTypeRepository;

        public function __construct() {
            $this->gameRepository = new GameRepository();
            $this->gameTypeRepository = new GameTypeRepository();
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
            if (isset($_GET['type']) && !empty($_GET['type'])) {
                $this->gamesList($_GET['type']);
            }
            else {
                $this->gameTypesList();
            }
        }

        public function buy() {
            if (!isset($_GET['type']) || empty($_GET['type'])) {
                call('home', 'store');
                return;
            }

            if (isset($_GET['game']) && !empty($_GET['game'])) {
                $this->buyGame($_GET['type'], $_GET['game']);
            }
            else {
                $this->buyType($_GET['type']);
            }
        }

        private function buyType($game_type) {
            if (isset($_POST['confirm'])) {
                $buy = $this->gameTypeRepository->buy($_SESSION['user'], $game_type);
                if ($buy == false) {
                    call('home', 'error');
                    return;
                }

                redirect('game', 'store', 'type', $game_type);
            }

            $game_type = $this->gameTypeRepository->findById($game_type);

            require_once 'views/pages/game/buy_type.php';
        }

        private function buyGame($game_type, $game) {
            if (empty($game_type) || empty($game)) {
                call('home', 'store');
                return;
            }

            $buy = $this->gameRepository->buy($_SESSION['user'], $game);
            if ($buy == false) {
                call('home', 'error');
                return;
            }

            redirect('game', 'store', 'type', $game_type, $game);
        }

        public function delete() {
            if (!isset($_GET['type']) || empty($_GET['type'])) {
                call('home', 'error');
                return;
            }

            if (isset($_GET['game']) && !empty($_GET['game'])) {
                $this->deleteGame($_GET['type'], $_GET['game']);
            }
            else {
                $this->deleteType($_GET['type']);
            }
        }

        private function deleteType($game_type) {
            if (isset($_POST['confirm'])) {
                $buy = $this->gameTypeRepository->delete($_SESSION['user'], $game_type);
                if ($buy == false) {
                    call('home', 'error');
                    return;
                }

                redirect('game', 'store');
            }

            $game_type = $this->gameTypeRepository->findById($game_type);

            require_once 'views/pages/game/delete_type.php';
        }

        private function deleteGame($game_type, $game) {
            if (empty($game_type) || empty($game))
                return;

            $buy = $this->gameRepository->delete($_SESSION['user'], $game);
            if ($buy == false)
                call('home', 'error');

            redirect('game', 'store', 'type', $game_type);
        }

        private function gameTypesList() {
            if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
                $game_types = $this->gameTypeRepository->all($_SESSION['user']);
            }
            else {
                $game_types = $this->gameTypeRepository->all();
            }

            require_once 'views/pages/game/store.php';
        }

        private function gamesList($gameType) {
            if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
                $games = $this->gameRepository->findAllByType($gameType, $_SESSION['user']);
            }
            else {
                $games = $this->gameRepository->findAllByType($gameType);
            }

            require_once 'views/pages/game/games.php';
        }

        public function play() {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                redirect('game');
                return;
            }

            $game = $this->gameRepository->findByChild($_SESSION['user'], $_GET['id']);
            //if ($game == null)
                //call('home', 'error');

            require_once 'views/pages/game/play.php';
        }
    }
