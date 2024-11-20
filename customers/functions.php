<?php

    include('../config.php');
    include(DBAPI);

    $customers = null;
    $customer = null;

    /**
     *  Listagem de Clientes
     */
    function index()
    {
        global $customers;
        $customers = find_all('customers');
    }

    function add() {

        if (!empty($_POST['customer'])) {
            
            $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        
            $customer = $_POST['customer'];
            $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
            
            save('customers', $customer);
            header('location: index.php');
        }
    }

    function edit() {

        $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        
        if (isset($_GET['id'])) {
        
            $id = $_GET['id'];
        
            if (isset($_POST['customer'])) {        
                $customer = $_POST['customer'];
                $customer['modified'] = $now->format("Y-m-d H:i:s");
            
                update('customers', $id, $customer);
                header('location: index.php');
            } else {
                global $customer;
                $customer = find('customers', $id);
            } 
        } else {
            header('location: index.php');
        }
    }

    function view($id = null) {
        global $customer;
        $customer = find('customers', $id);
    }

    function delete($id = null) {

        global $customer;
        $customer = remove('customers', $id);
        
        header('location: index.php');
    }