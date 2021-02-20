<?php
include "dbconnection.php";
$email="yaya.kamissokho@gmail.com";

function searchWithName($nom,$bdd){

    $req = $bdd->prepare('SELECT * FROM demande_mobilite WHERE nom = :nom');
    $req->execute(array(
        'nom' => $nom));

    return $req;
}
function searchWithPromo($promo,$bdd){

    $req = $bdd->prepare('SELECT * FROM demande_mobilite WHERE promo = :promo');
    $req->execute(array(
        'promo' => $promo));

    return $req;
}
function searchWithPays($pays,$bdd){

    $req = $bdd->prepare('SELECT * FROM demande_mobilite WHERE pays = :pays');
    $req->execute(array(
        'pays' => $pays));

    return $req;
}
function searchWithInfDates($date_debut,$bdd){

    $req = $bdd->prepare('SELECT * FROM demande_mobilite WHERE date_debut >= ?');
    $req->execute(array(
        $date_debut));

    return $req;
}

function searchWithSupDates($date_fin,$bdd){

    $req = $bdd->prepare('SELECT * FROM demande_mobilite WHERE date_fin <= ?');
    $req->execute(array(
        $date_fin));

    return $req;
}






