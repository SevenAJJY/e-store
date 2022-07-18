<?php

    namespace PHPMVC\LIBRARY;

    trait Validate
    {
        // Req
        // num
            // int
                // eq lt gt min max bwtween
            //float
                // (M,D)
        // alpha
            // eq lt gt min max bwtween
        // alphaNum
            // eq lt gt min max bwtween
        // email
        // date
            //YYYY-mm-dd
        // url

        private $_regexPatterns = [
            'num'           => '/^[0-9]+(?:\.[0-9]+)?$/',
            'int'           => '/^[0-9]+$/',
            'float'         => '/^[0-9]+\.[0-9]+$/',
            'alpha'         => '/^[a-zA-Z\p{Arabic} ]+$/u',
            'alphanum'      => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
            'vdate'          => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
            'email'         => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'url'           => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ];

        public function req($value)
        {
            return '' != $value || !empty($value);
        }

        public function num($value)
        {
            return (bool) preg_match($this->_regexPatterns['num'] ,$value);
        }

        public function int($value)
        {
            return (bool) preg_match($this->_regexPatterns['int'] ,$value);
        }

        public function float($value)
        {
            return (bool) preg_match($this->_regexPatterns['float'] ,$value);
        }   

        public function alpha($value)
        {
            return (bool) preg_match($this->_regexPatterns['alpha'] ,$value);
        }

        public function alphanum($value)
        {
            return (bool) preg_match($this->_regexPatterns['alphanum'] ,$value);
        }

        ### -> function Equal
        public function eq($value , $matchAgainst)
        {
            return $value == $matchAgainst;
        }

        ### -> function Equal Field
        public function eq_field($value , $otherFieldValue)
        {
            return $value == $otherFieldValue;
        }

        ### -> function Less Than
        public function lt($value , $matchAgainst)
        {
            if(is_string($value)) {
                return mb_strlen($value) < $matchAgainst;
            } elseif (is_numeric($value)) {
                return $value < $matchAgainst;
            }
        }

        ### -> function Greater Than
        public function gt($value , $matchAgainst)
        {
            if(is_string($value)) {
                return mb_strlen($value) > $matchAgainst;
            } 
            elseif (is_numeric($value)) {
                return $value > $matchAgainst;
            }
        }

        ### -> function Min
        public function min($value , $min)
        {
            if(is_string($value)) {
                return mb_strlen($value) >= $min;
            } 
            elseif (is_numeric($value)) {
                return $value >= $min;
            }
        }

        ### -> function Max
        public function max($value , $max)
        {
            if (is_String($value)) {
                return mb_strlen($value) <= $max;
            }
            elseif (is_numeric($value)) {
                return $value <= $max ;
            }
        }

        ### -> function between
        public function between($value , $min , $max)
        {
            if(is_string($value)) {
                return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
            } 
            elseif (is_numeric($value)) {
                return $value >= $min && $value <= $max;
            }
        }

        ### -> Find out how many digits are after the comma and before it in the decimal numbers
        public function floatlike($value , $beforeDP , $afterDP)
        {
            if (!$this->float($value)) {
                return false ;
            }
            $pattern = '/^[0-9]{'. $beforeDP .'}\.[0-9]{'. $afterDP .'}$/';
            return (bool) preg_match($pattern ,$value);
        }

        ### -> validate date (Date format MySQL 'YYYY-MM-DD')
        public function vdate($value)
        {
            return (bool) preg_match($this->_regexPatterns['vdate'], $value);
        }
        ### -> validate Email
        public function email($value)
        {
            return (bool) preg_match($this->_regexPatterns['email'], $value);
        }
    
        ### -> validate URL
        public function url($value)
        {
            return (bool) preg_match($this->_regexPatterns['url'], $value);
        }

        public function isValid($roles , $inputType = 'post')
        {
            $errors = [] ;
            if (!empty($roles)) {
                foreach ($roles as $fieldName => $validationRoles) {
                    $value = $inputType[$fieldName] ;
                    $validationRoles = explode('|' , $validationRoles) ;
                    foreach ($validationRoles as $validationRole) {
                        ### -> To Shows at least one error in the field
                        ### -> hna f foreach fach tkml roles ila l9at f array dyl errors field name kain using array_key_exists() adir continue bach iduz lvalidation roles li b3dha o ghadi itl3 lina error w7d 3la a9al
                        if (array_key_exists($fieldName, $errors))  
                            continue;
                        ### -> in case of min role
                        if (preg_match_all('/(min)\((\d+)\)/' , $validationRole , $m)) { ## hna ayl9lb  fstring kaml o li l9aha ay7tha f $m 
                            if ($this->min($value,$m[2][0]) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_'.$m[1][0] , [$this->language->get('text_label_'.$fieldName),$m[2][0]]),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }

                        ### -> in case of max role
                        elseif (preg_match_all('/(max)\((\d+)\)/' , $validationRole , $m)) { 
                            if ($this->max($value,$m[2][0]) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $m[1][0] , [$this->language->get('text_label_' . $fieldName),$m[2][0]]),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                        ### -> in case of less than role
                        elseif (preg_match_all('/(lt)\((\d+)\)/' , $validationRole , $m)) { 
                            if ($this->lt($value,$m[2][0]) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $m[1][0] , [$this->language->get('text_label_' . $fieldName),$m[2][0]]),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                        ### -> in case of greater than role
                        elseif (preg_match_all('/(gt)\((\d+)\)/' , $validationRole , $m)) { 
                            if ($this->gt($value,$m[2][0]) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $m[1][0] , [$this->language->get('text_label_' . $fieldName),$m[2][0]]),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                        ### -> in case of between than role
                        elseif (preg_match_all('/(between)\((\d+),(\d+)\)/' , $validationRole , $m)) { 
                            if ($this->between($value,$m[2][0],$m[3][0]) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $m[1][0] , [$this->language->get('text_label_' . $fieldName),$m[2][0],$m[3][0]]  ),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                        ### -> in case of floatlike than role
                        elseif (preg_match_all('/(floatlike)\((\d+),(\d+)\)/' , $validationRole , $m)) { 
                            if ($this->floatlike($value,$m[2][0],$m[3][0]) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $m[1][0] , [$this->language->get('text_label_' . $fieldName),$m[2][0],$m[3][0]]  ),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                        ### -> in case of equal role
                        elseif (preg_match_all('/(eq)\((\w+)\)/' , $validationRole , $m)) { 
                            if ($this->eq($value,$m[2][0]) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $m[1][0] , [$this->language->get('text_label_' . $fieldName),$m[2][0]]),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                        ### -> in case of equal role
                        elseif (preg_match_all('/(eq_field)\((\w+)\)/' , $validationRole , $m)) {
                            $otherFieldValue =  $inputType[$m[2][0]] ;
                            if ($this->eq_field($value,$otherFieldValue) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $m[1][0] , [$this->language->get('text_label_' . $fieldName),$this->language->get('text_label_' . $m[2][0])]),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                        else {
                            if ($this->$validationRole($value) === false) {
                                $this->messenger->add(
                                    $this->language->feedKey('text_error_' . $validationRole , [$this->language->get('text_label_' . $fieldName)]),
                                    Messenger::APP_MESSAGE_ERROR    
                                );
                                $errors[$fieldName] = true;
                            }
                        }
                    }
                }
            }
            return empty($errors) ? true : false ;
        }
    }