<?php

    
    namespace PHPMVC\Controllers ;

use PHPMVC\LIBRARY\Validate;
use PHPMVC\Models\UserGroupsPrivilegeModel;
use PHPMVC\Models\UserModel;

    class TestController extends AbstractController
    {
        use Validate;
        public function defaultAction()
        {
            phpinfo();
        }
    }