<?php
    class AccountQueries {

        const LOGIN = "
                    SELECT *
                    FROM account
                    WHERE email = :email
                      AND password = :password
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
                                :password, 
                                :first_name,
                                :last_name
                            );";

        const FIND_ALL_CHILDREN = "
                            SELECT *
                            FROM child_account c
                            LEFT JOIN parent_has_child phc ON phc.id_child_account = c.id_child_account
                            WHERE phc.id_account = :id_account
                    ";

        const FIND_BY_ID = "
                    SELECT * 
                    FROM account 
                    WHERE id_account = :id_account
            ";

        const EXISTS = "
                    SELECT *
                    FROM account
                    WHERE email = :email
                ;";
    }
