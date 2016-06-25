<?php
    require_once 'base_repository.php';
    require_once 'account_repository.php';
    require_once 'comment_repository.php';
    require_once 'queries/game_queries.php';

    class GameRepository extends BaseRepository {

        private $accountRepository;
        private $commentRepository;

        public function __construct() {
            parent::__construct();

            $this->accountRepository = new AccountRepository();
            $this->commentRepository = new CommentRepository();
        }

        public function all() {
            $games = $this->db->prepare(GameQueries::ALL);

            if ($games
                && !($games instanceof PDOException)
                && $games->execute()) {

                $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

                foreach ($games as $game) {
                    $game->account = $this->accountRepository->findById($game->id_account);
                    $game->comments = $this->commentRepository->findByGameId($game->id_game);
                }

                return $games;
            }

            return null;
        }

        public function findAllByParent(Account $account) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_PARENT);

            $games->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if ($games
                && !($games instanceof PDOException)
                && $games->execute()) {

                $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

                foreach ($games as $game) {
                    $game->account = $this->accountRepository->findById($game->id_account);
                    $game->comments = $this->commentRepository->findByGameId($game->id_game);
                }

                return $games;
            }

            return null;
        }

        public function findAllByChild(ChildAccount $account) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_CHILD);

            $games->bindParam(':id_child_account', $account->id_child_account, PDO::PARAM_INT);

            if ($games
                && !($games instanceof PDOException)
                && $games->execute()) {

                $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

                foreach ($games as $game) {
                    $game->account = $this->accountRepository->findById($game->id_account);
                    $game->comments = $this->commentRepository->findByGameId($game->id_game);
                }

                return $games;
            }

            return null;
        }
        
        public function findByChild(ChildAccount $account, $uid) {
            $game = $this->db->prepare(GameQueries::FIND_BY_CHILD);

            $game->bindParam(':id_child_account', $account->id_child_account, PDO::PARAM_INT);
            $game->bindParam(':game_uid', $uid, PDO::PARAM_STR);

            if ($game
                && !($game instanceof PDOException)
                && $game->execute()
                && $game->rowCount() == 1) {

                $game = $game->fetchObject('Game');
                $game->account = $this->accountRepository->findById($game->id_account);
                $game->comments = $this->commentRepository->findByGameId($game->id_game);

                return $game;
            }

            return null;
        }
        
        public function downloadGameType(Account $account, $id_game_type) {
            $download = $this->db->prepare(GameQueries::DOWNLOAD_GAME_TYPE);

            $download->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $download->bindParam(':id_game_type', $id_game_type, PDO::PARAM_INT);

            if ($download
                && !($download instanceof PDOException)
                && $download->execute()) {

                return true;
            }

            return false;
        }
    }
