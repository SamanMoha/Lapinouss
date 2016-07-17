<?php
    require_once 'base_repository.php';
    require_once 'account_repository.php';
    require_once 'comment_repository.php';
    require_once 'queries/game_queries.php';

    class GameRepository extends BaseRepository {

        private $commentRepository;

        public function __construct() {
            parent::__construct();

            $this->commentRepository = new CommentRepository();
        }

        public function findById($id_game) {
            $game = $this->db->prepare(GameQueries::FIND_BY_ID);

            $game->bindParam(':id_game', $id_game, PDO::PARAM_INT);
            
            if (!$game || ($game instanceof PDOException) || !$game->execute() || $game->rowCount() != 1)
                return null;

            $game = $game->fetchObject('Game');

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
                $game->comments = $this->commentRepository->findByGameId($game->id_game);
            }

            return $games;
        }
        
        public function findByChild(ChildAccount $child_account, $uid) {
            $game = $this->db->prepare(GameQueries::FIND_BY_CHILD);

            $game->bindParam(':id_child_account', $child_account->id_child_account, PDO::PARAM_INT);
            $game->bindParam(':id_game', $uid, PDO::PARAM_INT);

            if (!$game || ($game instanceof PDOException) || !$game->execute() ||$game->rowCount() != 1)
                return null;

            $game = $game->fetchObject('Game');
            $game->comments = $this->commentRepository->findByGameId($game->id_game);

            return $game;
        }

        public function findByParent(Account $account, $id_game) {
            $game = $this->db->prepare(GameQueries::FIND_BY_PARENT);

            $game->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $game->bindParam(':id_game', $id_game, PDO::PARAM_INT);

            if (!$game || ($game instanceof PDOException) || !$game->execute() || $game->rowCount() != 1)
                return null;

            $game = $game->fetchObject('Game');
            $game->comments = $this->commentRepository->findByGameId($game->id_game);

            return $game;
        }

        public function findAllByType($id_game_type, Account $account = null) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_TYPE);

            $games->bindParam(':id_game_type', $id_game_type, PDO::PARAM_INT);

            if (!$games || ($games instanceof PDOException) || !$games->execute())
                return null;

            $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

            foreach ($games as $game) {
                $game->comments = $this->commentRepository->findByGameId($game->id_game);

                if ($account != null) {
                    $game->isAlreadyBought = $this->isAlreadyBought($account, $game);
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

        public function isAlreadyBought(Account $account, Game $game) {
            $check = $this->db->prepare(GameQueries::IS_ALREADY_BOUGHT);

            $check->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $check->bindParam(':id_game', $game->id_game, PDO::PARAM_INT);

            if (!$check || ($check instanceof PDOException) || !$check->execute() || $check->rowCount() != 1)
                return false;

            return true;
        }

        public function allowGame($id_child_account, Game $game, Account $account) {
            $allow = $this->db->prepare(GameQueries::ALLOW_GAME_FOR_CHILD);

            $allow->bindParam(':id_child_account', $id_child_account, PDO::PARAM_INT);
            $allow->bindParam(':id_game', $game->id_game, PDO::PARAM_INT);
            $allow->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if (!$allow || ($allow instanceof PDOException) || !$allow->execute())
                return false;

            return true;
        }

        public function declineGame($id_child_account, Game $game, Account $account) {
            $decline = $this->db->prepare(GameQueries::DECLINE_GAME_FOR_CHILD);

            $decline->bindParam(':id_child_account', $id_child_account, PDO::PARAM_INT);
            $decline->bindParam(':id_game', $game->id_game, PDO::PARAM_INT);
            $decline->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            
            if (!$decline || ($decline instanceof PDOException) || !$decline->execute())
                return false;

            return true;
        }
    }
