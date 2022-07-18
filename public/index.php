<?php

   namespace PHPMVC;

   use PHPMVC\LIBRARY\FrontController;
   use PHPMVC\LIBRARY\Template\Template;
   use PHPMVC\LIBRARY\SessionManager;
   use PHPMVC\LIBRARY\Registry;
   use PHPMVC\LIBRARY\Language;
   use PHPMVC\LIBRARY\Messenger;
   use PHPMVC\LIBRARY\Authentication;

   defined('DS') or define('DS' , DIRECTORY_SEPARATOR);

   require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php' ;
   require_once APP_PATH . DS . 'library' . DS . 'autoload.php' ;

   $session = new SessionManager();
   $session->start();
   
   if (!isset($session->lang)) {
      $session->lang = APP_DEFAULT_LANGUAGE ;
   }

   $template_parts = require_once '..' . DS . 'app' . DS . 'config' . DS . 'templateconfig.php';

   $template = new Template($template_parts) ;
   
   $language = new Language() ;

   $messenger = Messenger::getInstance($session);

   $authentication = Authentication::getInstance($session);
   
   ### -> Which object we will make in index.php and we will need in Controller we will pass it in our Registry()
   $registry = Registry::getInstance();
   $registry->session = $session;
   $registry->language = $language;
   $registry->messenger = $messenger;

   $frontcontroller = new FrontController($template, $registry, $authentication);
   $frontcontroller->dispatch();
?>








