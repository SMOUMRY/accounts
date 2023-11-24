<?php
require_once '../vendor/autoload.php';
require_once '../php/functions.php';
include '../php/db.php';
include '../php/notif.php';
include_once '../includes/config.php';

session_start();
generateToken();

include_once '../includes/head.php';
// takeDateFromSession();
?>

    <div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Solde aujourd'hui</h2>
            </div>
            <div class="card-body">
                <p class="card-title pricing-card-title text-center fs-1">
                    <?php include ('../php/amount.php'); ?> €
                </p>
            </div>
        </section>
        <?php
            if (isset($_SESSION['notification'])){
                $notif = $_SESSION['notification'];
                echo "<div class='card'>{$msg[$notif]}<p></p></div>";
            }
            else if(isset($_SESSION['error'])){
                $error = $_SESSION['error'];
                echo "<div class='card'>{$msg[$error]}<p></p></div>";
            }
        ?>
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Opérations de <?=generateDateString()?></h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Opération</th>
                            <th scope="col" class="text-end">Montant</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= include('../php/display.php') ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <nav class="text-center">
                    <ul class="pagination d-flex justify-content-center m-2">
                        <li class="page-item disabled">
                            <span class="page-link">
                                <a href=""><i class="bi bi-arrow-left"></i></a>
                            </span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link"><?=generateDateString()?></span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href=""><?=generateDateStringBefore()?></a>
                        </li>
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.php">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <div class="position-fixed bottom-0 end-0 m-3">
        <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>


    <?=include_once '../includes/footer.php' ?>