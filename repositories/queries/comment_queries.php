<?php
    class CommentQueries {

        const FIND_BY_ACCOUNT_ID = "
                        SELECT * 
                        FROM comment 
                        WHERE id_account = :id_account
                ";

        const FIND_BY_GAME_ID = "
                        SELECT * 
                        FROM comment 
                        WHERE id_game = :id_game
                ";
    }
