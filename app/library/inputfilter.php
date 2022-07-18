<?php

    namespace PHPMVC\LIBRARY ;

    trait InputFilter
    {
        public function filterInt($input)
        {
            return filter_var($input , FILTER_SANITIZE_NUMBER_INT);
        }

        public function filterFloat($input)
        {
            return filter_var($input , FILTER_SANITIZE_NUMBER_FLOAT , FILTER_FLAG_ALLOW_FRACTION);
        }

        public function filterString($input)
        {
            return htmlentities(strip_tags($input) , ENT_QUOTES , 'UTF-8') ;
        }

        public function filterStringArray(array $arr)
        {
            foreach ($arr as $key => $value) {
                $arr[$key] = htmlentities(filter_var(trim($value), FILTER_SANITIZE_STRING), ENT_QUOTES, 'utf-8');
            }
            return $arr;
        }
    }