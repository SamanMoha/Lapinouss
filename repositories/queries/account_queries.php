<?php
    class AccountQueries {

        const LOGIN = "
                    SELECT *
                    FROM account
                    WHERE email = :email
                      AND password = :password
                ";

        const REGISTER = "";
    }
?>