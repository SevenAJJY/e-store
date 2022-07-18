<?php

    namespace PHPMVC\LIBRARY\Template ;

    trait TemplateHelper
    {
        public function matchUrl($url)
        {
            return parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) === $url;
        }

        public function highlightMenu($controller)
        {
            $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            @list($cont) = explode('/', $url, 2);
            if(!isset($cont) || empty($cont)) {
                $cont = 'index';
            }
    
            if(is_array($controller) && in_array(strtolower($cont), $controller)) {
                return true;
            } else if(strtolower($cont) === $controller) {
                return true;
            }
            return false;
        }

        # -> function to help me when I made a mistake in a field vrs1
        // public function showValue($fielfName , $object = null)
        // {
        //     return isset($_POST[$fielfName]) ? $_POST[$fielfName] : (is_null($object) ? '' : $object->$fielfName) ; 
        // }

        # -> vrs2
        public function showValue($fieldName, $object = null, $defaultValue = false)
        {
            return isset($_POST[$fieldName]) ? $_POST[$fieldName] : ($object === null ? ($defaultValue === false ? '' : $defaultValue) : $object->$fieldName);
        }
    
        # -> function to help me when I made a mistake in a field
        public function seletedIf($fielfName , $value , $object = null)
        {
            return ((isset($_POST[$fielfName]) && $_POST[$fielfName] == $value) || (!is_null($object) && $object->$fielfName  == $value)) ? 'selected="selected"' : '' ; 
        }

        public function boxCheckedIf($fieldName, $value, $object = null)
        {
            return (isset($_POST[$fieldName]) == $value || ($object !== null && $value == $object->$fieldName)) ? 'checked' : '';
        }
    }