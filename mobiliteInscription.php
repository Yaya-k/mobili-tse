<?php
$email=$_SESSION["email"];
$req = $bdd->prepare('SELECT * FROM user WHERE email = :email');
$req->execute(array(
    'email' => $email
));

$resultat = $req->fetch();

$id_personne=$resultat['id'];
$_SESSION['id']=$id_personne;
$req = $bdd->prepare('SELECT * FROM demande_mobilite WHERE id_personne = :id_personne');
$req->execute(array(
    'id_personne' => $id_personne
));
$mobiliteInformation=$req->fetch();

$doesHeAlreadyMakeDemand=$mobiliteInformation['statue']!=NULL;


echo $doesHeAlreadyMakeDemand;
?>
    <form style="margin: 20px" role="form" action="index.php" method="post">

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Nom</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nom" disabled value="<?php echo $resultat['nom']  ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Prenom</label>
                <input type="text" class="form-control" id="inputPassword4" disabled placeholder="Prenom" value="<?php echo $resultat['prenom']?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Email</label>
                <input type="email" class="form-control" id="inputPassword4" disabled placeholder="email" value="<?php echo $resultat['email'] ?>" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Pays</label>
                <input type="text" class="form-control" id="inputEmail4" name="pays" placeholder="Action"  required value="<?php echo $doesHeAlreadyMakeDemand ? $mobiliteInformation['pays']:" " ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Ville </label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Action" name="ville" required value="<?php echo $doesHeAlreadyMakeDemand ? $mobiliteInformation['ville']:" " ?>">
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Promo</label>
                <input type="text" class="form-control" placeholder="Action" disabled value="<?php echo $resultat['promo']  ?>">
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputEmail4">Date debut</label>
                <input type="date" class="form-control" id="inputEmail4" name="date_debut" required min="<?php echo date("Y-m-d"); ?>" value="<?php echo $doesHeAlreadyMakeDemand ? $mobiliteInformation['date_debut']:" " ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="inputPassword4">Date fin</label>
                <input type="date" class="form-control" id="inputPassword4" name="date_fin" required min="<?php echo date("Y-m-d"); ?>" value="<?php echo $doesHeAlreadyMakeDemand ? $mobiliteInformation['date_fin']:" " ?>">
            </div>
            <?php
            if($doesHeAlreadyMakeDemand){
                ?>
                <div class="form-group col-md-3">
                    <label for="inputPassword4">Date demande</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="etape Suivant" disabled value="<?php echo $mobiliteInformation['date_creation'] ?>">
                </div>
                <?php
            }

            ?>


        </div>




        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" required>
                <label class="form-check-label" for="gridCheck">
                    Controle de securité
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submiteMobilityDemand"><?php echo $doesHeAlreadyMakeDemand ? "Mettre a jours":"Soumettre la demande"?></button>


    </form>

