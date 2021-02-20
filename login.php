<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <label> Connexion</label>
        </div>

        <!-- Login Form -->
        <form role="form" action="index.php" method="post">
          <input type="email" id="login" class="fadeIn second" name="email" placeholder="email" required>
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required>

            <?php
            if(isset($_SESSION["error"])){
                $error = $_SESSION["error"];
                echo " <span style=\"color:red\">$error</span>";
            }
            ?>
          <input type="submit" class="fadeIn fourth" value="Connexion" name="submitLogin">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="signup.php">S'inscrire?</a>
        </div>

      </div>
    </div>
  <?php
  if(isset($_SESSION['Pop_Up'])){
      switch ($_SESSION['Pop_Up']){
          case 'inscription':
              ?>
              <script>     $("#inscription").modal(); </script>
          <?php
              break;
      }
  }
  ?>
