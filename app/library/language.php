<?php
    namespace PHPMVC\LIBRARY;

    class Language 
    {
        private $dictionary = [] ;

        public function load($path)
        {
            $defaultLanguage = APP_DEFAULT_LANGUAGE ;
            if(isset($_SESSION['lang'])){
                $defaultLanguage = $_SESSION['lang'] ;
            }
            $pathArray = explode('.',$path);
            $languageFileToLoad = LANGUAGE_PATH .  $defaultLanguage . DS . $pathArray[0] . DS . $pathArray[1] .'.lang.php' ;
            if (file_exists($languageFileToLoad)) {
                require_once $languageFileToLoad ;
                if (is_array($_) && !empty($_)) {
                    foreach($_ as $key => $value)
                    {
                        $this->dictionary[$key] = $value ;
                    }
                }
            }
            else {
                trigger_error('Sorry the language file ' . $path .' Doesn\'t Exixts'.E_USER_WARNING) ;
            }
        }
        
        public function get($key)
        {
            if (array_key_exists($key ,$this->dictionary)) {
                return $this->dictionary[$key] ;
            }
        }  
        
        public function feedKey($key, $data)
        {
            if (array_key_exists($key ,$this->getDictionary())) {
                array_unshift($data , $this->dictionary[$key]);
                return call_user_func_array('sprintf',$data);
            }
        } 

        public function feed($key, $replace)
        {
            if(array_key_exists($key, $this->dictionary)) {
                array_unshift($replace, $this->dictionary[$key]);
                $this->dictionary[$key] = call_user_func_array('sprintf', $replace);
            }
        }


        public function getDictionary()
        {
            return $this->dictionary ;
        }
    }