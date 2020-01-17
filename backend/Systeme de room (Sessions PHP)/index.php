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

  echo("<script>console.log('DATA :".$_SESSION['data']." ID : ".session_id()." NAME : ".session_name()."')</script>");

  echo '<a href=index.php?id='.session_id().'>Inviter dans la partie</a>';

  echo '<p>Salle : '.session_id().'</p>';

  $id = session_id();

if(isset($_POST['nbJoueur'])) {
  $nbJoueur=$_POST['nbJoueur'];
} else {
  $nbJoueur=0;
}

if(isset($_POST['visible'])) {
  $visible=false;
} else {
  $visible=true;
}

if(isset($_POST['nom'])) {
  $nomGame=$_POST['nom'];
} else {
  $nomGame="";
}

if(isset($_POST['Id_Scenario'])) {
  $idScenario=$_POST['Id_Scenario'];
} else {
  $idScenario=1;
}

if(isset($_POST['Id_User'])) {
  $idUser=$_POST['Id_User'];
} else {
  $idUser=1;
}

  $connect = Database::getInstance();

  $connect->setIni("db.ini");
  // $partie = $connect->query("SELECT * FROM partie;")->fetch(PDO::FETCH_ASSOC);
  $connect->query("INSERT INTO partie VALUES(0, $nbJoueur, $visible, '$nomGame', $idScenario, $idUser, '$id')");


}

if (isset($_POST['button'])) {
  createSession();

}

if (isset($_GET['id'])) {
  session_id($_GET['id']);
  session_start();
    echo("<script>console.log('DATA :".$_SESSION['data']." ID : ".session_id()." NAME : ".session_name()."')</script>");

    echo '<p>Salle : '.session_id().'</p>';

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rolltogether - Room</title>
  </head>
  <body>
    <header>

    </header>
    <main>
      <form action="#" method="post">
        <input type="text" name="nom" placeholder="Nom de la room">
        <br>
        <label for="visible">Privée</label>
        <input type="checkbox" name="visible" value="">
        <br>
        <button type="submit" name="button">Créer une salle</button>
      </form>
    </main>
    <footer>

    </footer>
  </body>
</html>
