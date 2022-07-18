<?php
namespace PHPMVC\Models ;

use PHPMVC\Controllers\UsersGroupsController;

class UserModel extends AbstractModel
{
    public $UserId ;

    public $Username ;

    public $Password ; 

    public $Email ; 

    public $PhoneNumber ; 

    public $SubscriptionDate ;

    public $LastLogin ;

    public $GroupId ;

    public $Status ;

    /**
     * @var UserProfileModel
     */
    public $profile ;

    public $privileges ;

    protected static $tableName = 'app_users' ;

    protected static $tableSchema = array(
        'UserId'            => self::DATA_TYPE_INT, 
        'Username'          => self::DATA_TYPE_STR, 
        'Password'          => self::DATA_TYPE_STR,
        'Email'             => self::DATA_TYPE_STR,
        'PhoneNumber'       => self::DATA_TYPE_STR,
        'SubscriptionDate'  => self::DATA_TYPE_STR,
        'LastLogin'         => self::DATA_TYPE_STR,
        'GroupId'           => self::DATA_TYPE_INT,
        'Status'            => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'UserId' ;

    public function cryptPassword($password)
    {
        $this->Password = crypt($password,APP_SALT);
    }

    public function confirmCryptPassword($password)
    {
        return crypt($password,APP_SALT);
    }

    public static function getUsers(UserModel $user)
    {
        ### -> Fetch the list of all users except the current user, through the information they recorded in the session when logging in
        return self::get(
            'SELECT au.*,aug.GroupName GroupName FROM ' . self::$tableName . ' as au INNER JOIN app_users_groups as aug ON aug.GroupId = au.GroupId WHERE au.UserId != ' .$user->UserId
        );
    }

    public static function userExists($username)
    {
        return self::get('SELECT * FROM '. self::$tableName . ' WHERE Username = "' . $username . '"');
    }

    public static function emailExists($email)
    {
        return self::get('SELECT * FROM '. self::$tableName . ' WHERE Email = "' . $email . '"');
    }

    /**
     * @param $username
     * @param $password
     * @param $session
     * @return User $User
     */
    public static function authenticate($username, $password,$session)
    {
        $password = crypt($password,APP_SALT);
        $sql = 'SELECT *,(SELECT GroupName FROM app_users_groups WHERE app_users_groups.GroupId = '.self::$tableName.'.GroupId) as GroupName FROM '. self::$tableName .' WHERE Username = "' . $username . '" AND Password = "' . $password . '"' ;
        $foundUser = self::getOne($sql);
        if (false !==  $foundUser) {
            ### -> 2: If the user is banned by the administration (disabled)
            if ($foundUser->Status == 2) {
                return 2 ;
            }
            ### -> 1: If the user is already registered, we will record his last login,
            ### -> and then store his information in the Session 
            $foundUser->LastLogin = date('Y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile = UserProfileModel::getByKey($foundUser->UserId);
            $foundUser->privileges = UserGroupsPrivilegeModel::getPrivilegesForGroup($foundUser->GroupId) ;
            $session->u = $foundUser;
            return 1 ;
        }
        ### -> false: if it does not exist at all
        return false ;
    }

    /**
     * @param $user
     * @return User $User
     */
    public static function getUserProfile($user)
    {
        $sql = 'SELECT * FROM '. self::$tableName . ' WHERE UserId='.$user->UserId  ;
        return self::getOne($sql) ;
    }
}