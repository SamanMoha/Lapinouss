<?php
    class ChildQueries {

        const LOGIN = "
                        SELECT ca.*
                        FROM child_account ca
                        INNER JOIN parent_has_child phc ON phc.id_child_account = ca.id_child_account
                        INNER JOIN account a ON a.id_account = phc.id_account
                        WHERE ca.first_name LIKE :first_name
                          AND ca.last_name LIKE :last_name
                          AND ca.password = SHA1(:password)
                          AND a.email = :parent_email
                    ;";

        const REGISTER = "INSERT INTO child_account 
                            (
                                password, 
                                first_name, 
                                last_name
                            )
                            VALUES (
                                SHA1(:password), 
                                :first_name,
                                :last_name
                            );
                            
                            INSERT INTO parent_has_child
                            (
                                id_account,
                                id_child_account
                            )
                            VALUES
                            (
                                :id_account,
                                LAST_INSERT_ID()
                            );";

        const EXISTS = "
                        SELECT ca.*
                        FROM child_account ca
                        INNER JOIN parent_has_child phc ON phc.id_child_account = ca.id_child_account
                        INNER JOIN account a ON a.id_account = phc.id_account
                        WHERE ca.first_name LIKE :first_name
                          AND ca.last_name LIKE :last_name
                          AND a.id_account = :id_account
                    ;";

        const PLAYED = "
                    SELECT *
                    FROM played 
                    WHERE id_game = :id_game
                      AND id_child_account = :id_child_account
                ";

        const TROPHY = "
                    SELECT t.*, s.*
                    FROM success s
                    INNER JOIN trophy t ON t.id_trophy = s.id_trophy
                    INNER JOIN game_has_trophy ght ON ght.id_trophy = t.id_trophy
                    INNER JOIN game g ON g.id_game = ght.id_game
                    WHERE g.id_game = :id_game
                      AND s.id_child_account = :id_child_account
                ";

        const DELETE = "
                        DELETE FROM success
                        WHERE id_child_account = :id_child_account;
                        
                        DELETE FROM played
                        WHERE id_child_account = :id_child_account;
                        
                        DELETE FROM child_account_has_downloaded_game
                        WHERE id_child_account = :id_child_account;
                        
                        DELETE FROM parent_has_child
                        WHERE id_child_account = :id_child_account;
                        
                        DELETE FROM child_account
                        WHERE id_child_account = :id_child_account;
                ;";
    }
