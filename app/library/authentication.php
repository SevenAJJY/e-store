<?php

    namespace PHPMVC\LIBRARY ;

    ### -> Authentication We will use it to find out if the user is Log in or not
    ### -> authentication = المصادقة
    class Authentication
    {
        private static $_instance;
        private $_session;

        ### -> Excluded Routes to not be sure of them with the Privileges  الاستثناءات
        private $_execludedRoutes = 
        [
            '/index/default' ,
            '/auth/logout' ,
            '/users/profile' ,
            '/users/changepasssword' ,
            '/users/checkuserexistsajax' ,
            '/users/checkemailexistsajax' ,
            '/users/settings' ,
            '/language/default' ,
            '/accessdenied/default' ,
            '/notfound/notfound',
            '/users/profile',
            '/users/editprofile',
            '/users/changepassword',
            '/users/view',
            '/test/default',
        ];

        private function __construct($session)
        {
            $this->_session = $session;
        }

        private function __clone(){}

        public static function getInstance(SessionManager $session)
        {
            if (self::$_instance === null) {
                self::$_instance = new self($session) ;
            }
            return self::$_instance;
        }

        ### -> Redirect the user to the login page if he is not logged in to prevent him from using the application 
        ### -> For example, if the user entered from a certain URL in the application and is not registered, he will be taken to the login page.
        ### -> ($this->_session->u) User information will be stored when logging in
        ### -> Authorized = مخول
        public function isAuthorized()
        {
            return isset($this->_session->u);
        }   

        public function hasAccess($controller, $action)
        {
            $url = strtolower('/'.$controller.'/'.$action);
            if (in_array($url,$this->_execludedRoutes) || in_array($url, $this->_session->u->privileges)) {
                return true ;
            }
        }
    }