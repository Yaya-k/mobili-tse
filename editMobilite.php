 <?php
 if(!session_id()) {
     session_start();
 }
 ?>
 <?php
 function crypted($data,$encryption_key){
     $ciphering = "AES-128-CTR";
     $options = 0;
     $encryption_iv = '1234567891011121';

     return openssl_decrypt ($data, $ciphering,
         $encryption_key, $options, $encryption_iv);

 }
 $pays=["Allemagne","Belgique","Bulgarie","Espagne","Finlande","Italie","Portugal","Republique Tcheque","Lettonie"];
 ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Edite</title>
</head>
<body >
<?php
if(isset($_GET["ville"]) and isset($_GET["pays"]) and isset($_GET["date_debut"]) and isset($_GET["date_fin"]) and isset($_GET["id_mobilite"])){
?>
<form role="form" action="index.php" method="post">

    <div>
        <div class="row justify-content-center">
            <div class="row-md-6">
                <div class="modal-body mx-3">
                    <div class="form-row">
                        <div class="form-group col-md-12">

                            <label for="">Pays</label>
                            <select class="form-control" id="pays" required name="pays" >
                                <option><?php echo crypted($_GET["pays"],$_SESSION["encryption_key"]);?></option>

                                <?php
                                foreach ($pays as $val){
                                    if($val!=crypted($_GET["pays"],$_SESSION["encryption_key"])) {
                                        ?>

                                        <option><?php echo $val; ?></option>

                                        <?php
                                    }
                                }
                                ?>


                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Ville</label>

                            <select class="form-control" id="ville" required name="ville">
                                <option><?php echo crypted($_GET["ville"],$_SESSION["encryption_key"]);?></option>


                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Date debut</label>
                            <input type="date" class="form-control" name="date_debut" value=<?php echo $_GET["date_debut"];?>>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Date fin</label>
                            <input type="date" class="form-control" name="date_fin" value=<?php echo $_GET["date_fin"] ;?>>
                        </div>

                        <div class="form-group col-md-6" hidden>
                            <label for="inputPassword4">Date fin</label>
                            <input type="text" class="form-control" name="id" value=<?php echo crypted($_GET["id_mobilite"],$_SESSION["encryption_key"]);?> >
                        </div>

                    </div>


                </div>

            </div>

        </div>

        <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" name="EditeMobilityDemand" >Mettre a jour</button>

        </div>
    </div>
</form>
<?php
}
?>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    jQuery(function($) {
        var ville = {
            'Allemagne': ['Bochum', 'Giessen', 'Wildau'],
            'Belgique': ['Bruxelles'],
            'Bulgarie': ['Sofia'],
            'Espagne': ['Saragosse'],
            'Finlande': ['Tampere'],
            'Italie': ['Padoue','Milan'],
            'Portugal': ['Faro'],
            'Republique Tcheque': ['Prague'],
            'Lettonie': ['Riga']
        };

        var $ville = $('#ville');
        $('#pays').change(function () {
            var pays = $(this).val(), lcns = ville[pays] || [];

            var html = $.map(lcns, function(lcn){
                return '<option value="' + lcn + '">' + lcn + '</option>'
            }).join('');
            $ville.html(html)
        });
    });

</script>

</body>

</html>
