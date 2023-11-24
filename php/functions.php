<?php
include 'db.php';

// SECURITY 
function generateToken()
{
    if (!isset($_SESSION['token']) || time() > $_SESSION['tokenExpire']) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 15 * 60;
    }
}

function checkCSRF(string $url): void
{
    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/Devoir%20CRUD/accounts/')) {
        exit;
    } else if (!isset($_SESSION['token']) || !isset($_REQUEST['token']) || $_REQUEST['token'] !== $_SESSION['token'] || $_SESSION['tokenExpire'] < time()) {
        exit;
    }
}
// Error

function errorAndExit(string $error): void
{
    $_SESSION['error'] = $error;
    header('Location: index.php');
    exit;
}

// GET operation

function getOperation(int $id): array{
    global $dbCo;
    $query = $dbCo->prepare('SELECT * FROM transaction WHERE id_transaction = :id');
    $query->execute([
        'id' => intval($id)
    ]);
    return $query->fetch();
}

// POOLING

function generatePage(): string{
    return   basename($_SERVER['SCRIPT_NAME']);
}

function getPageData(array $pages): ?array
{
    foreach($pages as $page){
        if($page['file'] === generatePage()){
           return $page;
        }
}
}

// DATE

function generateDateNumber(): string{
        return date('Y-m');
    }
    function generateDateString():string{
             return date('F Y');
}

function generateDateStringBefore():string{
            $date = date('F Y');
            $newdate = date("F Y", strtotime ( '-1 month' , strtotime ( $date ) )) ;
        return $newdate;
}




// fonction pour parcourir les operations en fonction de la date mais pas abouti a cuase du manque du temps

// function generateDateNumber(): string{
//     return date('Y-m');
// }

// function generateDateNumberBefore(): string{
//     if (isset($_SESSION['date'])){
//         $date = $_SESSION['date'];
//         $newdate = date("Y-m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
//     }
//     else{
//         $date = date('Y-m');
//         $date = $_SESSION['date'];
//         $newdate = date("Y-m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
//     }
//     return $newdate;
// }

// function generateDateNumberAfter(): string{
//     if (isset($_SESSION['date'])){
//         $date = $_SESSION['date'];
//         $newdate = date("Y-m", strtotime ( '+1 month' , strtotime ( $date ) )) ;
//     }
//     else{
//         $date = date('Y-m');
//         $date = $_SESSION['date'];
//         $newdate = date("Y-m", strtotime ( '+1 month' , strtotime ( $date ) )) ;
//     }
//     return $newdate;
// }

// function generateDateString():string{
//      return date('F Y');
// }

// function generateDateStringBefore():string{
//     if (isset($_SESSION['date_string'])){
//         $date = $_SESSION['date'];
//         $newdate = date("F Y ", strtotime ( '-1 month' , strtotime ( $date ) )) ;
//     }
//     else{
//         $date = date('F Y');
//         $date = $_SESSION['date'];
//         $newdate = date("F Y", strtotime ( '-1 month' , strtotime ( $date ) )) ;
//     }
//     return $newdate;
// }

// function generateDateStingAfter():string{
//     if (isset($_SESSION['date_string'])){
//         $date = $_SESSION['date'];
//         $newdate = date("F Y ", strtotime ( '+1 month' , strtotime ( $date ) )) ;
//     }
//     else{
//         $date = date('F Y');
//         $date = $_SESSION['date'];
//         $newdate = date("F Y", strtotime ( '+1 month' , strtotime ( $date ) )) ;
//     }
//     return $newdate;
// }

// function takeDateFromSession():void{
//     if (isset($_GET['date'])){
//     $_SESSION['date'] = $_GET['date'];
//     }
//     else if (isset($_GET['date_string'])){
//         $_SESSION['date_string'] = $_GET['date_string'];
//     }
// }