<?php

    namespace PHPMVC\Controllers ;

    use PHPMVC\LIBRARY\Helper;
    use PHPMVC\LIBRARY\InputFilter;
    use PHPMVC\LIBRARY\Messenger;
    use PHPMVC\Models\ClientModel;
    use PHPMVC\Models\ProductModel;
    use PHPMVC\Models\SupplierInvoiceDetailsModel;
    use PHPMVC\Models\SupplierInvoiceModel;
use PHPMVC\Models\SupplierInvoicePaymentVoucherModel;
use PHPMVC\Models\SupplierModel;

    class PaymentVoucherController extends AbstractController
    {
        use InputFilter ;
        use Helper ;

        private $_createActionRoles = 
        [
            'SupplierId'        => 'req|alphanum',
            'PaymentType'       => 'req|num'
        ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('paymentvoucher.default');
            $this->language->load('paymentvoucher.labels');

            $id = $this->_getParams(0, 'int');
            $invoice = SupplierInvoiceModel::getByKey($id);
            if(false !== $id && false !== $invoice) {
                $this->_data['vouchers'] = SupplierInvoicePaymentVoucherModel::getForInvoice($invoice);
            } 
            else {
                $this->_data['vouchers'] = SupplierInvoicePaymentVoucherModel::getAll();
            }

            $this->_view();
        }


        public function createAction()
        {
            $id = $this->_getParams(0, 'int');
            $invoice = SupplierInvoiceModel::getByKey($id);
    
            if(false === $invoice){
                $this->redirectBack('/paymentvoucher');
            }
    
            if(SupplierInvoicePaymentVoucherModel::invoiceIsSettled($invoice)) {
                $this->redirectBack('/paymentvoucher');
            }

            $this->language->load('template.common');
            $this->language->load('paymentvoucher.create');
            $this->language->load('paymentvoucher.labels');
            $this->language->load('paymentvoucher.messages');


            $this->language->feed('title', [$invoice->InvoiceId]);
            $this->language->feed('text_header', [$invoice->InvoiceId]);
            $this->language->feed('text_footer', [$invoice->InvoiceId]);

            if(isset($_POST['submit'])) {
                $voucher = new SupplierInvoicePaymentVoucherModel();
                $voucher->UserId = $this->session->u->UserId;
                $voucher->InvoiceId = $invoice->InvoiceId;
                $voucher->PaymentType = $this->filterInt($_POST['PaymentType']);
                $voucher->PaymentAmount = $this->filterInt($_POST['PaymentAmount']);
                $voucher->PaymentLiteral = $this->filterString($_POST['PaymentLiteral']);
                $voucher->BankName = isset($_POST['BankName']) ? $this->filterString($_POST['BankName']) : '';
                $voucher->BankAccountNumber = isset($_POST['BankAccountNumber']) ? $this->filterString($_POST['BankAccountNumber']) : '';
                $voucher->CheckNumber = isset($_POST['CheckNumber']) ? $this->filterString($_POST['CheckNumber']) : '';
                $voucher->TransferedTo = isset($_POST['TransferedTo']) ? $this->filterString($_POST['TransferedTo']) : '';
                $voucher->Created = date('Y-m-d H:i:s');
                if($voucher->invoiceCanAdd()) {
                    if($voucher->save()) {
                        $this->messenger->add($this->language->get('message_create_success'));
                        $this->redirect('/purchases');
                    } else {
                        $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                    }
                } else {
                    $this->messenger->add($this->language->get('message_over_payment') , Messenger::APP_MESSAGE_ERROR);
                }
            }
            
            $this->_view();
        }

        public function editAction()
        {        
            $id = $this->_getParams(0, 'int');
            $voucher = SupplierInvoicePaymentVoucherModel::getByKey($id);
    
            if(false === $voucher)
            {
                $this->redirectBack('/paymentvoucher');
            }
    
            $this->_data['voucher'] = $voucher;
    
            $invoice = SupplierInvoiceModel::getByKey($voucher->InvoiceId);
    
            $this->language->load('template.common');
            $this->language->load('paymentvoucher.edit');
            $this->language->load('paymentvoucher.labels');
            $this->language->load('paymentvoucher.messages');
    
            $this->language->feed('title', [$invoice->InvoiceId]);
            $this->language->feed('text_header', [$invoice->InvoiceId]);
            $this->language->feed('text_footer', [$invoice->InvoiceId]);

            if(isset($_POST['submit'])) {

                $oldPayment = $voucher->PaymentAmount;
                $voucher->PaymentType = $this->filterInt($_POST['PaymentType']);
                $voucher->PaymentAmount = $this->filterInt($_POST['PaymentAmount']);
                $voucher->PaymentLiteral = $this->filterString($_POST['PaymentLiteral']);
                $voucher->BankName = isset($_POST['BankName']) ? $this->filterString($_POST['BankName']) : '';
                $voucher->BankAccountNumber = isset($_POST['BankAccountNumber']) ? $this->filterString($_POST['BankAccountNumber']) : '';
                $voucher->CheckNumber = isset($_POST['CheckNumber']) ? $this->filterString($_POST['CheckNumber']) : '';
                $voucher->TransferedTo = isset($_POST['TransferedTo']) ? $this->filterString($_POST['TransferedTo']) : '';

                if($voucher->invoiceCanAdd($oldPayment)) {
                    if($voucher->save()) {
                        $this->messenger->add($this->language->get('message_edit_success'));
                        $this->redirect('/paymentvoucher');
                    } else {
                        $this->messenger->add($this->language->get('message_edit_failed') , Messenger::APP_MESSAGE_ERROR);
                    }
                } else {
                    $this->messenger->add($this->language->get('message_over_payment') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/purchases') ;
            }

            $this->_view();
        }


        public function deleteAction()
        {
            $id = $this->_getParams(0, 'int');
            $voucher = SupplierInvoicePaymentVoucherModel::getByKey($id);
    
            if(false === $voucher)
            {
                $this->redirectBack('/paymentvoucher');
            }
    
            if($voucher->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
                $this->redirect('/paymentvoucher');
            } else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/purchases') ;

        }

        public function viewAction()
        {
            $id = $this->_getParams(0, 'int');
    
            $invoice = SupplierInvoiceModel::getOne(
                'SELECT *, (SELECT Name FROM app_suppliers WHERE app_suppliers.SupplierId = app_purchases_invoices.SupplierId) Name
                    FROM app_purchases_invoices
                    WHERE InvoiceId = ' . $id
            );
    
            if($invoice === false) {
                $this->redirectBack('/purchases');
            }

            $this->language->load('template.common');
            $this->language->load('purchases.view');
            $this->language->load('purchases.labels');
    
            $this->_data['invoice'] = $invoice;
            $this->_data['details'] = SupplierInvoiceDetailsModel::getInvoiceById($invoice);

            $this->_data['title'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
            $this->_data['text_header'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
            $this->_data['text_footer'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
    


            $this->_view();
        }

    }