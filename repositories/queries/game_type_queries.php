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
                SELECT g.*
                FROM game g
                INNER JOIN game_type gt ON gt.id_game_type = g.id_game_type 
                INNER JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                INNER JOIN account a ON a.id_account = dgt.id_account 
                WHERE a.id_account = :id_account
                  AND available = 1 
        ";

    const FIND_ALL_BY_CHILD = "
                SELECT g.*
                FROM game g 
                INNER JOIN game_type gt ON gt.id_game_type = g.id_game_type 
                INNER JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                INNER JOIN account a ON a.id_account = dgt.id_account
                INNER JOIN parent_has_child phc ON phc.id_account = a.id_account
                INNER JOIN child_account ca ON ca.id_child_account = phc.id_child_account 
                WHERE ca.id_child_account = :id_child_account 
                  AND Available = 1 
        ";

    const FIND_BY_CHILD = "
                SELECT g.*
                FROM game g
                INNER JOIN game_type gt ON gt.id_game_type = g.id_game_type 
                INNER JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                INNER JOIN account a ON a.id_account = dgt.id_account
                INNER JOIN parent_has_child phc ON phc.id_account = a.id_account
                INNER JOIN child_account ca ON ca.id_child_account = phc.id_child_account
                WHERE ca.id_child_account = :id_child_account
                  AND g.id_game = :id_game 
                  AND available = 1 
        ";

    const BUY = "INSERT INTO downloaded_game_type
                            (
                                id_account, 
                                id_game_type
                            )
                            VALUES (
                                :id_account, 
                                :id_game_type
                            );";

    const DELETE = "DELETE FROM downloaded_game_type
                    WHERE id_account = :id_account 
                        AND id_game_type = :id_game_type
                    ;";

    const IS_ALREADY_BOUGHT = "
                        SELECT *  
                        FROM downloaded_game_type 
                        WHERE id_game_type = :id_game_type
                          AND id_account = :id_account
                    ;";
}