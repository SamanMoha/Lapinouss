<?php
    require_once 'base_repository.php';
    require_once 'account_repository.php';
    require_once 'game_repository.php';
    require_once 'queries/game_type_queries.php';

    class GameTypeRepository extends BaseRepository {

        private $accountRepository;
        private $gameRepository;

        public function __construct() {
            parent::__construct();

            $this->accountRepository = new AccountRepository();
            $this->gameRepository = new GameRepository();
        }

        public function all(Account $account = null) {
            $game_types = $this->db->prepare(GameTypeQueries::ALL);

            if (!$game_types || ($game_types instanceof PDOException) || !$game_types->execute())
                return null;

            $game_types = $game_types->fetchAll(PDO::FETCH_CLASS, 'GameType');

            foreach ($game_types as $game_type) {
                $game_type->games = $this->gameRepository->findAllByType($game_type->id_game_type);

                if ($account != null) {
                    $game_type->isAlreadyBought = $this->isAlreadyBought($account, $game_type->id_game_type);
                }
            }

            return $game_types;
        }

        public function findById($id_game_type) {
            $game_type = $this->db->prepare(GameTypeQueries::FIND_BY_ID);

            $game_type->bindParam(':id_game_type', $id_game_type, PDO::PARAM_INT);

            if (!$game_type || ($game_type instanceof PDOException) || !$game_type->execute() && $game_type->rowCount() != 1)
                return null;

            $game_type = $game_type->fetchObject('GameType');

            $game_type->games = $this->gameRepository->findAllByType($game_type->id_game_type);

            return $game_type;
        }

        public function findAllByParent(Account $account) {
            $game_types = $this->db->prepare(GameTypeQueries::FIND_ALL_BY_PARENT);

            $game_types->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if (!$game_types || ($game_types instanceof PDOException) || !$game_types->execute())
                return null;

            $games = $game_types->fetchAll(PDO::FETCH_CLASS, 'Game');

            foreach ($games as $game) {
                $game->account = $this->accountRepository->findById($game->id_account);
            }

            return $games;
        }

        public function findAllByChild(ChildAccount $account) {
            $games = $this->db->prepare(GameTypeQueries::FIND_ALL_BY_CHILD);

            $games->bindParam(':id_child_account', $account->id_child_account, PDO::PARAM_INT);

            if ($games
                && !($games instanceof PDOException)
                && $games->execute()) {

                $games = $games->fetchAll(PDO::FETCH_CLASS, 'Game');

                foreach ($games as $game) {
                    $game->account = $this->accountRepository->findById($game->id_account);
                }

                return $games;
            }

            return null;
        }

        public function findByChild(ChildAccount $account, $uid) {
            $game = $this->db->prepare(GameTypeQueries::FIND_BY_CHILD);

            $game->bindParam(':id_child_account', $account->id_child_account, PDO::PARAM_INT);
            $game->bindParam(':game_uid', $uid, PDO::PARAM_STR);

            if ($game
                && !($game instanceof PDOException)
                && $game->execute()
                && $game->rowCount() == 1) {

                $game = $game->fetchObject('Game');
                $game->account = $this->accountRepository->findById($game->id_account);

                return $game;
            }

            return null;
        }

        public function buy(Account $account, $id_game_type) {
            $download = $this->db->prepare(GameTypeQueries::BUY);

            $download->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $download->bindParam(':id_game_type', $id_game_type, PDO::PARAM_INT);

            if (!$download || ($download instanceof PDOException) || !$download->execute())
                return false;

            return true;
        }

        public function delete(Account $account, $id_game_type) {
            $delete = $this->db->prepare(GameTypeQueries::DELETE);

            $delete->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $delete->bindParam(':id_game_type', $id_game_type, PDO::PARAM_INT);

            if (!$delete || ($delete instanceof PDOException) || !$delete->execute())
                return false;

            return true;
        }

        public function isAlreadyBought(Account $account, $id_game_type) {
            $check = $this->db->prepare(GameTypeQueries::IS_ALREADY_BOUGHT);

            $check->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $check->bindParam(':id_game_type', $id_game_type, PDO::PARAM_INT);

            if (!$check || ($check instanceof PDOException) || !$check->execute() || $check->rowCount() != 1)
                return false;

            return true;
        }
    }
