<?php
    require_once 'repositories/game_repository.php';
    require_once 'repositories/game_type_repository.php';
    require_once 'repositories/account_repository.php';
    require_once 'repositories/child_repository.php';

    class GameController {

        private $gameRepository;
        private $gameTypeRepository;
        private $commentRepository;
        private $accountRepository;
        private $childRepository;
        
        public function __construct() {
            $this->gameRepository = new GameRepository();
            $this->gameTypeRepository = new GameTypeRepository();
            $this->commentRepository = new CommentRepository();
            $this->accountRepository = new AccountRepository();
            $this->childRepository = new ChildRepository();
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
            if ((!isset($_GET['type']) || empty($_GET['type'])) && (!isset($_GET['id']) || empty($_GET['id']))) {
                call('game', 'store');
                return;
            }

            if (isset($_GET['id'])) {
                $this->buyGame($_GET['id']);
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

        private function buyGame($game) {
            if (empty($game)) {
                call('home', 'store');
                return;
            }

            $buy = $this->gameRepository->buy($_SESSION['user'], $game);
            if ($buy == false) {
                call('home', 'error');
                return;
            }

            $game = $this->gameRepository->findById($game);
            if ($game == null) {
                call('game', 'store');
                return;
            }

            redirect('game', 'store', 'type', $game->id_game_type, $game->id_game);
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
            if ($buy == false) {
                call('home', 'error');
                return;
            }

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

        private function gamesList($game_type) {
            if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
                $games = $this->gameRepository->findAllByType($game_type, $_SESSION['user']);
                $game_type = $this->gameTypeRepository->findById($game_type, $_SESSION['user']);
            }
            else {
                $games = $this->gameRepository->findAllByType($game_type);
            }

            require_once 'views/pages/game/games.php';
        }

        public function play() {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                redirect('game');
                return;
            }

            // If call is from ajax
            if ($_SESSION['user'] instanceof ChildAccount && isset($_POST['played'])) {
                $play = $this->gameRepository->play($_SESSION['user'], $_GET['id']);
                if ($play == null) {
                    return;
                }

                if (isset($_POST['trophy']) && !empty($_POST['trophy'])) {
                    $trophy = $this->gameRepository->win($_SESSION['user'], $_GET['id'], $_POST['trophy']);
                    if ($trophy == null) {
                        return;
                    }
                }

                return;
            }

            if ($_SESSION['user'] instanceof ChildAccount) {
                $game = $this->gameRepository->findByChild($_SESSION['user'], $_GET['id']);
            }
            else {
                $game = $this->gameRepository->findByParent($_SESSION['user'], $_GET['id']);
            }

            require_once 'views/pages/game/play.php';
        }

        public function detail() {
            if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof ChildAccount)) {
                redirect('account');
                return;
            }

            if (!isset($_GET['id']) || empty($_GET['id'])) {
                redirect('game');
                return;
            }

            $game = $this->gameRepository->findByChild($_SESSION['user'], $_GET['id']);
            if ($game == null) {
                call('home', 'error');
                return;
            }

            $played = $this->childRepository->played($_SESSION['user']->id_child_account, $_GET['id']);
            $trophies = $this->childRepository->trophy($_SESSION['user']->id_child_account, $_GET['id']);

            require_once 'views/pages/game/detail.php';
        }

        public function stats() {
            if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof Account)) {
                redirect('account');
                return;
            }

            if (!isset($_GET['id']) || empty($_GET['id'])) {
                redirect('game');
                return;
            }

            $game = $this->gameRepository->findByParent($_SESSION['user'], $_GET['id']);
            if ($game == null) {
                call('home', 'error');
                return;
            }

            $children = $this->accountRepository->children($_SESSION['user']);

            foreach ($children as $child) {
                $child->played = $this->childRepository->played($child->id_child_account, $_GET['id']);
                $child->trophies = $this->childRepository->trophy($child->id_child_account, $_GET['id']);
            }

            $total_played = 0;
            foreach ($children as $child) {
                if ($child->played != null) {
                    $total_played += $child->played->played_time;
                }
            }
            
            $total_trophies = 0;
            foreach ($children as $child) {
                foreach ($child->trophies as $trophy) {
                    $total_trophies++;
                }
            }
            
            require_once 'views/pages/game/stats.php';
        }

        public function setting() {
            if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof Account)) {
                redirect('account');
                return;
            }

            if (!isset($_GET['id']) || empty($_GET['id'])) {
                redirect('game');
                return;
            }

            $game = $this->gameRepository->findById($_GET['id']);
            if ($game == null) {
                call('home', 'error');
                return;
            }

            $children = $this->accountRepository->children($_SESSION['user']);
            $childrenPermissions = $this->accountRepository->childrenPermissions($_SESSION['user'], $game);

            if (isset($_POST['allow'])) {
                $allow = $this->gameRepository->allowGame($_POST['child'], $game, $_SESSION['user']);
                if ($allow == false) {
                    new WebException("Erreur lors de l'accord de permission");
                    return;
                }

                redirect('game', 'setting', $game->id_game, '', $_POST['child']);
            }

            if (isset($_POST['decline'])) {
                $decline = $this->gameRepository->declineGame($_POST['child'], $game, $_SESSION['user']);
                if ($decline == false) {
                    new WebException("Erreur lors de l'accord de permission");
                    return;
                }

                redirect('game', 'setting', $game->id_game, '', $_POST['child']);
            }

            require_once 'views/pages/game/setting.php';
        }

        public function comments() {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                redirect('game');
                return;
            }

            $game = $this->gameRepository->findById($_GET['id']);
            if ($game == null) {
                call('home', 'error');
                return;
            }

            require_once 'views/pages/game/comments.php';
            
            if (isset($_POST['comment']) && ($_SESSION['user'] instanceof Account)) {
                if (empty($_POST['message']))
                    return;

                $comment = $this->commentRepository->add($_SESSION['user'], $game, $_POST['message']);
                if ($comment == false) {
                    new WebException("Erreur lors de l'ajout du commentaire");
                    return;
                }
            }
        }
    }
