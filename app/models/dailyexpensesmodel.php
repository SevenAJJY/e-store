<?php
namespace PHPMVC\Models ;
class DailyExpensesModel extends AbstractModel
    {
        public $DExpenseId ;
        public $ExpenseId ;
        public $Payment ; 
        public $Created ; 
        public $UserId ; 
        public $Description ; 

        protected static $tableName = 'app_expenses_daily_list' ;

        protected static $tableSchema = array(
            'ExpenseId'     => self::DATA_TYPE_INT,
            'Payment'       => self::DATA_TYPE_DECIMAL,
            'Created'       => self::DATA_TYPE_STR,
            'UserId'        => self::DATA_TYPE_INT,
            'Description'   => self::DATA_TYPE_STR,
        );
        
        protected static $primaryKey = 'DExpenseId' ;

        public static function getAll()
        {
            return self::get('
                                SELECT aedl.*,aec.ExpenseName AS Name FROM '. self::$tableName . ' AS aedl 
                                LEFT JOIN '.ExpenseCategoryModel::getModelTableName().' aec 
                                ON aec.ExpenseId = aedl.ExpenseId');
        }

        public static function getLatest()
        {
            return self::get('
                SELECT aedl.*,aec.ExpenseName AS Name FROM '. self::$tableName . ' AS aedl 
                LEFT JOIN '.ExpenseCategoryModel::getModelTableName().' aec 
                ON aec.ExpenseId = aedl.ExpenseId  ORDER BY '.self::$primaryKey.' DESC LIMIT 5');
        }
    }