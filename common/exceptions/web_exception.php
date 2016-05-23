<?php
    class WebException extends Exception {

        function __construct($message)
        {
            @set_exception_handler(array('WebException', 'exception_handler'));

            parent::__construct($message);
        }

        public static function exception_handler($exception) {
            echo "Erreur: Veuillez contacter l'administrateur <br/>";

            echo '<!-- Uncaught exception: ' . $exception->getMessage() . ' -->';
        }
    }
?>