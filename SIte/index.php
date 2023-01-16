<html>
  <head>
    <title>Pilotage Robot à distance</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body >
    <h1>Pilotage du robot à distance </h1>
    <?php
    
  //$adresse = "192.168.64.79";  test hercules
  // Création du socket 

  $adresse = "192.168.65.71";
  $port = 123;
  $socket =socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
  
  if($socket === false)
  {
    echo"problème pour créer le socket";
  }
  else{
    echo"socket créer";
  }
  
  // Connection du socket à l'arduino

  $result = socket_connect($socket, $adresse, $port);
  if($socket === false)
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
    socket_write($socket,$data);
  }
  else if(isset($_POST['gauche']))
  {
    $data = "gauche";
    socket_write($socket,$data);
  }
  else if(isset($_POST['droite']))
  {
    $data = "droite";
    socket_write($socket,$data);
  }
  else if(isset($_POST['avancer']))
  {
    $data = "avancer";
    socket_write($socket,$data);
  }

  // Lecture du socket

  $out = socket_read($socket,200,PHP_BINARY_READ);
  echo $out;

  // fermeture du socket

  socket_close($socket);

  


  ?>
   <form action="#" method="POST">
    <div id="deplacement">
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
     
    </div>
</form>
    



  </script>
  
</body>
</html>