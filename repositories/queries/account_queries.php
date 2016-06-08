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
                                uid, 
                                email, 
                                password, 
                                first_name, 
                                first_name, 
                                birth_date, 
                                created_date
                            )
                            VALUES (
                                :permission, 
                                :uid, 
                                :email,
                                :password, 
                                :first_name,
                                :last_name, 
                                :birth_date, 
                                :created_date
                            );";


        const FIND_ALL_CHILDREN = "
                            SELECT *
                            FROM child_account c
                            LEFT JOIN parent_has_child phc ON phc.id_child_account = c.id_child_account
                            WHERE phc.id_account = :id_account
                    ";
    }
