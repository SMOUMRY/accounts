<?php



    $date = date('m');
    
    $query = $dbCo->prepare('SELECT * FROM transaction JOIN category USING(id_category) WHERE MONTH(date_transaction) = :date ORDER BY DATE(date_transaction) DESC;');
    $query->execute([
        'date' => strip_tags($date)
    ]);
    
    foreach ($query->fetchAll() as $transaction){
        if ($transaction['amount'] > 0){
            echo "<tr>
            <td width='50' class='ps-3'>
                <i class='bi bi-{$transaction['icon_class']} fs-3'></i>
            </td>
            <td>
                <time datetime='{$transaction['date_transaction']}' class='d-block fst-italic fw-light'>{$transaction['date_transaction']}</time>
                {$transaction['name']}
            </td>
            <td class='text-end'>
                <span class='rounded-pill text-nowrap bg-success-subtle px-2'>
                    {$transaction['amount']}
                </span>
            </td>
            <td class='text-end text-nowrap'>
                <a href='edit.php?action=editd&id={$transaction['id_transaction']}' class='btn btn-outline-primary btn-sm rounded-circle'>
                    <i class='bi bi-pencil'></i>
                </a>
                <a href='../php/action.php?action=delete&id={$transaction['id_transaction']}&token={$_SESSION['token']}' class='btn btn-outline-danger btn-sm rounded-circle'>
                    <i class='bi bi-trash'></i>
                </a>
            </td>
        </tr>";
        }
        else{
            echo "<tr>
            <td width='50' class='ps-3'>
                <i class='bi bi-{$transaction['icon_class']} fs-3'></i>
            </td>
            <td>
                <time datetime='{$transaction['date_transaction']}' class='d-block fst-italic fw-light'>{$transaction['date_transaction']}</time>
                {$transaction['name']}
            </td>
            <td class='text-end'>
                <span class='rounded-pill text-nowrap bg-warning-subtle px-2'>
                    {$transaction['amount']}
                </span>
            </td>
            <td class='text-end text-nowrap'>
                <a href='edit.php?action=editd&id={$transaction['id_transaction']}' class='btn btn-outline-primary btn-sm rounded-circle'>
                    <i class='bi bi-pencil'></i>
                </a>
                <a href='../php/action.php?action=delete&id={$transaction['id_transaction']}&token={$_SESSION['token']}' class='btn btn-outline-danger btn-sm rounded-circle'>
                    <i class='bi bi-trash'></i>
                </a>
            </td>
        </tr>";
        }
    }

// fonction pas aboutie a cause du manque du temps, utilisation du $_GET et $_SESSION afin de memoriser la date et d'afficher en fonction les evenement

// else if (isset($_SESSION['date'])){
    
//     $date = $_SESSION['date'];
//     $query = $dbCo->prepare('SELECT * FROM transaction JOIN category USING(id_category) WHERE date_transaction LIKE :date ORDER BY DATE(date_transaction) DESC;');
//     $query->execute([
//         'date' => strip_tags($date).'%'
//     ]);
    
//     foreach ($query->fetchAll() as $transaction){
//         if ($transaction['amount'] > 0){
//             echo "<tr>
//             <td width='50' class='ps-3'>
//                 <i class='bi bi-{$transaction['icon_class']} fs-3'></i>
//             </td>
//             <td>
//                 <time datetime='{$transaction['date_transaction']}' class='d-block fst-italic fw-light'>{$transaction['date_transaction']}</time>
//                 {$transaction['name']}
//             </td>
//             <td class='text-end'>
//                 <span class='rounded-pill text-nowrap bg-success-subtle px-2'>
//                     {$transaction['amount']}
//                 </span>
//             </td>
//             <td class='text-end text-nowrap'>
//                 <a href='edit.php?action=editd&id={$transaction['id_transaction']}' class='btn btn-outline-primary btn-sm rounded-circle'>
//                     <i class='bi bi-pencil'></i>
//                 </a>
//                 <a href='../php/action.php?action=delete&id={$transaction['id_transaction']}&token={$_SESSION['token']}' class='btn btn-outline-danger btn-sm rounded-circle'>
//                     <i class='bi bi-trash'></i>
//                 </a>
//             </td>
//         </tr>";
//         }
//         else{
//             echo "<tr>
//             <td width='50' class='ps-3'>
//                 <i class='bi bi-{$transaction['icon_class']} fs-3'></i>
//             </td>
//             <td>
//                 <time datetime='{$transaction['date_transaction']}' class='d-block fst-italic fw-light'>{$transaction['date_transaction']}</time>
//                 {$transaction['name']}
//             </td>
//             <td class='text-end'>
//                 <span class='rounded-pill text-nowrap bg-warning-subtle px-2'>
//                     {$transaction['amount']}
//                 </span>
//             </td>
//             <td class='text-end text-nowrap'>
//                 <a href='edit.php?action=editd&id={$transaction['id_transaction']}' class='btn btn-outline-primary btn-sm rounded-circle'>
//                     <i class='bi bi-pencil'></i>
//                 </a>
//                 <a href='../php/action.php?action=delete&id={$transaction['id_transaction']}&token={$_SESSION['token']}' class='btn btn-outline-danger btn-sm rounded-circle'>
//                     <i class='bi bi-trash'></i>
//                 </a>
//             </td>
//         </tr>";
//         }
// }

// }