<html>
  <head>
    <title>Pilotage Robot à distance</title>
  </head>
  <body>
    <h1>Pilotage du robot à distance </h1>
    <p>Utilisez les boutons ci-dessous pour contrôler le robot :</p>
    <button id="avancer">Avancer</button>
    <button id="gauche">Tourner à gauche</button>
    <button id="droite">Tourner à droite</button>
    <button id="reculer">Reculer</button>
    <script>
      // Récupère les boutons
      var avancerBouton = document.getElementById("avancer");
      var gaucheBouton = document.getElementById("gauche");
      var droiteBouton = document.getElementById("droite");
      var reculerBouton = document.getElementById("reculer");

      // Ajoute des écouteurs d'événement aux boutons
      avancerBouton.addEventListener("click", envoyerCommande("avancer"));
      gaucheBouton.addEventListener("click", envoyerCommande("gauche"));
      droiteBouton.addEventListener("click", envoyerCommande("droite"));
      reculerBouton.addEventListener("click", envoyerCommande("reculer"));

      // Envoie une commande au serveur TCP lorsqu'un bouton est cliqué
      function envoyerCommande(commande) {
        var xhr = new XMLHttpRequest(); // Crée un nouvel objet XMLHttpRequest
        xhr.open("GET", "http://192.168.0.0/?commande=" + commande, true); // Ouvre une connexion avec la carte arduino, l'ip de la carte arduino 
        xhr.send(); // Envoie la requête
      }
    </script>
  </body>
</html>
