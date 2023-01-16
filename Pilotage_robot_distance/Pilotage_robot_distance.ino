#include <Ethernet.h> // Inclut la bibliothèque Ethernet
#include <SPI.h>
const int led1Pin = 6; // Broche de la LED 1
const int led2Pin = 3; // Broche de la LED 2
const int led3Pin = 4; // Broche de la LED 3
const int led4Pin = 8; // Broche de la LED 4

bool led1Etat = LOW; // Etat de la LED 1 (éteint par défaut)
bool led2Etat = LOW; // Etat de la LED 2 (éteint par défaut)
bool led3Etat = LOW; // Etat de la LED 3 (éteint par défaut)
bool led4Etat = LOW; // Etat de la LED 4 (éteint par défaut)

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; // Adresse MAC de l'Arduino
IPAddress ip(192,168,65,71); // Adresse IP 


EthernetServer server(123); // Crée un serveur TCP sur le port 80

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
      
      led1Etat = HIGH; // Allume la LED 1
      led2Etat = HIGH; // Allume la LED 2
      led3Etat = LOW; // Eteint la LED 3
      led4Etat = LOW; // Eteint la Led 4

     } else if (commande == "gauche") {
      
      led1Etat = LOW; // Eteint la LED 1
      led2Etat = LOW; // Eteint la LED 2
      led3Etat = LOW; // Allume la LED 3
      led4Etat = HIGH; // Eteint la LED 4
    } else if (commande == "droite") {
      
      led1Etat = LOW; // Eteint la LED 1
      led2Etat = LOW; // Eteint la LED 2
      led3Etat = HIGH; // Eteint la LED 3
      led4Etat = LOW; // Allume la LED 4
    } else if (commande == "reculer") {
     
      led1Etat = LOW; // Eteint la LED 1
      led2Etat = LOW; // Eteint la LED 2
      led3Etat = HIGH; // Allume la LED 3
      led4Etat = HIGH; // Allume la LED 4
    }

    // Met à jour l'état des LED
    digitalWrite(led1Pin, led1Etat);
    digitalWrite(led2Pin, led2Etat);
    digitalWrite(led3Pin, led3Etat);
    digitalWrite(led4Pin, led4Etat);

    
    delayMicroseconds(1);
    client.stop(); // Ferme la connexion avec le client
   }

    //String commande = "reculer";

    //Serial.println(commande);
      
  
  
}
