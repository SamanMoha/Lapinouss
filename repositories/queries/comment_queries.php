<?php
    class CommentQueries {

        const FIND_BY_ACCOUNT_ID = "
                        SELECT * 
                        FROM comment 
                        WHERE id_account = :id_account
                ;";

        const FIND_BY_GAME_ID = "
                        SELECT * 
                        FROM comment 
                        WHERE id_game = :id_game
                ;";

        const ADD = "
                    INSERT INTO comment (comment, date_comment, id_account, id_game) 
                    VALUE (
                        :comment,
                        :date_comment,
                        :id_account,
                        :id_game
                    )
        ;";
    }
