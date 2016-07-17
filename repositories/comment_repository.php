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
    
            if (!$comments || ($comments instanceof PDOException) || !$comments->execute())
                return null;

            $comments = $comments->fetchAll(PDO::FETCH_CLASS, 'Comment');

            foreach ($comments as $comment) {
                $comment->account = $comment->account = $this->accountRepository->findById($comment->id_account);
            }

            return $comments;
        }
        
        public function add(Account $account, Game $game, $message) {
            if ($account == null || $game == null || empty($message))
                return false;

            $date = DateUtil::now();

            $comment = $this->db->prepare(CommentQueries::ADD);

            $comment->bindParam(':id_account', $account->id_account, PDO::PARAM_INT);
            $comment->bindParam(':id_game', $game->id_game, PDO::PARAM_INT);
            $comment->bindParam(':date_comment', $date, PDO::PARAM_STR);
            $comment->bindParam(':comment', $message, PDO::PARAM_STR);

            if (!$comment || ($comment instanceof PDOException) || !$comment->execute()) {
                return false;
            }

            return true;
        }
    }
