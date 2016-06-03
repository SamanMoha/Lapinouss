<?php
    class ChildQueries {

        const LOGIN = "
                        SELECT *
                        FROM child_account
                        WHERE email = :email
                          AND password = :password
                    ;";

        const REGISTER = "INSERT INTO child_account (permission, uid, email, password, first_name, last_name, birth_date, created_date)
                                VALUES (:permission, :uid, :email, :password, :first_name, :last_name, :birth_date, :created_date);";
    }
