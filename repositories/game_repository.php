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

    }
