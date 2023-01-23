#include <Ethernet.h> // Inclut la bibliothèque Ethernet
#include <SPI.h>
const int led1Pin = 6; // Broche de la LED 1
const int led2Pin = 3; // Broche de la LED 2
const int led3Pin = 4; // Broche de la LED 3
const int led4Pin = 8; // Broche de la LED 4

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; // Adresse MAC de l'Arduino
IPAddress ip(192,168,65,71); // Adresse IP 


EthernetServer server(123); // Crée un serveur TCP sur le port 123

void setup() {
  // Configure les broches de sortie et initialise l'Ethernet et le serveur

  pinMode(led1Pin, OUTPUT);
  pinMode(led2Pin, OUTPUT);
  pinMode(led3Pin, OUTPUT);
  pinMode(led4Pin, OUTPUT);
  Ethernet.begin(mac, ip);

  
  server.begin();


  Serial.begin(9600);

  
}

void loop() {
  
  // Ecoute les connexions entrantes et traite les commandes reçues
  EthernetClient client = server.available();
  
  Serial.println(client);
  while (client) 
  { // Si une connexion est disponible
    // lisez les données envoyées par le client
    String commande = client.readStringUntil('\r');

    if (commande == "avancer") {
      
      digitalWrite(led1Pin, HIGH);
      digitalWrite(led2Pin, HIGH);
      digitalWrite(led3Pin, LOW);
      digitalWrite(led4Pin, LOW);

     } else if (commande == "gauche") {

      digitalWrite(led1Pin, LOW);
      digitalWrite(led2Pin, LOW);
      digitalWrite(led3Pin, LOW);
      digitalWrite(led4Pin, HIGH);
    } else if (commande == "droite") {

      digitalWrite(led1Pin, LOW);
      digitalWrite(led2Pin, LOW);
      digitalWrite(led3Pin, HIGH);
      digitalWrite(led4Pin, LOW);
      
    } else if (commande == "reculer") {

      digitalWrite(led1Pin, LOW);
      digitalWrite(led2Pin, LOW);
      digitalWrite(led3Pin, HIGH);
      digitalWrite(led4Pin, HIGH);
    }


    client.stop(); // Ferme la connexion avec le client
   }

    //String commande = "reculer";

    //Serial.println(commande);
      
  
  
}
