#include <Ethernet.h> // Inclut la bibliothèque Ethernet

const int avancerPin = 1; // Broche utilisée pour envoyer la commande "avancer"
const int gauchePin = 3; // Broche utilisée pour envoyer la commande "tourner à gauche"
const int droitePin = 5; // Broche utilisée pour envoyer la commande "tourner à droite"
const int reculerPin = 9; // Broche utilisée pour envoyer la commande "reculer"

const int led1Pin = 6; // Broche de la LED 1
const int led2Pin = 8; // Broche de la LED 2
const int led3Pin = 2; // Broche de la LED 3
const int led4Pin = 3; // Broche de la LED 4

bool led1Etat = LOW; // Etat de la LED 1 (éteint par défaut)
bool led2Etat = LOW; // Etat de la LED 2 (éteint par défaut)
bool led3Etat = LOW; // Etat de la LED 3 (éteint par défaut)
bool led4Etat = LOW; // Etat de la LED 4 (éteint par défaut)

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; // Adresse MAC de l'Arduino
byte ip[] = { 192, 168, 65, 71 }; // Adresse IP 

EthernetServer server(80); // Crée un serveur TCP sur le port 80

void setup() {
  // Configure les broches de sortie et initialise l'Ethernet et le serveur
  pinMode(avancerPin, OUTPUT);
  pinMode(gauchePin, OUTPUT);
  pinMode(droitePin, OUTPUT);
  pinMode(reculerPin, OUTPUT);
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
  if (client) { // Si une connexion est disponible
    String commande = ""; // Crée une chaîne vide pour stocker la commande
    while (client.connected()) { // Tant que le client est connecté
      if (client.available()) { // Si des données sont disponibles à lire
        char c = client.read(); // Lit le caractère suivant
        commande += c; // Ajoute le caractère à la chaîne
        Serial.println("C'est bon");
      }
    }

    Serial.println(commande);

    // Compare la chaîne à différentes valeurs pour savoir quelle commande a été envoyée
    if (commande == "avancer") {
      digitalWrite(avancerPin, HIGH); // Envoie la commande "avancer"
      led1Etat = HIGH; // Allume la LED 1
      led2Etat = HIGH; // Allume la LED 2
      led3Etat = LOW; // Eteint la LED 3
      led4Etat = LOW; // Eteint la Led 4

          } else if (commande == "gauche") {
      digitalWrite(gauchePin, HIGH); // Envoie la commande "tourner à gauche"
      led1Etat = LOW; // Eteint la LED 1
      led2Etat = LOW; // Eteint la LED 2
      led3Etat = HIGH; // Allume la LED 3
      led4Etat = LOW; // Eteint la LED 4
    } else if (commande == "droite") {
      digitalWrite(droitePin, HIGH); // Envoie la commande "tourner à droite"
      led1Etat = LOW; // Eteint la LED 1
      led2Etat = LOW; // Eteint la LED 2
      led3Etat = LOW; // Eteint la LED 3
      led4Etat = HIGH; // Allume la LED 4
    } else if (commande == "reculer") {
      digitalWrite(reculerPin, HIGH); // Envoie la commande "reculer"
      led1Etat = LOW; // Eteint la LED 1
      led2Etat = HIGH; // Allume la LED 2
      led3Etat = LOW; // Eteint la LED 3
      led4Etat = HIGH; // Allume la LED 4
    }

    // Met à jour l'état des LED
    digitalWrite(led1Pin, led1Etat);
    digitalWrite(led2Pin, led2Etat);
    digitalWrite(led3Pin, led3Etat);
    digitalWrite(led4Pin, led4Etat);

    

    client.stop(); // Ferme la connexion avec le client
  }
  else
  {
    Serial.println("Pas Bon");
  }
}
