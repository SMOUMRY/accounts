<?php
require_once '../vendor/autoload.php';
require_once '../php/functions.php';
include '../php/db.php';
include '../php/notif.php';
include_once '../includes/config.php';

session_start();
generateToken();
$transaction = getOperation($_GET['id']);

include_once '../includes/head.php';
?>
    <div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Modifier une opération</h1>
            </div>
            <div class="card-body">
                <form id='form-edit' action="../php/action.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de l'opération *</label>
                        <input type="text" class="form-control" name="operation" id="accounts"
                            placeholder="Facture d'électricité" value="<?= $transaction['name']?>" required>
                        <input id="tokenField" type="hidden" name="token" value="<?= $_SESSION['token']?>">
                        <input id="edit" type="hidden" name="action" value="edit">
                        <input id="id" type="hidden" name="id" value="<?= $_GET['id']?>">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date *</label>
                        <input type="date" class="form-control" name="date" id="date" value="<?= $transaction['date_transaction']?>"required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Montant *</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="amount" id="amount" value="<?= $transaction['amount']?>"required>
                            <span class="input-group-text">€</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie</label>
                        <select class="form-select" name="category" id="category">
                            <option value="" selected>Aucune catégorie</option>
                            <option value="1">Habitat</option>
                            <option value="2">Travail</option>
                            <option value="3">Cadeaux</option>
                            <option value="4">Numerique</option>
                            <option value="5">Alimentation</option>
                            <option value="6">Voyage</option>
                            <option value="7">Loisir</option>
                            <option value="8">Voiture</option>
                            <option value="9">Santé</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Modifier</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div class="position-fixed bottom-0 end-0 m-3">
        <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>

    <?=include_once '../includes/footer.php' ?>