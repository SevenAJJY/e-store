<?php
namespace PHPMVC\Models ;
class UserGroupsPrivilegeModel extends AbstractModel
    {
        public $Id ;
        public $GroupId ;
        public $PrivilegeId ;

        protected static $tableName = 'app_users_groups_privileges' ;
        protected static $tableSchema = array(
            'GroupId'            => self::DATA_TYPE_INT, 
            'PrivilegeId'        => self::DATA_TYPE_INT, 
        );
        protected static $primaryKey = 'Id' ;

        public static function getGroupprivileges(UserGroupsModel $group)
        {
            $groupPrivileges = self::getBy(['GroupId' => $group->GroupId]);
            $extractPrivilegesIds = [] ;
            if ($groupPrivileges != false) {
                foreach ($groupPrivileges as $privilege) {
                    $extractPrivilegesIds[] =  $privilege->PrivilegeId;
                }
            }
            return $extractPrivilegesIds ;
        }

        ### -> To get the permissions of the current user
        public static function getPrivilegesForGroup($groupId)
        {   
            $sql = 'SELECT augp.*,aup.Privilege FROM '. self::$tableName .' as augp '  ;
            $sql .= ' INNER JOIN app_users_privileges as aup ON aup.PrivilegeId = augp.PrivilegeId '  ;
            $sql .= 'WHERE augp.GroupId = '. $groupId ;
            $privileges =  self::get($sql) ;
            ### -> Store all the permissions of the current user in $extractURLs ;
            $extractURLs = [];
            if (false !== $privileges) {
                foreach ($privileges as $privilege) {
                    $extractURLs[] = $privilege->Privilege ;
                }
            }
            return $extractURLs ;
        }
    }