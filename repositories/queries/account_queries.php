<?php
    class AccountQueries {

        const LOGIN = "
                    SELECT *
                    FROM account
                    WHERE email = :email
                      AND password = SHA1(:password)
                ;";

        const REGISTER = "INSERT INTO account 
                            (
                                permission,
                                email, 
                                password, 
                                first_name, 
                                last_name
                            )
                            VALUES (
                                :permission,
                                :email,
                                SHA1(:password), 
                                :first_name,
                                :last_name
                            );";

        const FIND_ALL_CHILDREN = "
                            SELECT c.*
                            FROM child_account c
                            LEFT JOIN parent_has_child phc ON phc.id_child_account = c.id_child_account
                            WHERE phc.id_account = :id_account
                    ;";

        const FIND_ALL_CHILDREN_PERMISSIONS = "
                            SELECT c.*
                            FROM child_account c
                            LEFT JOIN child_account_has_downloaded_game chg ON chg.id_child_account = c.id_child_account 
                            LEFT JOIN parent_has_child phc ON phc.id_child_account = c.id_child_account
                            WHERE phc.id_account = :id_account
                              AND chg.downloaded_game_id_game = :id_game
        ;";

        const FIND_BY_ID = "
                    SELECT * 
                    FROM account 
                    WHERE id_account = :id_account
            ;";

        const EXISTS = "
                    SELECT *
                    FROM account
                    WHERE email = :email
                ;";
    }
