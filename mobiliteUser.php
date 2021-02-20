 <?
 if(!session_id()) {
     session_start();
 }

 include "dbconnection.php";

 require_once('User.php');

 ?>

 <?php
 function uniqidReal($lenght = 13) {
     // uniqid gives 13 chars, but you could adjust it to your needs.
     if (function_exists("random_bytes")) {
         $bytes = random_bytes(ceil($lenght / 2));
     } elseif (function_exists("openssl_random_pseudo_bytes")) {
         $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
     } else {
         throw new Exception("no cryptographically secure random function available");
     }
     return substr(bin2hex($bytes), 0, $lenght);
 }

 function encrypted($data,$encryption_key){
     $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    return openssl_encrypt($data, $ciphering,
            $encryption_key, $options, $encryption_iv);
 }

 ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">

    <title>User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        body{margin-top:20px;}


        /* USER LIST TABLE */
        .user-list tbody td > img {
            position: relative;
            max-width: 50px;
            float: left;
            margin-right: 15px;
        }
        .user-list tbody td .user-link {
            display: block;
            font-size: 1.25em;
            padding-top: 3px;
            margin-left: 60px;
        }
        .user-list tbody td .user-subhead {
            font-size: 0.875em;
            font-style: italic;
        }

        /* TABLES */
        .table {
            border-collapse: separate;
        }
        .table-hover > tbody > tr:hover > td,
        .table-hover > tbody > tr:hover > th {
            background-color: #eee;
        }
        .table thead > tr > th {
            border-bottom: 1px solid #C2C2C2;
            padding-bottom: 0;
        }
        .table tbody > tr > td {
            font-size: 0.875em;
            background: #f5f5f5;
            border-top: 10px solid #fff;
            vertical-align: middle;
            padding: 12px 8px;
        }
        .table tbody > tr > td:first-child,
        .table thead > tr > th:first-child {
            padding-left: 20px;
        }
        .table thead > tr > th span {
            border-bottom: 2px solid #C2C2C2;
            display: inline-block;
            padding: 0 5px;
            padding-bottom: 5px;
            font-weight: normal;
        }
        .table thead > tr > th > a span {
            color: #344644;
        }
        .table thead > tr > th > a span:after {
            content: "\f0dc";
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
            margin-left: 5px;
            font-size: 0.75em;
        }
        .table thead > tr > th > a.asc span:after {
            content: "\f0dd";
        }
        .table thead > tr > th > a.desc span:after {
            content: "\f0de";
        }
        .table thead > tr > th > a:hover span {
            text-decoration: none;
            color: #2bb6a3;
            border-color: #2bb6a3;
        }
        .table.table-hover tbody > tr > td {
            -webkit-transition: background-color 0.15s ease-in-out 0s;
            transition: background-color 0.15s ease-in-out 0s;
        }
        .table tbody tr td .call-type {
            display: block;
            font-size: 0.75em;
            text-align: center;
        }
        .table tbody tr td .first-line {
            line-height: 1.5;
            font-weight: 400;
            font-size: 1.125em;
        }
        .table tbody tr td .first-line span {
            font-size: 0.875em;
            color: #969696;
            font-weight: 300;
        }
        .table tbody tr td .second-line {
            font-size: 0.875em;
            line-height: 1.2;
        }
        .table a.table-link {
            margin: 0 5px;
            font-size: 1.125em;
        }
        .table a.table-link:hover {
            text-decoration: none;
            color: #2aa493;
        }
        .table a.table-link.danger {
            color: #fe635f;
        }
        .table a.table-link.danger:hover {
            color: #dd504c;
        }

        .table-products tbody > tr > td {
            background: none;
            border: none;
            border-bottom: 1px solid #ebebeb;
            -webkit-transition: background-color 0.15s ease-in-out 0s;
            transition: background-color 0.15s ease-in-out 0s;
            position: relative;
        }
        .table-products tbody > tr:hover > td {
            text-decoration: none;
            background-color: #f6f6f6;
        }
        .table-products .name {
            display: block;
            font-weight: 600;
            padding-bottom: 7px;
        }
        .table-products .price {
            display: block;
            text-decoration: none;
            width: 50%;
            float: left;
            font-size: 0.875em;
        }
        .table-products .price > i {
            color: #8dc859;
        }
        .table-products .warranty {
            display: block;
            text-decoration: none;
            width: 50%;
            float: left;
            font-size: 0.875em;
        }
        .table-products .warranty > i {
            color: #f1c40f;
        }
        .table tbody > tr.table-line-fb > td {
            background-color: #9daccb;
            color: #262525;
        }
        .table tbody > tr.table-line-twitter > td {
            background-color: #9fccff;
            color: #262525;
        }
        .table tbody > tr.table-line-plus > td {
            background-color: #eea59c;
            color: #262525;
        }
        .table-stats .status-social-icon {
            font-size: 1.9em;
            vertical-align: bottom;
        }
        .table-stats .table-line-fb .status-social-icon {
            color: #556484;
        }
        .table-stats .table-line-twitter .status-social-icon {
            color: #5885b8;
        }
        .table-stats .table-line-plus .status-social-icon {
            color: #a75d54;
        }
    </style>

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
    $_SESSION['encryption_key']=uniqid();
    while ($donnees=$mobiliteInformation->fetch()){
        $rdm=uniqidReal();
        $rdmView="view".$rdm;
        $rdmEdit="edit".$rdm;
        $rmdDeleted="del".$rdm;
        ?>
        <!-- Modal -->
        <div class="modal fade" id=<?php echo $rdmView;?> tabindex="-1" role="dialog"  aria-hidden="true" aria-labelledby=<?php echo $rdmView;?>>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Mobilité</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body mx-3">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Pays</label>
                                <input type="text" class="form-control" disabled value=<?php echo $donnees['pays'];?>>

                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Ville</label>
                                <input type="text" class="form-control" disabled value=<?php echo $donnees['ville'];?>>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Date debut</label>
                                <input type="date" class="form-control" disabled value=<?php echo $donnees['date_debut'];?> >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Date fin</label>
                                <input type="date" class="form-control" disabled value="<?php echo $donnees['date_fin'];?>" >
                            </div>
                              <div class="form-group col-md-12">
                                <label for="inputPassword4">Date Soumission</label>
                                <input type="text" class="form-control" disabled value="<?php echo $donnees['date_creation'];?>" >
                            </div>
                              <div class="form-group col-md-12">
                                <label for="inputPassword4">Statut</label>
                                <input type="text" class="form-control" disabled value="<?php echo $donnees['statue'];?>" >
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

                    </div>
                </div>
            </div>
        </div>

     <!-- Modal -->
         <div class="modal fade" id="userProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Nom</label>
                        <input type="text" class="form-control" id="inputEmail4" name="date_debut" disabled value=<?php echo $user->getNom()?> >
                    </div>

                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Prenom</label>
                        <input type="text" class="form-control" id="inputEmail4" name="date_debut" disabled value=<?php echo $user->getPrenom()?> >
                    </div>

                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Promo</label>
                        <input type="text" class="form-control" id="inputEmail4" name="date_debut" disabled value=<?php echo $user->getPromo()?> >
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputPassword4">Email</label>
                        <input type="text" class="form-control" id="inputEmail4" name="date_debut" disabled value=<?php echo $user->getEmail()?> >
                    </div>

                </div>


            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div>

     <!-- Modal HTML -->
        <form role="form" action="index.php" method="post">
             <div   class="modal fade" id=<?php echo $rmdDeleted;?>>
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title w-100">Êtes-vous sûr?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimer cet element? Ce processus ne peut pas être annulé.</p>
                    </div>
                      <div class="form-group col-md-6" hidden>
                            <label for="inputPassword4">Date fin</label>
                            <input type="text" class="form-control" name="id" value=<?php echo $donnees['id'];?> >
                        </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" name="deleteMobilite" class="btn btn-danger">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
        </form>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                <tr>
                                    <th><span>User</span></th>
                                    <th><span>Created</span></th>
                                    <th class="text-center"><span>Status</span></th>
                                    <th><span>Pays</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                        <a href="#" data-toggle="modal" data-target="#userProfile" class="user-link"><?php echo $user->getNom();?></a>
                                        <span class="user-subhead"><?php echo $donnees['ville'];?></span>
                                    </td>
                                    <td>
                                        <?php echo $donnees['date_creation'];?>
                                    </td>
                                    <td class="text-center">
                                        <span class="label label-default"><?php echo $donnees['statue'];?></span>
                                    </td>
                                    <td>
                                        <a href="#"><?php echo $donnees['pays'];?></a>
                                    </td>
                                    <td style="width: 20%;">
                                        <a href="#"  class="table-link" data-toggle="modal" data-target=<?php echo "#".$rdmView;?>>
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
									</span>
                                        </a>
                                        <a href="editMobilite.php?pays=<?php echo encrypted($donnees['pays'],$_SESSION['encryption_key']);?>
                                        &amp;ville=<?php echo encrypted($donnees['ville'],$_SESSION['encryption_key']);?>
                                        &amp;date_fin=<?php  echo $donnees['date_fin'];?>
                                        &amp;date_debut=<?php  echo $donnees['date_debut'];?>
                                        &amp;id_mobilite=<?php echo encrypted($donnees['id'],$_SESSION['encryption_key']) ;?>" class="table-link" >
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
									</span>
                                        </a>
                                        <a href="#" class="table-link danger" data-toggle="modal" data-target=<?php echo "#".$rmdDeleted;?>>
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
									</span>
                                        </a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
    }



}
?>
<div class="border border-light p-3 mb-4">

    <div class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSubscriptionForm">Faire une demande</button>
    </div>

</div>

 <?php
  if(isset($_SESSION['Pop_Up'])){
      switch ($_SESSION['Pop_Up']){
          case 'successMobilite':
              ?>
              <script>     $("#successMobilite").modal(); </script>
          <?php
              break;
          case 'failMobilite':
          ?>
          <script>     $("#failMobilite").modal(); </script>
          <?php
          break;
      }

  }
  ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
