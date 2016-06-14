<?php
    class GameQueries {

        const ALL = "
                        SELECT * 
                        FROM game
                    ;";

        const FIND_ALL_BY_PARENT = "
                SELECT * 
                FROM game g 
                LEFT JOIN game_type gt ON gt.id_game_type = g.id_game_type 
                LEFT JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                LEFT JOIN account a ON a.id_account = dgt.id_account 
                WHERE a.id_account = :id_account
                  AND Available = 1 
        ";

        const FIND_ALL_BY_CHILD = "
                SELECT g.*
                FROM game g 
                LEFT JOIN game_type gt ON gt.id_game_type = g.id_game_type 
                LEFT JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                LEFT JOIN account a ON a.id_account = dgt.id_account
                LEFT JOIN parent_has_child phc ON phc.id_account = a.id_account
                LEFT JOIN child_account ca ON ca.id_child_account = phc.id_child_account
                WHERE ca.id_child_account = :id_child_account
                  AND Available = 1 
        ";

        const FIND_BY_CHILD = "
                SELECT g.*
                FROM game g
                LEFT JOIN game_type gt ON gt.id_game_type = g.id_game_type 
                LEFT JOIN downloaded_game_type dgt ON dgt.id_game_type = gt.id_game_type 
                LEFT JOIN account a ON a.id_account = dgt.id_account
                LEFT JOIN parent_has_child phc ON phc.id_account = a.id_account
                LEFT JOIN child_account ca ON ca.id_child_account = phc.id_child_account
                WHERE ca.id_child_account = :id_child_account
                  AND g.uid = :game_uid 
                  AND Available = 1 
                  AND activated = 1
        ";
    }