<?php

    namespace PHPMVC\Models;

class ClientInvoiceReceiptModel extends AbstractModel
{

    public $ReceiptId;
    public $InvoiceId;
    public $PaymentType;
    public $PaymentAmount;
    public $PaymentLiteral;
    public $BankName;
    public $BankAccountNumber;
    public $CheckNumber;
    public $TransferedTo;
    public $Created;
    public $UserId;

    protected static $tableName = 'app_sales_invoices_receipts';

    protected static $primaryKey = 'ReceiptId';

    protected static $tableSchema = array(
        'InvoiceId'           => self::DATA_TYPE_INT,
        'PaymentType'         => self::DATA_TYPE_INT,
        'PaymentAmount'       => self::DATA_TYPE_INT,
        'PaymentLiteral'      => self::DATA_TYPE_STR,
        'BankName'            => self::DATA_TYPE_STR,
        'BankAccountNumber'   => self::DATA_TYPE_STR,
        'CheckNumber'         => self::DATA_TYPE_STR,
        'TransferedTo'        => self::DATA_TYPE_STR,
        'Created'             => self::DATA_TYPE_STR,
        'UserId'              => self::DATA_TYPE_INT,
    );

    public function invoiceCanAdd($oldPayment = 0)
    {
        $previousPayments = self::get(
            "
            SELECT IFNULL(SUM(PaymentAmount),0) PreviousPayments, 
            (SELECT SUM(ProductPrice * Quantity) FROM app_sales_invoices_details WHERE app_sales_invoices_details.InvoiceId = {$this->InvoiceId}) InvoiceTotal
             FROM " . self::$tableName . " WHERE InvoiceId = {$this->InvoiceId} Having InvoiceTotal >= (PreviousPayments - {$oldPayment} + {$this->PaymentAmount})"
        );
        return $previousPayments === false ? false : true;
    }

    public static function invoiceIsSettled(ClientInvoiceModel $invoiceModel)
    {
        $invoiceTotal = $invoiceModel->getInvoiceTotal();
        $totalPayments = self::get('
            SELECT SUM(PaymentAmount) totalPayments FROM ' . self::$tableName . ' WHERE InvoiceId = ' . $invoiceModel->InvoiceId . '
        ');
        return (int) $totalPayments->current()->totalPayments === $invoiceTotal;
    }

    public static function getAll()
    {
        return self::get(
        'SELECT *, (SELECT Created FROM app_sales_invoices WHERE app_sales_invoices.InvoiceId = ' . self::$tableName . '.InvoiceId) iCreated,
        (SELECT Name FROM app_clients ac inner join app_sales_invoices asi on asi.ClientId = ac.ClientId  LIMIT 1) ClientName
        FROM ' . self::$tableName 
        );
    }

    public static function getForInvoice(ClientInvoiceModel $invoice)
    {
        return self::get(
            'SELECT *, (SELECT Created FROM app_sales_invoices WHERE app_sales_invoices.InvoiceId = ' . self::$tableName . '.InvoiceId) iCreated,
            (SELECT Name FROM app_clients ac,app_sales_invoices asi, app_sales_invoices_receipts asir
            WHERE asir.InvoiceId = asi.InvoiceId AND asi.ClientId = ac.ClientId AND ac.ClientId = '.$invoice->ClientId.' LIMIT 1) SupplierName
            FROM ' . self::$tableName . ' WHERE InvoiceId = ' . $invoice->InvoiceId
        );
    }
}
