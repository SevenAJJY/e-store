<?php


    namespace PHPMVC\LIBRARY\Template ;

    class Template
    {
        use TemplateHelper ;
        
        private $_templateParts ;

        private $_action_view ;

        private $_data ;
        
        private $_registry ;

        public function __get($key)
        {
            return $this->_registry->$key ;
        }

        public function __construct(array $parts)
        {
            $this->_templateParts = $parts ;
        }

        public function setActionViewFile($actionViewPath)
        {
            $this->_action_view  = $actionViewPath ;
        }

        public function setAppData($data)
        {
            $this->_data = $data ;
        }
        ### -> authentication
        public function swapTemplate($template)
        {
            $this->_templateParts['template'] = $template ;
        }

        public function setRegistry($registry)
        {
            $this->_registry = $registry ;
        }

        private function renderTemplateHeaderStart()
        {
            extract($this->_data);
            require_once TEMPLATE_PATH . 'templateheaderstart.php' ;
        }

        private function renderTemplateHeaderEnd()
        {
            extract($this->_data);
            require_once TEMPLATE_PATH . 'templateheaderend.php' ;
        }

        private function renderTemplateFooter()
        {
            extract($this->_data);
            require_once TEMPLATE_PATH . 'templatefooter.php' ;
        }

        private function renderTemplateBlocks()
        {
            if (!array_key_exists('template' , $this->_templateParts)) 
            {
                trigger_error('Sorry u have to define the template  blocks' , E_USER_WARNING) ;
                
            }
            else 
            {
                $parts = $this->_templateParts['template'] ;
                if (!empty($parts)) 
                {
                    extract($this->_data);
                    foreach ($parts as $partKey => $file) 
                    {
                        if ($partKey == ':view') {
                            require_once $this->_action_view ;
                        }
                        else {
                            require_once $file ;
                        }
                    }
                }
            }
        }

        private function renderHeaderResources()
        {
            $output = '' ;
            if (!array_key_exists('header_resources' , $this->_templateParts)) 
            {
                trigger_error('Sorry u have to define the Header Resources' , E_USER_WARNING) ;
                
            }
            else 
            {
                $resources = $this->_templateParts['header_resources'] ;
                // GENERATE CSS LINKS
                $css = $resources['css'] ;
                if (!empty($css)) 
                {
                    
                    foreach ($css as $cssKey => $path) 
                    {
                        $output .='<link text="text/css" rel="stylesheet" href="'. $path.'" />';
                    }
                }
                // GENERATE JS SCRIPTS
                $js = $resources['js'] ;
                if (!empty($js)) 
                {
                    foreach ($js as $jsKey => $path) 
                    {
                        $output .='<script src="'. $path.'"></script>';
                    }
                }
            }
            echo $output ;
        }

        private function renderFooterResources()
        {
            $output = '' ;
            if (!array_key_exists('footer_resources' , $this->_templateParts)) 
            {
                trigger_error('Sorry u have to define the footer Resources' , E_USER_WARNING) ;
                
            }
            else 
            {
                $resources = $this->_templateParts['footer_resources'] ;
                if (!empty($resources)) 
                {
                    
                    foreach ($resources as $resourceKey => $path) 
                    {
                        $output .='<script src="'. $path.'"></script>';
                    }
                }
            }
            echo $output ;
        }

        public function renderApp()
        {
            $this->renderTemplateHeaderStart();
            $this->renderHeaderResources();
            $this->renderTemplateHeaderEnd() ;
            $this->renderTemplateBlocks();
            $this->renderFooterResources();
            $this->renderTemplateFooter() ;
        }
    }
