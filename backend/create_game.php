<?php

  require "Database.php";

function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createSession() {


  session_name(generateRandomString());
  session_start();
  $_SESSION['data'] = time();
  //
  // echo '<a target="_blank" href=index.php?id='.session_id().'>Inviter dans la partie</a>';
  //
  // echo '<p>Salle : '.session_id().'</p>';

  $id = session_id();


  $nom = htmlspecialchars($_POST['nom']);
  if(isset($_POST['visible'])) {
    $visible=0;
  } else {
    $visible=1;
  }



  $connect = Database::getInstance();

  $connect->setIni("db.ini");
  // $partie = $connect->query("SELECT * FROM partie;")->fetch(PDO::FETCH_ASSOC);
      $query = $connect->prepare("INSERT INTO partie(NbJoueur, Visible, Nom, Id_Scenario, Id_User) VALUES(10, :visible, :nom, 1, 666); ");


  $query->bindParam(':nom', $nom);
  $query->bindParam(':visible', $visible);

  try{
      $query->execute(); // On exécute la requête
      header("Location: ../frontend/partie.php");
  } catch(Exception $error){
        echo "Erreur: " . $error; // On l'affiche
    }

}

if (isset($_POST['button'])) {
  createSession();

}
?>
