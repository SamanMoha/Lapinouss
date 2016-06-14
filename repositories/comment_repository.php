<?php
    require_once 'base_repository.php';
    require_once 'queries/comment_queries.php';
    
    class CommentRepository extends BaseRepository {
    
        private $accountRepository;
    
        public function __construct() {
            parent::__construct();
    
            $this->accountRepository = new AccountRepository();
        }

        public function findByGameId($id_game) {
            $comments = $this->db->prepare(CommentQueries::FIND_BY_GAME_ID);

            $comments->bindParam(':id_game', $id_game, PDO::PARAM_INT);
    
            if ($comments
                && !($comments instanceof PDOException)
                && $comments->execute()
                && $comments->rowCount() > 0) {

                $comments = $comments->fetchAll(PDO::FETCH_CLASS, 'Comment');

                foreach ($comments as $comment) {
                    $comment->account = $comment->account = $this->accountRepository->findById($comment->id_account);
                }

                return $comments;
            }
    
            return null;
        }
    }
