<?php
    class WebException {

        function __construct($message)
        {
            echo '<script>alert("' . $message . '");</script>';
        }
    }