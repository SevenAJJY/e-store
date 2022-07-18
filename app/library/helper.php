<?php

    namespace PHPMVC\LIBRARY ;

    trait Helper
    {
        /**
         * @param $route string
         * The path to route to and end execution of the script
         */
        public function redirect($path)
        {
            session_write_close();
            header('location: '.$path);
            exit();
        }

        public function redirectBack($path)
        {
            session_write_close();
            if (array_key_exists("HTTP_REFERER",$_SERVER)) {
                $path = $_SERVER["HTTP_REFERER"] ;
            }
            header("location: ".$path);
            exit();
        }
    }
    