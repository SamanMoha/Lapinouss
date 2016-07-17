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

        public function findById($id_game) {
            $game = $this->db->prepare(GameQueries::FIND_BY_ID);

            $game->bindParam(':id_game', $id_game, PDO::PARAM_INT);
            
            if (!$game || ($game instanceof PDOException) || !$game->execute() || $game->rowCount() != 1)
                return null;

            $game = $game->fetchObject('Game');

            $game->account = $this->accountRepository->findById($game->id_account);
            $game->comments = $this->commentRepository->findByGameId($game->id_game);

            return $game;
        }
        
        public function findAllByParent(Account $account) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_PARENT);

            $games->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if (!$games || ($games instanceof PDOException) || !$games->execute())
                return null;

            $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

            foreach ($games as $game) {
                $game->account = $this->accountRepository->findById($game->id_account);
                $game->comments = $this->commentRepository->findByGameId($game->id_game);
            }

            return $games;
        }

        public function findAllByChild(ChildAccount $child_account) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_CHILD);

            $games->bindParam(':id_child_account', $child_account->id_child_account, PDO::PARAM_INT);

            if (!$games || ($games instanceof PDOException) || !$games->execute())
                return null;

            $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

            foreach ($games as $game) {
                $game->account = $this->accountRepository->findById($game->id_account);
                $game->comments = $this->commentRepository->findByGameId($game->id_game);
            }

            return $games;
        }
        
        public function findByChild(ChildAccount $child_account, $uid) {
            $game = $this->db->prepare(GameQueries::FIND_BY_CHILD);

            $game->bindParam(':id_child_account', $child_account->id_child_account, PDO::PARAM_INT);
            $game->bindParam(':game_uid', $uid, PDO::PARAM_STR);

            if ($game || !($game instanceof PDOException) || $game->execute() ||$game->rowCount() != 1)
                return null;

            $game = $game->fetchObject('Game');

            var_dump($game);
            //$game->account = $this->accountRepository->findById($game->id_account);
            //$game->comments = $this->commentRepository->findByGameId($game->id_game);

            return $game;
        }

        public function findAllByType($id_game_type, Account $account = null) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_TYPE);

            $games->bindParam(':id_game_type', $id_game_type, PDO::PARAM_INT);

            if (!$games || ($games instanceof PDOException) || !$games->execute())
                return null;

            $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

            foreach ($games as $game) {
                $game->account = $this->accountRepository->findById($game->id_account);
                $game->comments = $this->commentRepository->findByGameId($game->id_game);

                if ($account != null) {
                    $game->isAlreadyBought = $this->isAlreadyBought($account, $game->id_game_type);
                }
            }

            return $games;
        }

        public function buy(Account $account, $id_game) {
            $download = $this->db->prepare(GameQueries::BUY);

            $download->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $download->bindParam(':id_game', $id_game, PDO::PARAM_INT);

            if (!$download || ($download instanceof PDOException) || !$download->execute())
                return false;

            return true;
        }

        public function delete(Account $account, $id_game) {
            $delete = $this->db->prepare(GameQueries::DELETE);

            $delete->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $delete->bindParam(':id_game_type', $id_game, PDO::PARAM_INT);

            if (!$delete || ($delete instanceof PDOException) || !$delete->execute())
                return false;

            return true;
        }

        public function isAlreadyBought(Account $account, $id_game) {
            $check = $this->db->prepare(GameQueries::IS_ALREADY_BOUGHT);

            $check->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $check->bindParam(':id_game', $id_game, PDO::PARAM_INT);

            if (!$check || ($check instanceof PDOException) || !$check->execute() || $check->rowCount() != 1)
                return false;

            return true;
        }
    }
