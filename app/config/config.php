<?php


    defined('DS') or define('DS' , DIRECTORY_SEPARATOR);
    define('APP_PATH' , realpath(dirname(__DIR__)) ) ;
    define('VIEWS_PATH' , APP_PATH . DS . 'views' . DS) ;
    define('TEMPLATE_PATH' , APP_PATH . DS . 'template' . DS ) ;
    define('LANGUAGE_PATH' , APP_PATH . DS . 'languages' . DS ) ;

    define('CSS' , '/css/') ;
    define('JS' , '/js/') ;

    // Database Credentials
    defined('DATABASE_HOST_NAME')       ? null : define ('DATABASE_HOST_NAME', 'localhost');
    defined('DATABASE_USERNAME')        ? null : define ('DATABASE_USERNAME', 'root');
    defined('DATABASE_PASSWORD')        ? null : define ('DATABASE_PASSWORD', '');
    defined('DATABASE_DB_NAME')         ? null : define ('DATABASE_DB_NAME', 'storedb');
    defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
    defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);
    
    //Default application language
    defined('APP_DEFAULT_LANGUAGE')     ? null : define ('APP_DEFAULT_LANGUAGE', 'en');
    
    //Session Configuration
    defined('SESSION_NAME')             ? null : define ('SESSION_NAME', 'ESTORE_SESSION');
    defined('SESSION_LIFE_TIME')        ? null : define ('SESSION_LIFE_TIME', 0);
    defined('SESSION_SAVE_PATH')        ? null : define ('SESSION_SAVE_PATH', APP_PATH  . DS . '..' . DS . 'sessions');
    
    //Salt
    defined('APP_SALT')                 ? null : define ('APP_SALT', '$2a$07$Oj6SK5YLwhNTzO7EhNUveK$');

    //Check for access Privileges
    defined('CHECK_FOR_PRIVILEGES')     ? null : define ('CHECK_FOR_PRIVILEGES', 1);

    //define the path to our uploaded files
    defined('UPLOAD_STORAGE')           ? null : define ('UPLOAD_STORAGE', APP_PATH  . DS . '..' . DS . 'public' . DS . 'uploads');
    defined('IMAGES_UPLOAD_STORAGE')    ? null : define ('IMAGES_UPLOAD_STORAGE', UPLOAD_STORAGE . DS .'images');
    defined('DOCUMENTS_UPLOAD_STORAGE') ? null : define ('DOCUMENTS_UPLOAD_STORAGE', UPLOAD_STORAGE . DS .'documents');
    defined('MAX_FILE_SIZE_ALLOWED')    ? null : define ('MAX_FILE_SIZE_ALLOWED', ini_get('upload_max_filesize'));
