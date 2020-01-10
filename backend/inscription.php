<?php

if(isset($_POST) && !empty($_POST)){ // Si le formulaire a été rempli
    if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp'])){
        $nom = htmlspecialchars($_POST['nom']); // On récupère le nom
        $prenom = htmlspecialchars($_POST['prenom']); // On récupère le nom
        $pseudo = htmlspecialchars($_POST['pseudo']); // On récupère le pseudo
        $email = htmlspecialchars($_POST['email']); // On récupère l'email
        $mdp = htmlspecialchars($_POST['mdp']); // On récupère le mdp
        $hashedMdp = hash("SHA512", $mdp);

        $db_infos = parse_ini_file("db.ini"); // On récupère les infos de connexion depuis le fichier ini
        $db = new PDO($db_infos['dsn'], $db_infos['username'], $db_infos['password']); // On se connecte à la database

        $query = $db->prepare("INSERT INTO user(Pseudo, Password, Email, Nom, Prenom) VALUES(:pseudo, :password, :email, :nom, :prenom);"); // On prépare la requête
        /* On insère les variables dans la requête */
        $query->bindParam(":pseudo", $pseudo);
        $query->bindParam(":password", $hashedMdp); // On hash le mot de passe pour ne pas le stocker en clair dans la database
        $query->bindParam(":nom", $nom);
        $query->bindParam(":prenom", $prenom);
        $query->bindParam(":email", $email);
        if ((preg_match (" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $email)) && (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $mdp)))
        {
          try{
              $query->execute(); // On exécute la requête
              header("Location: ../frontend/page_connexion.html"); // On redirige vers la page de connexion
              // $query->exec();
              // die(var_dump($query));
              // die (var_dump($query));
            }catch (Error $error){ // S'il y a une erreur
                echo "Erreur: " . $error; // On l'affiche
            }
        } else {
          if (!preg_match (" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $email)) {
            echo 'email non conforme';
          } else if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $mdp)) {
            echo 'mot de passe non conforme';
          }
        }

        $db = null; // On ferme la connexion
    }
}
