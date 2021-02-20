<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
 <?php
 if(!session_id()) {
     session_start();
 }
  include 'dbconnection.php';
 require_once('User.php');

 $user =new User;

 include "utile.php";
 ?>
<?php
if(isset($_GET['action'])){
   if ($_GET['action']=="disconnect"){
       session_unset();     // unset $_SESSION variable for the run-time
       session_destroy();   // destroy session data in storage
   }
}
$_SESSION['Pop_Up']='';
$_SESSION['error']='';
?>


<?php
if(htmlspecialchars(isset($_POST['registerButton'])))
{

    $nom = $_POST['firstName'];
    $prenom = $_POST['lastName'];
    $email =$_POST['email'];
    $promo=$_POST['promo'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

    $saveSacces=$user->createNewUser($nom,$email,$prenom,$promo,$password,$bdd);
    if(!$saveSacces){

        $_SESSION["Pop_Up"]='inscription';

    }else{

        $_SESSION['id'] = $user->getId();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION["error"]='';
        $_SESSION["user"]=serialize($user);

        $_SESSION['Pop_Up']='';
        $_SESSION['status']=$user->getStatus($email,$bdd);
    }
}
?>

<?php
if(htmlspecialchars(isset($_POST["submitLogin"])))
{
    $email=$_POST["email"];

    $userConnect=$user->makeConnection($email,$bdd,$_POST['password']);
   if (!$userConnect)
    {
        $_SESSION["error"]="Mauvais identifiant ou mot de passe !";
    }
    else
    {
        $_SESSION['id'] = $user->getId();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION["error"]='';
        $_SESSION["user"]=serialize($user);
        $_SESSION['status']=$user->getStatus($email,$bdd);

    }

}

?>

<?php
if(isset($_POST['submiteMobilityDemand'])){
    $ville=$_POST['ville'];
    $pays=$_POST['pays'];
    $date_debut=$_POST['date_debut'];
    $date_fin=$_POST['date_fin'];
    $statue="enCours";
    if(isset($_SESSION['user'])){


        $user=unserialize($_SESSION['user']);
        $itInsert=$user->isertNewMobilite($bdd,$ville, $pays, $date_debut, $date_fin,$statue);
        if($itInsert){
            $_SESSION['Pop_Up']='successMobilite';

            ?>
            <script>     $("#successMobilite").modal(); </script>

            <?php
        }else{
            $_SESSION['Pop_Up']='failMobilite';

            ?>
            <script>     $("#failMobilite").modal(); </script>

            <?php
        }

    }
}

?>

<?php
if(isset($_POST['EditeMobilityDemand'])){
    $ville=$_POST['ville'];
    $pays=$_POST['pays'];
    $date_debut=$_POST['date_debut'];
    $date_fin=$_POST['date_fin'];
    $id_post=$_POST['id'];
    $req = $bdd->prepare('UPDATE demande_mobilite SET pays = :pays_mobilite, ville = :ville_mobilite,date_debut=:date_debut_mobilite,date_fin=:date_fin_mobilite WHERE id =:id_post');
    $req->execute(array(
        'pays_mobilite' => $pays,
        'ville_mobilite' => $ville,
        'date_debut_mobilite' => $date_debut,
        'date_fin_mobilite' => $date_fin,
        'id_post' => $id_post
    ));
}

?>

<?php
if(isset($_POST['deleteMobilite'])){
    $bdd->exec('DELETE FROM demande_mobilite WHERE id=\'Battlefield 1942\'');
    $id_mobilite=$_POST['id'];
    $req = $bdd->prepare('DELETE FROM demande_mobilite WHERE id = :id_mobilite');
    $req->execute(array(
        'id_mobilite' => $id_mobilite
    ));

}
?>
<script>
    toastr.info('Page Loaded!');

</script>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="#" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

      <link rel="stylesheet" href="css/login.css">
      <title>Mobilis'tse</title>
  </head>
  <body>

  <?php
  if(isset($_SESSION['email']) and isset($_SESSION['status']) and $_SESSION['status']==2){
      include("map.php");
  }elseif (isset($_SESSION['email'])){

      include("mobiliteUser.php");

  }else{
      include("login.php");

  }


  ?>

  </body>
</html>
