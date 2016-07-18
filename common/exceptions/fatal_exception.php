<?php
    class FatalException extends Exception {

        function __construct($message) {
            @set_exception_handler(array('FatalException', 'exception_handler'));

            parent::__construct($message);
        }

        public static function exception_handler($exception) {
            echo "Erreur: Veuillez contacter l'administrateur <br/>";

            echo '<!-- Uncaught exception: ' . $exception->getMessage() . ' -->';
        }
    }