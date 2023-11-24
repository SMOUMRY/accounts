<?php

require_once '../vendor/autoload.php';
require_once 'functions.php';
include 'db.php';

if (!isset($_REQUEST['action'])) errorAndExit('Aucune action');

session_start();

checkCSRF('index.php');

// ADD
if ($_POST['action'] === 'create') {
    if (isset($_POST['operation']) && isset($_POST['amount']) && isset($_POST['date'])) {
        if (strlen($_POST['operation']) > 0 && intval($_POST['amount']) !== 0) {
            $query = $dbCo->prepare("INSERT INTO transaction (name, amount, date_transaction, id_category) VALUES (:name, :amount, :date, :category)");
            $isQuerryOK = $query->execute([
                'name' => strip_tags($_POST['operation']),
                'amount' => intval(strip_tags($_POST['amount'])),
                'date' => strip_tags($_POST['date']),
                'category' => intval(strip_tags($_POST['category']))
            ]);
            if ($isQuerryOK && $query->rowCount() === 1) {
                $_SESSION['notification'] = 'created';
            } else $_SESSION['error'] = 'not_created';
        } else {
            $_SESSION['error'] = 'error_data';
        }
    }
} 
// EDIT
else if ($_POST['action'] === 'edit'){
    if (isset($_POST['operation']) && isset($_POST['amount']) && isset($_POST['date'])){
        $query = $dbCo->prepare("UPDATE transaction set name = :name, amount = :amount, date_transaction = :date, id_category = :category WHERE id_transaction = :id");
            $isQuerryOK = $query->execute([
                'name' => strip_tags($_POST['operation']),
                'amount' => intval(strip_tags($_POST['amount'])),
                'date' => strip_tags($_POST['date']),
                'category' => intval(strip_tags($_POST['category'])),
                "id" => intval(strip_tags($_POST['id']))
            ]);
            if ($isQuerryOK && $query->rowCount() === 1) {
                $_SESSION['notification'] = 'edited';
            } else $_SESSION['error'] = 'not_edited';
    }
}
// DELETE
else if ($_GET['action'] === 'delete') {
    if (isset($_GET['id'])){
        $query = $dbCo->prepare('DELETE FROM transaction WHERE id_transaction = :id');
        $isQuerryOK = $query->execute([
            'id' => intval($_GET['id'])
        ]);
        if ($isQuerryOK && $query->rowCount() === 1) {
            $_SESSION['notification'] = 'deleted';
        } else $_SESSION['error'] = 'not_deleted';
}
}

header('Location: ../accounts/index.php');
