<?php
    class GameQueries {

        const ALL = "
                        SELECT *  
                        FROM game 
                          AND available = 1 
                    ;";

        const FIND_BY_ID = "
                        SELECT *  
                        FROM game 
                        WHERE id_game = :id_game
                          AND available = 1 
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
                INNER JOIN child_account_has_downloaded_game chg ON chg.downloaded_game_id_game = g.id_game
                INNER JOIN child_account ca ON ca.id_child_account = chg.id_child_account
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
                          AND available = 1 
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

        const PLAYED = "
                        SELECT *  
                        FROM played 
                        WHERE id_game = :id_game
                          AND id_child_account = :id_child_account
                    ;";

        const PLAY_INSERT = "INSERT INTO played
                            (
                                played_time, 
                                date_game, 
                                id_game, 
                                id_child_account
                            )
                            VALUES (
                                0,
                                NOW(),
                                :id_game,
                                :id_child_account 
                            );";

        const PLAY_UPDATE = "UPDATE played 
                        SET played_time = played_time + 1
                            AND date_game = NOW()
                        WHERE id_game = :id_game
                          AND id_child_account = :id_child_account
                    ;";

        const WIN  = "INSERT INTO success
                            (obtention_date, id_trophy, id_child_account)
                            SELECT
                                NOW(),
                                t.id_trophy,
                                :id_child_account 
                            FROM trophy t
                            INNER JOIN game_has_trophy ght ON ght.id_trophy = t.id_trophy
                            INNER JOIN game g ON g.id_game = ght.id_game
                            WHERE g.id_game = :id_game
                              AND t.name like :trophy_name
                        ;";

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