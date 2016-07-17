<?php
    class ChildQueries {

        const LOGIN = "
                        SELECT ca.*
                        FROM child_account ca
                        INNER JOIN parent_has_child phc ON phc.id_child_account = ca.id_child_account
                        INNER JOIN account a ON a.id_account = phc.id_account
                        WHERE ca.first_name LIKE :first_name
                          AND ca.last_name LIKE :last_name
                          AND ca.password = :password
                          AND a.email = :parent_email
                    ;";

        const REGISTER = "INSERT INTO child_account 
                            (
                                password, 
                                first_name, 
                                last_name
                            )
                            VALUES (
                                :password, 
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
                          AND ca.password = :password
                          AND a.id_account = :id_account
                    ;";
    }
