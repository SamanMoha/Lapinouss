<?php
    class GameQueries {

        const ALL = "
                        SELECT *  
                        FROM game 
                    ;";

        const FIND_BY_ID = "
                        SELECT *  
                        FROM game 
                        WHERE id_game = :id_game
                    ;";

        const FIND_ALL_BY_PARENT = "
                SELECT g.*
                FROM game g
                INNER JOIN downloaded_game dgt ON dgt.id_game = g.id_game 
                INNER JOIN account a ON a.id_account = dgt.id_account 
                WHERE a.id_account = :id_account
                  AND available = 1 
        ;";

        const FIND_ALL_BY_CHILD = "
                SELECT g.*
                FROM game g 
                INNER JOIN game_type gt ON gt.id_game_type = g.id_game_type 
                INNER JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                INNER JOIN account a ON a.id_account = dgt.id_account
                INNER JOIN parent_has_child phc ON phc.id_account = a.id_account
                INNER JOIN child_account ca ON ca.id_child_account = phc.id_child_account 
                WHERE ca.id_child_account = :id_child_account 
                  AND available = 1 
        ;";

        const FIND_BY_CHILD = "
                SELECT g.*
                FROM game g
                INNER JOIN child_account_has_downloaded_game chg ON chg.downloaded_game_id_game = g.id_game
                WHERE chg.id_child_account = :id_child_account
                  AND g.id_game = :id_game 
                  AND g.available = 1 
       ; ";

        const FIND_BY_PARENT = "
                SELECT g.*
                FROM game g
                INNER JOIN downloaded_game dg ON dg.id_game = g.id_game 
                WHERE dg.id_account = :id_account
                  AND g.id_game = :id_game 
                  AND g.available = 1 
        ;";

        const FIND_ALL_BY_TYPE = "
                        SELECT *  
                        FROM game 
                        WHERE id_game_type = :id_game_type
                    ;";

        const BUY = "INSERT INTO downloaded_game
                            (
                                id_account, 
                                id_game
                            )
                            VALUES (
                                :id_account, 
                                :id_game
                            );";


        const DELETE = "DELETE FROM downloaded_game
                    WHERE id_account = :id_account 
                        AND id_game = :id_game
                    ;";

        const IS_ALREADY_BOUGHT = "
                            SELECT *  
                            FROM downloaded_game
                            WHERE id_game = :id_game
                              AND id_account = :id_account
                        ;";

        const ALLOW_GAME_FOR_CHILD = "INSERT INTO child_account_has_downloaded_game
                            (
                                id_child_account, 
                                downloaded_game_id_game,
                                downloaded_game_id_account
                            )
                            VALUES (
                                :id_child_account, 
                                :id_game,
                                :id_account
                            );";

        const DECLINE_GAME_FOR_CHILD = "DELETE FROM child_account_has_downloaded_game
                    WHERE id_child_account = :id_child_account 
                        AND downloaded_game_id_game = :id_game 
                        AND downloaded_game_id_account = :id_account
                    ;";
    }