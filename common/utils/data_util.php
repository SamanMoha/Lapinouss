<?php
    class DataUtil {

        static function generateUid($size = 25) {
            return substr(
                md5(
                    uniqid(
                        rand(),
                        true)
                ),
                0,
                $size
            );
        }
    }