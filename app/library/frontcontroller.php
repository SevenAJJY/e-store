<?php

    namespace PHPMVC\LIBRARY;
    use PHPMVC\LIBRARY\Template\Template ;
    
    class FrontController
    {
        use Helper ;

        const NOT_FOUND_ACTION = 'notFoundAction' ;
        const NOT_FOUND_CONTROLLER = 'PHPMVC\Controllers\NotFoundController' ;

        private $_controller = 'index' ; 
        private $_action = 'default' ;
        private $_params = array() ;

        private $_template ;
        private $_registry;
        private $_authentication;

        public function __construct(Template $template ,Registry $registry ,Authentication $auth)
        {
            $this->_template = $template ;
            $this->_registry = $registry ;
            $this->_authentication = $auth ;
            $this->_parseUrl() ;
        }

        private function _parseUrl()
        {
            #hna anchdo url o ghdin ndir remove L'(/) after remove slach achdo url o ghdin nrdoh 3la chkl array m9smaha 3la 3 controller/acion/params
            $url =  explode('/' , trim(parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) , '/') , 3);
            #If there are values in $url, he will take it. If not, he will take the default values
            if (isset($url[0]) && $url[0] != '') {
                $this->_controller = $url[0];
            }
            if (isset($url[1]) && $url[1] != '') {
                $this->_action = $url[1];
            }
            if (isset($url[2]) && $url[2] != '') {
                $this->_params = explode('/' , $url[2]);
            }
        }

        ### -> By dispatch the controller, procedure and parameters of the URL will be sent to our controllers
        public function dispatch()
        {   
            $controllerClassName = 'PHPMVC\Controllers\\' . ucfirst($this->_controller) . 'Controller' ;
            $actionName = $this->_action . 'Action' ;


            ### -> check if user is authorized to access the appplication
            ### -> Here if you are not registered and try to log in to any Controllers, it will direct you to /auth/login to make the login
            if (!$this->_authentication->isAuthorized()) {
                if ($this->_controller != 'auth' && $this->_action != 'login') {
                    $this->redirect('/auth/login');
                }
            }else {
                ### -> Here if the user is registered and tries to return to a page /auth/login without logging out, we will direct him to the home page
                ### -> But if he clicks on a link that leads him to a page /auth/login we will direct him to the page from which he clicked on the link via $_SERVER['HTTP_REFERER']
                ### -> summary : deny access to the /auth/login
                if ($this->_controller == 'auth' && $this->_action == 'login') {
                    isset($_SERVER['HTTP_REFERER']) ? $this->redirect($_SERVER['HTTP_REFERER']) : $this->redirect('/') ;
                }
                ### -> check if the user has access to Specific URL
                if ((bool) CHECK_FOR_PRIVILEGES === true) {
                    if (!$this->_authentication->hasAccess($this->_controller, $this->_action)) {
                        $this->redirect('/accessdenied');
                    }
                }
            }

            # ila had controller li wslna mn url makainch 3ndna ghadi nsyftouch NotFoundController.php
            # ou ghadin nt2akdo mn action li ghadi twslna mn url ila mknatch ghdi ndiwh NotFoundAction;
            if (!class_exists($controllerClassName) || !method_exists($controllerClassName , $actionName)) {
                $controllerClassName = self::NOT_FOUND_CONTROLLER ;
                $this->_action = $actionName = self::NOT_FOUND_ACTION;
            }

            # an9ado obj mn controller liwslna mn url ya khawi ya 3mr mohim kaina default value
            $controller = new $controllerClassName() ;
            
            $controller->setController($this->_controller);
            $controller->setAction($this->_action);
            $controller->setParams($this->_params);
            $controller->setTemplate($this->_template);
            $controller->setRegistry($this->_registry);
            $controller->$actionName() ;
        }
    }