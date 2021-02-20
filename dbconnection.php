<?php
try // ici je me connecte a la base 
{
    $bdd = new PDO('mysql:host=localhost;port=3308;dbname=gestion_mobilite;charset=utf8', 'root', '');

} catch(exception $e) 
{ 
  die('erreur : '.$e->getmessage()); 

}

