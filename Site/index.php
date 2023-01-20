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
        
        require_once 'pdo/config.php'; // ajout connexion bdd 
        $GLOBALS['bdd'] = $bdd;

        $_SESSION['Connexion'] = false;

        
    ?>
    


<?php
    
    

        include("./Classe/User.php");
        $TheUser = new User(null,null,null);
        if (isset($_POST['deconnexion'])) {
          // Le bouton de déconnexion a été cliqué
          $TheUser->deconnexion();
          $_SESSION['Connexion'] = false;
        }
        
        if(isset($_POST['submit']))
        {
        
          $resultat = $TheUser->connexion($_POST['identifiant'],$_POST['password']);

          if($resultat->rowCount()>0){
            $_SESSION['logged_in'] = true;
          } else {
            echo "Identifiant ou mot de passe incorrect";
          }

          //$verif = " SELECT * FROM user WHERE identifiant='".$identifiant."' AND password ='".$password."'";
          //$resultat = $GLOBALS['bdd'] -> query($verif);

        }

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) 
        {
        ?>

        
          
            
            <h1>Pilotage du robot à distance </h1>

            <?php
            //$adresse = "192.168.64.79";  //test hercules
            // Création du socket 

            $adresse = "192.168.65.71";
            $port = 123;
            $socket =socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            
            

            // Connection du socket à l'arduino

            $result = socket_connect($socket, $adresse, $port);
            

            // Envoyer un message au serveur en fonction du bouton cliqué
            if (isset($_POST['conf'])) {
              $command = $_POST['command'];
              socket_write($socket, $command, strlen($command));
            }
            
            

           

            // fermeture du socket

            socket_close($socket);
            
            

            ?>

            <div class="wrapper">
            <form action="" method="POST">
              
              
                <p id="para">Utilisez les boutons ci-dessous pour contrôler le robot :</p>
                <div id="avance">
                  <input type="submit" name="command" value="avancer" id="avancer" >
                </div>
                <div id="tourne">
                  <div id="tournegauche">
                    <input type="submit" name="command" value="gauche" id="gauche">
                  </div>
                  <div id="tournedroite">
                    <input type="submit" name="command" value="droite" id="droite">
                  </div>
                </div>
                <div id="recule">
                  <input type="submit" name="command" value="reculer" id="reculer">
                </div>
                <input type="hidden" name="conf" value="true">
            
              
            </form> 
            </div>
          
    <?php
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
                
                
                </div>
            </div>
            </div>
            <?php 
        }
    
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) 
{?>
  

<form action="" method="POST">
              <input type="submit" value="Déconnexion" name="deconnexion">
            </form> 
        <?php
}
?>

</body>
</html>