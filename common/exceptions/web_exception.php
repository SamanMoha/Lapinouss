<?php
    class WebException {

        function __construct($message = '')
        {
            redirect('home', 'error', $message);
        }
    }