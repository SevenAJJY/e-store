<?php
namespace PHPMVC\Models ;
class ClientInvoiceModel extends AbstractModel
    {
        public $InvoiceId ;
        public $ClientId ;
        public $PaymentType ;
        public $PaymentStatus ; 
        public $Created ; 
        public $Discount ; 
        public $UserId ; 
        public $ProductsDelivery ; 

        protected static $tableName = 'app_sales_invoices' ;
        protected static $tableSchema = array(
            'ClientId'        => self::DATA_TYPE_INT, 
            'PaymentType'       => self::DATA_TYPE_INT,
            'PaymentStatus'     => self::DATA_TYPE_INT,
            'Created'           => self::DATA_TYPE_STR,
            'Discount'          => self::DATA_TYPE_INT,
            'UserId'            => self::DATA_TYPE_INT,
            'ProductsDelivery'      => self::DATA_TYPE_INT
        );
        protected static $primaryKey = 'InvoiceId' ;

        public static function getAll()
        {
            $invoices = self::get(
                'SELECT asi.*,  
                (SELECT SUM(ProductPrice * Quantity) FROM app_sales_invoices_details WHERE InvoiceID = asi.InvoiceId) total,
                (SELECT COUNT(*) FROM app_sales_invoices_details WHERE InvoiceID = asi.InvoiceId) ptotal,
                (SELECT SUM(PaymentAmount) FROM app_sales_invoices_receipts WHERE app_sales_invoices_receipts.InvoiceId = asi.InvoiceId) totalPaid,
                (SELECT Name FROM app_clients WHERE app_clients.ClientId = asi.ClientId) supplier
                FROM ' . self::$tableName . ' asi'
            );
            return $invoices;
        }

        public function getInvoiceTotal()
        {
            return (int) self::get('SELECT SUM(ProductPrice * Quantity) total FROM app_sales_invoices_details WHERE InvoiceID = ' . $this->InvoiceId)->current()->total;
        }

        public static function getLatest()
        {
            $invoices = self::get(
                'SELECT asi.*,  
                (SELECT SUM(ProductPrice * Quantity) FROM app_sales_invoices_details WHERE InvoiceID = asi.InvoiceId) total,
                (SELECT COUNT(*) FROM app_sales_invoices_details WHERE InvoiceID = asi.InvoiceId) ptotal,
                (SELECT SUM(PaymentAmount) FROM app_sales_invoices_receipts WHERE app_sales_invoices_receipts.InvoiceId = asi.InvoiceId) totalPaid,
                (SELECT Name FROM app_clients WHERE app_clients.ClientId = asi.ClientId) ClientName
                FROM ' . self::$tableName . ' asi ORDER BY '.self::$primaryKey.' DESC LIMIT 5'
            );
            return $invoices;
        } 


    }