<?
if(!session_id()) {
    session_start();
}

include "dbconnection.php";

require_once('User.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">

    <title>User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


</head>
<body>




<?php
include "navBar.php";

if (isset($_SESSION['user'])){
    $user=unserialize($_SESSION['user']);
    $mobiliteInformation=$user->getUserMobilite($bdd,$user->getId());
    ?>
    <div>
        <div class="row justify-content-center">
            <div class="form-group">
                <label for="firstName" class="col-sm-3 control-label">Nom*</label>
                <div class="col-sm-9">
                    <input type="text" id="firstName" placeholder="nom" class="form-control" autofocus name="firstName" required>
                </div>
            </div>
            <div class="form-group">
                <label for="lastName" class="col-sm-3 control-label">Prenom*</label>
                <div class="col-sm-9">
                    <input type="text" id="lastName" placeholder="Prenom" class="form-control" autofocus name="lastName" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email* </label>
                <div class="col-sm-9">
                    <input type="email" id="email" placeholder="Email" class="form-control" name= "email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email* </label>
                <div class="col-sm-9">
                    <input type="email" id="email" placeholder="Email" class="form-control" name= "email" required>
                </div>
            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" name="EditeMobilityDemand" >Mettre a jour</button>

        </div>
    </div>
    <?php


}
?>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>