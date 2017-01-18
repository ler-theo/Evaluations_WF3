<?php

try {
  $bdd = new PDO('mysql:host=localhost;dbname=voiture', 'root', '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
  );
} catch (Exception $e) {
  die('Erreur : ' . $e -> getMessage());
}

//Recuperation des données
$credentials = array(
  "marque" => $_POST['marque'],
  "modele" => $_POST['modele'],
  "years" => $_POST['years'],
  "couleur" => $_POST['couleur']
);

var_dump($credentials);
var_dump($_POST);
$insertAutoBdd = $bdd -> prepare('INSERT INTO vroumvroum (marque, modele, years, couleur)
VALUES (:marque, :modele, :years, :couleur)');

$verficiation = $insertAutoBdd -> execute(array(
  "marque" => $credentials['marque'],
  "modele" => $credentials['modele'],
  "years" => $credentials['years'],
  "couleur" => $credentials['couleur']
));

if ($verficiation) {

  $msg = "Creation reussie, livraison dans 6 mois !";
  //Je renvois une reponse JSON
  header('content-Type: application/json');

  //Je formate la reponse en JSON
  echo json_encode(array(
    "success" => true,
    "msg" => $msg
  ));

}
