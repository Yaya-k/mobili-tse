<?php if(!session_id()) {
    session_start();
}?>

<?php /**
 * Created by PhpStorm.
 * User: yayak
 * Date: 25/09/2019
 * Time: 15:16
 */ ?>
<!DOCTYPE html>
<html>
<header>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!------ Include the above in your HEAD tag ---------->

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!---<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
    <!------ Include the above in your HEAD tag ---------->
    <!-- Libraries CSS Files -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">


   <link rel="stylesheet" href="css/signup.css">

</header>
<body>

<div class="container" style="">
    <form class="form-horizontal" role="form" action="index.php" method="post">
        <h2>Inscription</h2>
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
            <label for="email" class="col-sm-3 control-label" >Promo* </label>
            <div class="col-sm-9">
                <select class="form-control" id="exampleFormControlSelect1" required name="promo">
                    <option>Fise1</option>
                    <option>Fise2</option>
                    <option>Fise3</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Mot de passe*</label>
            <div class="col-sm-9">
                <input type="password" id="password" placeholder="Password" class="form-control" name="password" required minlength=8 onkeyup='check();'>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Confirmer le mot de passe*</label>
            <div class="col-sm-9">
                <input type="password" id="confirmPassword" placeholder="Password" class="form-control" name="confirmPassword" required onkeyup='check();'>
                <span id='message'></span>
            </div>
        </div>



        <div class="form-group">
            <label class="control-label col-sm-3"></label>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="checkboxConditions" required >
                <label class="form-check-label" for="gridCheck">
                    &nbsp;&nbsp;
                    &nbsp;
                    J'accepte les conditions générales
                </label>

            </div>

        </div> <!-- /.form-group -->
        <div class="form-group">
            <div class="col-sm-2 col-sm-offset-3">
                <span class="help-block">*Required fields</span>
            </div>

        </div>
        <div class="control-label">
            <div class="col-6">
                <button type="submit" id="submit" class="btn btn-primary" name="registerButton" disabled="" style="width: 200px;">S'inscrire</button>


            </div>

        </div>


    </form> <!-- /form -->
</div> <!-- ./container -->


<script >
    function check() {

        if (document.getElementById('password').value ===
            document.getElementById('confirmPassword').value ) {


            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
            document.getElementById('submit').disabled = false;

        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
            document.getElementById('submit').disabled = true;

        }
    }





</script>

</body>

</html>
<!------ Include the above in your HEAD tag ---------->


