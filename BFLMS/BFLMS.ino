#include <UIPEthernet.h>
#include <HID.h>

#include <SPI.h>

int bluepin       = 8;
int greenpin      = 7;
int yellowpin     = 5;
int redpin        = 3;

const int trigPin = A0;
const int echoPin = A1;
int sensor        = 1;

int level;
float duration, data, distance, water_level;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress server( 192, 168, 137, 1);

EthernetClient client;

void setup() {
  // put your setup code here, to run once:

Serial.begin(9600);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  pinMode(bluepin, OUTPUT);
  pinMode(greenpin, OUTPUT);
  pinMode(yellowpin, OUTPUT);
  pinMode(redpin, OUTPUT);

  if(Ethernet.begin(mac) == 0){
    Serial.println("Failed to configure Ethernet using DHCP");
  }
}

void loop() {
  // put your main code here, to run repeatedly:
  digitalWrite(trigPin, LOW);
  delayMicroseconds(1);

  digitalWrite(trigPin, HIGH);
  delayMicroseconds(2);
  digitalWrite(trigPin, LOW);

  duration = pulseIn(echoPin, HIGH);
  distance = duration * 0.034 / 2;

  data = 20 - distance;

  if(data <= 0){
    water_level = 0;
  }else{
    water_level = data;
  }
  warning_light();
  Sending_To_phpmyadmindatabase(); 
  delay(1000);
}

void Sending_To_phpmyadmindatabase(){   //CONNECTING WITH MYSQL

   if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    Serial.print("GET /bflmsv1/data/data.php?street_id=");
    client.print("GET /bflmsv1/data/data.php?street_id=");     //YOUR URL
    Serial.println(sensor);
    client.print(sensor);
    Serial.print("&data=");
    client.print("&data=");
    Serial.println(water_level);
    client.print(water_level);
    Serial.print("&level=");
    client.print("&level=");
    Serial.println(level);
    client.print(level);
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.137.1");
    client.println("Connection: close");
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
}

void warning_light(){

  if (water_level >= 15.51 && water_level < 20) {
    level = 5;
    digitalWrite(bluepin, LOW);
    digitalWrite(greenpin, LOW);
    digitalWrite(yellowpin, LOW);
    digitalWrite(redpin, HIGH);
  } else if (water_level >= 10.51 && water_level < 15.50) {
    level = 4;
    digitalWrite(bluepin, LOW);
    digitalWrite(greenpin, LOW);
    digitalWrite(yellowpin, HIGH);
    digitalWrite(redpin, LOW);
  } else if(water_level >= 5.51 && water_level < 10.50){
    level = 3;
    digitalWrite(bluepin, LOW);
    digitalWrite(greenpin, HIGH);
    digitalWrite(yellowpin, LOW);
    digitalWrite(redpin, LOW);
  }else if(water_level >= 1 && water_level <= 5.50){
    level = 2;
    digitalWrite(bluepin, HIGH);
    digitalWrite(greenpin, LOW);
    digitalWrite(yellowpin, LOW);
    digitalWrite(redpin, LOW);
  }else{
    level = 1;
    digitalWrite(bluepin, LOW);
    digitalWrite(greenpin, LOW);
    digitalWrite(yellowpin, LOW);
    digitalWrite(redpin, LOW);
  }
  Serial.print("Distance: ");
  Serial.print(water_level);
  Serial.println(" cm");
  Serial.print("warning level: ");
  Serial.println(level);
}