<?php
    class ErrorUtil {

        static function getErrorMessage($code = '') {
            switch ($code) {
                case 'PERMISSION_ALLOW':
                    return "Erreur lors de l'accord de permission.";

                case 'USER_INCORRECT':
                    return "Adresse e-mail/mot de passe incorrect !";

                case 'UNKNOWN_USER':
                    return "Utilisateur non reconnu !";

                case 'PWD_LENGTH_8':
                    return 'Le mot de passe doit contenir au moins 8 caract&egrave;res.';

                case 'EMAIL_USED':
                    return "L'adresse email est deja utlisée !";

                case 'PWD_EQUAL':
                    return "Les mots de passes doivent etre identiques !";

                case 'PWD_LENGTH_6':
                    return "Le mot de passe doit contenir au moins 6 caractères.";

                case 'REGISTRATION':
                    return "Erreur lors de l'inscription.";

                case 'CHILD_DELETE':
                    return "Erreur lors de la suppression du compte enfant.";

                case 'ADD_COMMENT':
                    return "Erreur lors de l'ajout du commentaire.";

                case 'UNKNOWN':
                default:
                    return "Oops une erreur est survenue ...";
            }
        }
    }