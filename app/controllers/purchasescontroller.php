<?php

    namespace PHPMVC\Controllers ;

    use PHPMVC\LIBRARY\Helper;
    use PHPMVC\LIBRARY\InputFilter;
    use PHPMVC\LIBRARY\Messenger;
    use PHPMVC\Models\ClientModel;
    use PHPMVC\Models\ProductModel;
    use PHPMVC\Models\SupplierInvoiceDetailsModel;
    use PHPMVC\Models\SupplierInvoiceModel;
    use PHPMVC\Models\SupplierModel;

    class PurchasesController extends AbstractController
    {
        use InputFilter ;
        use Helper ;

        ### -> Here we put an Array $_createActionRoles in it the name of each of the fields we want to check with Type validate . 
        ### -> that you need and it will be called Trait(Validate) and exactly method isValid
        private $_createActionRoles = 
        [
            'SupplierId'        => 'req|alphanum',
            'PaymentType'       => 'req|num'
        ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('purchases.default');
            $this->language->load('purchases.labels');

            $this->_data['invoices'] = SupplierInvoiceModel::getAll();

            $this->_view();
        }


        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('purchases.create');
            $this->language->load('purchases.labels');
            $this->language->load('purchases.messages');
            $this->language->load('validation.errors');

            $this->_data['suppliers'] = SupplierModel::getAll();

            $this->_data['products'] = ProductModel::getAll();

            if (isset($_POST['submit'])) {

                $purchases = new SupplierInvoiceModel();
                $purchases->SupplierId = $this->filterInt($_POST["SupplierId"]) ;
                $purchases->PaymentType = $this->filterInt($_POST["PaymentType"]) ;
                $purchases->PaymentStatus = $this->filterInt($_POST["PaymentStatus"]) ;
                $purchases->Created = date("Y-m-d") ;
                $purchases->Discount = isset($_POST['Discount']) ? $this->filterFloat($_POST["Discount"]) : "";
                $purchases->UserId = $this->session->u->UserId;
                $purchases->AddedToStore = 0;
                
                $productsIds = $this->filterStringArray($_POST["productv"]) ;
                $productsPrices = $this->filterStringArray($_POST["productp"]) ;
                $productsQuantities = $this->filterStringArray($_POST["productq"]) ;
                if ($purchases->save()) {
                    for ($i=0; $i < count($productsIds); $i++) { 
                        $details = new SupplierInvoiceDetailsModel();
                        $details->InvoiceID = $purchases->InvoiceId ;
                        $details->ProductId = $productsIds[$i] ;
                        $details->Quantity = $productsQuantities[$i] ;
                        $details->ProductPrice = $productsPrices[$i] ;
                        $details->save();
                    }
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/purchases') ;
            }

            $this->_view();
        }

        public function editAction()
        {
                $id = $this->_getParams(0, 'int');
                $invoice = SupplierInvoiceModel::getByKey($id);
                if($invoice === false || $invoice->AddedToStore == 1) {
                    $this->redirectBack('/purchases');
                }
        
                $this->_data['invoice'] = $invoice;
                
                $details = $this->_data['details'] = SupplierInvoiceDetailsModel::getInvoiceById($invoice);

                $this->language->load('template.common');
                $this->language->load('purchases.edit');
                $this->language->load('purchases.labels');
                $this->language->load('purchases.messages');
                $this->language->load('validation.errors');
        
                $this->_data['suppliers'] = SupplierModel::get(
                    'SELECT SupplierId, Name  from app_suppliers'
                );
        
                $products = ProductModel::getAll();
                foreach ($products as &$product) {
                    foreach ($details as $detail) {
                        if($detail->ProductId == @$product->ProductId) {
                            $product = false;
                        }
                    }
                }
        
                $productsIterator = iterator_to_array($products);
                $newProducts = [];
                foreach ($productsIterator as $item) {
                    if(false !== $item) {
                        $newProducts[] = $item;
                    }
                }

                $products = $newProducts;
                $this->_data['products'] = $products;

                if(isset($_POST['submit'])) {

                        $invoice->SupplierId = $this->filterInt($_POST["SupplierId"]) ;
                        $invoice->PaymentType = $this->filterInt($_POST["PaymentType"]) ;
                        $invoice->PaymentStatus = $this->filterInt($_POST["PaymentStatus"]) ;
                        $invoice->Discount = isset($_POST['Discount']) ? $this->filterFloat($_POST["Discount"]) : "";

                        $productsIds = $this->filterStringArray($_POST['productv']);
                        $productsPrices = $this->filterStringArray($_POST['productp']);
                        $productsQuantities = $this->filterStringArray($_POST['productq']);
        
                        if($invoice->save()) {

                            foreach ($details as $detail) {
                                $detail->delete();
                            }

                            for ( $i = 0, $ii = count($productsIds); $i < $ii; $i++ ) {
                                $details = new SupplierInvoiceDetailsModel();
                                $details->InvoiceID = $invoice->InvoiceId;
                                $details->ProductId = $productsIds[$i];
                                $details->Quantity = $productsQuantities[$i];
                                $details->ProductPrice = $productsPrices[$i];
                                $details->save();
                            }
                            $this->messenger->add($this->language->get('message_edit_success'));
                        }else {
                            $this->messenger->add($this->language->get('message_edit_failed') , Messenger::APP_MESSAGE_ERROR);
                        }
                        $this->redirect('/purchases') ;
                }
            $this->_view();
        }


        public function deleteAction()
        {
            $id = $this->_getParams(0, 'int');
            $invoice = SupplierInvoiceModel::getByKey($id);
            if($invoice === false || $invoice->AddedToStore == 1) {
                $this->redirectBack('/purchases');
            }

            $details = SupplierInvoiceDetailsModel::getInvoiceById($invoice);
            foreach ($details as $detail) {
                $detail->delete();
            }

            $this->language->load('purchases.messages');

            if($invoice->delete()){
                $this->messenger->add($this->language->get('message_delete_success'));
            } 
            else {
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

        public function deliverProductsAction()
        {
            $id = $this->_getParams(0, 'int');
    
            $invoice = SupplierInvoiceModel::getByKey($id);
    
            if($invoice === false || $invoice->AddedToStore == 1) {
                $this->redirectBack('/purchases');
            }
    
            $details = SupplierInvoiceDetailsModel::getInvoiceById($invoice);
            if($details !== false) {
                foreach ($details as $detail) {
                    $product = ProductModel::getByKey($detail->ProductId);
                    $product->Quantity += $detail->Quantity;
                    $product->save();
                }
                $invoice->AddedToStore = 1;
                if($invoice->save()) {
                    $this->messenger->add($this->language->get('message_added_to_store_success'));
                }
            }
            $this->redirect('/purchases');
        }

    }