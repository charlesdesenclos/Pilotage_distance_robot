<html>
  <head>
    <title>Pilotage Robot à distance</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body >
    <h1>Pilotage du robot à distance </h1>
    <div id="deplacement">
      <p id="para">Utilisez les boutons ci-dessous pour contrôler le robot :</p>
      <div id="avance">
        <button id="avancer">Avancer</button>
      </div>
      <div id="tourne">
        <div id="tournegauche">
          <button id="gauche">Tourner à gauche</button>
        </div>
        <div id="tournedroite">
          <button id="droite">Tourner à droite</button>
        </div>
      </div>
      <div id="recule">
        <button id="reculer">Reculer</button>
      </div>
  
    </div>
    <script>
      // Récupère les boutons
      var avancerBouton = document.getElementById("avancer");
      var gaucheBouton = document.getElementById("gauche");
      var droiteBouton = document.getElementById("droite");
      var reculerBouton = document.getElementById("reculer");

      // gère  le bouton quand il est cliqué
      avancerBouton.addEventListener("click", envoyerCommande("avancer"));
      gaucheBouton.addEventListener("click", envoyerCommande("gauche"));
      droiteBouton.addEventListener("click", envoyerCommande("droite"));
      reculerBouton.addEventListener("click", envoyerCommande("reculer"));

      // Envoie une commande au serveur TCP lorsqu'un bouton est cliqué
      function envoyerCommande(commande) {
        var xhr = new XMLHttpRequest(); // Crée un nouvel objet XMLHttpRequest
        xhr.open("GET", "http://192.168.65.71/?commande=" + commande, true); // Ouvre une connexion avec la carte arduino, l'ip de la carte arduino 
        xhr.send(); // Envoie la requête
      }
    </script>
  </body>
</html>
