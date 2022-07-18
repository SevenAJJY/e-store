<?php

    namespace PHPMVC\Controllers ;

    use PHPMVC\LIBRARY\Helper;
    use PHPMVC\LIBRARY\InputFilter;
    use PHPMVC\LIBRARY\Messenger;
    use PHPMVC\Models\ClientModel;

    class ClientsController extends AbstractController
    {
        use InputFilter ;
        use Helper ;

        ### -> Here we put an Array $_createActionRoles in it the name of each of the fields we want to check with Type validate . 
        ### -> that you need and it will be called Trait(Validate) and exactly method isValid
        private $_createActionRoles = 
        [
            'Name'           => 'req|alpha|between(3,40)',
            'Email'          => 'req|email',
            'PhoneNumber'    => 'alphanum|max(15)',
            'Address'        => 'req|alphanum|max(50)',
        ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('clients.default');

            $this->_data['clients'] = ClientModel::getAll();

            $this->_view();
        }


        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('clients.create');
            $this->language->load('clients.labels');
            $this->language->load('clients.messages');
            $this->language->load('validation.errors');

            if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)) {

                $supplier =  new ClientModel();
                $supplier->Name = $this->filterString($_POST['Name']);
                $supplier->Email = $this->filterString($_POST['Email']) ;
                $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
                $supplier->Address = $this->filterString($_POST['Address']) ;

                if ($supplier->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/clients') ;
            }

            $this->_view();
        }

        public function editAction()
        {
            $id = $this->filterInt($this->_params[0]);
            $supplier = ClientModel::getByKey( $id);

            if (false === $supplier) {
                $this->redirect('/clients');
            }
            $this->_data['supplier'] = $supplier ;

            $this->language->load('template.common');
            $this->language->load('clients.edit');
            $this->language->load('clients.labels');
            $this->language->load('clients.messages');
            $this->language->load('validation.errors');


            if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)) {

                $supplier->Name = $this->filterString($_POST['Name']);
                $supplier->Email = $this->filterString($_POST['Email']) ;
                $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
                $supplier->Address = $this->filterString($_POST['Address']) ;

                if ($supplier->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/clients') ;
            }

            $this->_view();
        }


        public function deleteAction()
        {
            $id = $this->filterInt($this->_params[0]);
            $supplier = ClientModel::getByKey( $id);

            if (false === $supplier) {
                $this->redirect('/clients');
            }

            $this->language->load('clients.messages');

            if ($supplier->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
            }
            else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients') ;
        }

    }