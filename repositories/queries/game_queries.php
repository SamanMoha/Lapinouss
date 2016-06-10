<?php
    class GameQueries {

        const ALL = "
                        SELECT * 
                        FROM game
                    ;";

        const FIND_ALL_BY_PARENT = "
                SELECT * 
                FROM game g 
                WHERE g.id_account = :id_account
        ";

        const FIND_ALL_BY_CHILD = "
                SELECT *, g.uid as uid
                FROM game g 
                LEFT JOIN account a ON a.id_account = g.id_account
                LEFT JOIN parent_has_child phc ON phc.id_account = a.id_account
                LEFT JOIN child_account ca ON ca.id_child_account = phc.id_child_account
                WHERE ca.id_child_account = :id_child_account
        ";

        const FIND_BY_CHILD = "
                SELECT *, g.uid as uid
                FROM game g
                LEFT JOIN account a ON a.id_account = g.id_account
                LEFT JOIN parent_has_child phc ON phc.id_account = a.id_account
                LEFT JOIN child_account ca ON ca.id_child_account = phc.id_child_account
                WHERE ca.id_child_account = :id_child_account
                  AND g.uid = :game_uid
        ";
    }