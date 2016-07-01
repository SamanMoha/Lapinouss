<?php
    class ChildQueries {

        const LOGIN = "
                        SELECT *
                        FROM child_account
                        WHERE uid = :uid
                          AND password = :password
                    ;";

        const REGISTER = "INSERT INTO child_account 
                            (
                                permission, 
                                uid,
                                password, 
                                first_name, 
                                last_name, 
                                birth_date, 
                                created_date
                            )
                            VALUES (
                                'Enfant', 
                                :uid,
                                :password, 
                                :first_name,
                                :last_name, 
                                :birth_date, 
                                :created_date
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
                    SELECT *
                    FROM child_account
                    WHERE uid = :uid
                ;";
    }
