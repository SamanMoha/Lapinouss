<?php
class GameTypeQueries {

    const ALL = "
                        SELECT *  
                        FROM game_type 
                    ;";

    const FIND_BY_ID = "
                        SELECT *  
                        FROM game_type 
                        WHERE id_game_type = :id_game_type
                    ;";

    const FIND_ALL_BY_PARENT = "
                        SELECT DISTINCT gt.* 
                        FROM game_type gt
                        INNER JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                        WHERE dgt.id_account = :id_account
                    ;";

    const FIND_ALL_BY_CHILD = "
                        SELECT DISTINCT gt.* 
                        FROM game_type gt
                        INNER JOIN game g ON g.id_game_type = gt.id_game_type
                        INNER JOIN child_account_has_downloaded_game chg ON chg.downloaded_game_id_game = g.id_game 
                        WHERE chg.id_child_account = :id_child_account
                    ;";

    const FIND_BY_CHILD = "
                        SELECT DISTINCT gt.* 
                        FROM game_type gt
                        INNER JOIN game g ON g.id_game_type = gt.id_game_type
                        INNER JOIN child_account_has_downloaded_game chg ON chg.downloaded_game_id_game = g.id_game 
                        WHERE chg.id_child_account = :id_child_account
                          AND g.id_game = :id_game 
                    ;";

    const BUY = "INSERT INTO downloaded_game_type
                            (
                                id_account, 
                                id_game_type
                            )
                            VALUES (
                                :id_account, 
                                :id_game_type
                            );";

    const DELETE = "
                        DELETE FROM downloaded_game_type
                        WHERE id_account = :id_account 
                        AND id_game_type = :id_game_type;
                        
                        DELETE FROM child_account_has_downloaded_game chg
                        LEFT JOIN game g ON g.id_game = chg.downloaded_game_id_game
                        WHERE chg.downloaded_game_id_account = :id_account;
                        
                        DELETE FROM downloaded_game dg
                        LEFT JOIN game g ON g.id_game = dg.id_game
                        WHERE dg.id_account = :id_account;
                    ";

    const IS_ALREADY_BOUGHT = "
                        SELECT *  
                        FROM downloaded_game_type 
                        WHERE id_game_type = :id_game_type
                          AND id_account = :id_account
                    ;";
}