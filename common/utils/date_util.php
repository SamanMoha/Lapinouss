<?php
    class DateUtil {

        static function now($long = false) {
            if ($long) {
                date('Y-m-d H:i:s');
            }
            else {
                return date('Y-m-d');
            }
        }

        static function age($birth) {
            $birth = explode('-', $birth);

            $age = (date('md', date('U', mktime(0, 0, 0, $birth[0], $birth[1], $birth[2]))) > date('md'))
                ? (date('Y') - $birth[0]) - 1
                : date('Y') - $birth[0];

            return $age;
        }

        static function format($birth) {
            $birth = explode('/', $birth);
            
            return $birth[2] . '-' . $birth[1] . '-' . $birth[0];
        }
    }