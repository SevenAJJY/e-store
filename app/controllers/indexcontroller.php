<?php

    namespace PHPMVC\Controllers ;

use PHPMVC\Models\ClientInvoiceModel;
use PHPMVC\Models\ClientModel;
use PHPMVC\Models\DailyExpensesModel;
use PHPMVC\Models\PrivilegesModel;
use PHPMVC\Models\ProductModel;
use PHPMVC\Models\SupplierInvoiceModel;
use PHPMVC\Models\SupplierModel;
use PHPMVC\Models\UserModel;

    class IndexController extends AbstractController
    {
        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('index.default');
    
            $this->_data['users'] = UserModel::count();
            $this->_data['suppliers'] = SupplierModel::count();
            $this->_data['clients'] = ClientModel::count();
            $this->_data['products'] = ProductModel::count();
            $this->_data['privileges'] = PrivilegesModel::count();
            $this->_data['dailyExpences'] = DailyExpensesModel::count();
            $this->_data['sales'] = ClientInvoiceModel::count();
            $this->_data['purchases'] = SupplierInvoiceModel::count();

            $this->_data['latest_products'] = ProductModel::getLatest();
            $this->_data['invoices_sales'] = ClientInvoiceModel::getLatest();
            $this->_data['invoices_purchases'] = SupplierInvoiceModel::getLatest();
            $this->_data['latest_expences'] = DailyExpensesModel::getLatest();

            $this->_view();
        }
    }