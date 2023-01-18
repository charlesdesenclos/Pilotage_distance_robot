<?php
        session_start();

        //include("./Classe/User.php");

     
        
 ?>
<html>
  <head>
    <title>Pilotage Robot à distance</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body >
  

  <?php
  $_SESSION['Connexion'] = false;
        require_once 'pdo/config.php'; // ajout connexion bdd 
        $GLOBALS['bdd'] = $bdd;

        include("./Classe/User.php");
        $TheUser = new User(null,null,null);
    ?>
    
      <?php
        if (isset($_POST['deconnexion'])) {
          // Le bouton de déconnexion a été cliqué
          $TheUser->deconnexion();
          $_SESSION['Connexion'] = false;
        }
        
        if(isset($_POST['submit']))
        {
          $identifiant = $_POST['identifiant'];
          $password = $_POST['password'];
          //echo $identifiant;
          //echo $password;
          
          $resultat = $TheUser->connexion($_POST['identifiant'],$_POST['password']);

          //$verif = " SELECT * FROM user WHERE identifiant='".$identifiant."' AND password ='".$password."'";
          //$resultat = $GLOBALS['bdd'] -> query($verif);

          

          if ($resultat -> rowCount() > 0)
          {
            if (isset($_POST['deconnexion'])) {
              // Le bouton de déconnexion a été cliqué
              $TheUser->deconnexion();
              $_SESSION['Connexion'] = false;
            }
            ?>
            <h1>Pilotage du robot à distance </h1>

            <?php
            //$adresse = "192.168.64.79";  test hercules
            // Création du socket 

            $adresse = "192.168.65.71";
            $port = 123;
            $socket =socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            
            $_SESSION['socket'] = $socket;

            if($_SESSION['socket'] === false)
            {
              echo"problème pour créer le socket";
            }
            else{
              echo"socket créer";
            }

            // Connection du socket à l'arduino

            $result = socket_connect($_SESSION['socket'], $adresse, $port);
            if($_SESSION['socket'] === false)
            {
              echo "connection au socket échoué";
            }
            else
            {
              echo "socket connecter";
            }

            // Gestion du message envoyé par rapport au bouton envoyé
            
            if(isset($_POST['reculer']))
            {
              $data = "reculer";
              socket_write($_SESSION['socket'],$data);
            }
            else if(isset($_POST['gauche']))
            {
              $data = "gauche";
              socket_write($_SESSION['socket'],$data);
            }
            else if(isset($_POST['droite']))
            {
              $data = "droite";
              socket_write($_SESSION['socket'],$data);
            }
            else if(isset($_POST['avancer']))
            {
              $data = "avancer";
              socket_write($_SESSION['socket'],$data);
            }

            // Lecture du socket

            $out = socket_read($_SESSION['socket'],200,PHP_BINARY_READ);
            echo $out;

            // fermeture du socket

            if(socket_close($_SESSION['socket']) === false)
            {
              error_log("Impossible de fermer le socket",0);
            }
            

            ?>

            <div class="wrapper">
            <form action="" method="POST">
              
              
                <p id="para">Utilisez les boutons ci-dessous pour contrôler le robot :</p>
                <div id="avance">
                  <button id="avancer" name="avancer">Avancer</button>
                </div>
                <div id="tourne">
                  <div id="tournegauche">
                    <button id="gauche" name ="gauche">Tourner à gauche</button>
                  </div>
                  <div id="tournedroite">
                    <button id="droite" name="droite">Tourner à droite</button>
                  </div>
                </div>
                <div id="recule">
                  <button id="reculer" name="reculer">Reculer</button>
                </div>
            
              
            </form> 
            </div>

            <form action="" method="POST">
              <input type="submit" value="Déconnexion" name="deconnexion2">
            </form>
            <?php


            //echo"Vous êtes connectés";
            $_SESSION['Connexion'] = true;
            echo $_SESSION['pseudo'] = $pseudo;
            $_SESSION['connectionValide'] = true;

            
               
                return true;
    
            
          }

          if($_SESSION['connectionValide'] == true)
          {
            header('Location: index.php'); // On redirige vers la page de l'index
            die();
          }
          else if($_SESSION['connectionValide'] != true)
          {
           
            echo "problème ";
          }
          else{

          }
 
        }
        else 
        {
          ?>
  <div class="wrapper">
    <div class="title-text">
        <div class="title login"></div>
        <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
        <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Connexion</label>
        <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
        <form action="#" class="login" method="POST">
            <div class="field">
            <input type="text" placeholder="Identifiant" name="identifiant" required>
            </div>
            <div class="field">
            <input type="password" placeholder="Mot de Passe" name="password" required>
            </div>
            <div class="pass-link">Mot de Passe oublié ? Contactez un adminstrateur.</div>
            <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Connexion" name="submit">
            </div>
        </form>
        <form action=""  method="POST">
            <imput type="submit" value="Deconnexion" name="deconnexion">
      </form>
        
        </div>
    </div>
    </div>
    <?php
        }
        ?>

</body>
</html>