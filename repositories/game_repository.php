<?php
    require_once 'base_repository.php';
    require_once 'queries/game_queries.php';

    class GameRepository extends BaseRepository {

        public function __construct() {
            parent::__construct();
        }

        public function all() {
            $games = $this->db->prepare(GameQueries::ALL);

            if ($games
                && !($games instanceof PDOException)
                && $games->execute()) {

                return $games->fetchAll(PDO::FETCH_CLASS, 'Game');
            }

            return null;
        }

        public function findAllByParent(Account $account) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_PARENT);

            $games->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);

            if ($games
                && !($games instanceof PDOException)
                && $games->execute()) {

                return $games->fetchAll(PDO::FETCH_CLASS, 'Game');
            }

            return null;
        }

        public function findAllByChild(ChildAccount $account) {
            $games = $this->db->prepare(GameQueries::FIND_ALL_BY_CHILD);

            $games->bindParam(':id_child_account', $account->id_child_account, PDO::PARAM_INT);

            if ($games
                && !($games instanceof PDOException)
                && $games->execute()) {

                return $games->fetchAll(PDO::FETCH_CLASS, 'Game');
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
                return $game->fetchObject('Game');
            }

            return null;
        }
    }
