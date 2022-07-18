<?php

namespace PHPMVC\Controllers ;

use PHPMVC\LIBRARY\FrontController;
use PHPMVC\LIBRARY\Helper;
use PHPMVC\LIBRARY\InputFilter;
use PHPMVC\LIBRARY\template;
use PHPMVC\LIBRARY\Validate;

/**
 * Abstract Controller
 * @author yassine ELHAJJY
 *
 */
class AbstractController
{   
    use Validate ;
    use InputFilter ;
    use Helper ;

    /**
     * Controller Name
     *
     * @var string
     */
    protected $_controller ;

    /**
     * Acion Name
     *
     * @var string
     */
    protected $_action ;

    /**
     * URL extracted parameters
     * which could be used for
     * any action
     *
     * @var array
     */
    protected $_params ;
    
    /**
     * @var \PHPMVC\LIBRARY\Template\Template
     */
    protected $_template ;

    /**
     * Regisry object reference
     *
     * @var \PHPMVC\LIBRARY\Registry;
     */
    protected $_registry ;

    /**
     * Data array used to keep track of
     * all data passed to the view
     * @var array
     */
    protected $_data = array();

    ### -> We use __get() to access what's in Registry() Such as (Object MangerSession -  Object Language ...)
    public function __get($key)
    {
        return $this->_registry->$key;
    }

    public function notFoundAction()
    {
        $this->_view();
    }

    /**
     * Controller name setter
     *
     * @param string $controller            
     */
    public function setController($controllerName)
    {
        $this->_controller = $controllerName ;
    }

    /**
     * Acion Name setter
     *
     * @param string $action            
     */
    public function setAction($actionName)
    {
        $this->_action = $actionName ;
    }

    /**
     * Parameters array setter
     *
     * @param array $params            
     */
    public function setParams($paramsName)
    {
        $this->_params = $paramsName ;
    }

    /**
     * Set the template property to a Template instance
     * @param \PHPMVC\LIBRARY\Template\Template $template
     */
    public function setTemplate($template)
    {
        $this->_template = $template ;
    }
    
    /**
     * Registry object setter
     *
     * @param \PHPMVC\LIBRARY $registry
     */
    public function setRegistry($registry)
    {
        $this->_registry = $registry ;
    }

    
/**
 * Used to get a stored parameter back in a given type
 *
 * @param int $key            
 * @param string $type            
 * @example _getParam(1, 'int');
 * @return mixed
 */
protected function _getParams($key, $type)
{
    if (array_key_exists($key, $this->_params)) {
        $type = strtolower($type);
        $value = "";
        switch($type)
        {
            case 'int':
                $value = filter_var($this->_params[$key], FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'float':
                $value = filter_var($this->_params[$key], FILTER_SANITIZE_NUMBER_FLOAT);
                break;
            case 'string':
                $value = filter_var($this->_params[$key],FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                break;
        }
        return $value ;
    }
    else {
        return false ;
    }
}


    protected function _view()
    {   
        $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php' ;
        if ($this->_action == FrontController::NOT_FOUND_ACTION || !file_exists($view)) 
        {
            $view = VIEWS_PATH . 'notfound' . DS . 'notfound.view.php' ;
        }
        $this->_data = array_merge($this->_data ,$this->language->getDictionary());
        $this->_template->setRegistry($this->_registry);
        $this->_template->setActionViewFile($view);
        $this->_template->setAppData($this->_data);
        $this->_template->renderApp();
        
        
    }
}