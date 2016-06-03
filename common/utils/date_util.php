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
    }