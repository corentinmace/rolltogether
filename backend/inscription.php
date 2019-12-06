<?php

if(isset($_POST) && !empty($_POST)){ // Si le formulaire a été rempli
    if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp'])){
        $nom = htmlspecialchars($_POST['nom']); // On récupère le nom
        $prenom = htmlspecialchars($_POST['prenom']); // On récupère le nom
        $pseudo = htmlspecialchars($_POST['pseudo']); // On récupère le pseudo
        $email = htmlspecialchars($_POST['email']); // On récupère l'email
        $mdp = htmlspecialchars($_POST['mdp']); // On récupère le mdp

        $db_infos = parse_ini_file("db.ini"); // On récupère les infos de connexion depuis le fichier ini
        $db = new PDO($db_infos['dsn'], $db_infos['username'], $db_infos['password']); // On se connecte à la database

        $query = $db->prepare("INSERT INTO User(pseudo, password, email, nom, prenom) VALUES(:pseudo, :password, :email, :nom, :prenom);"); // On prépare la requête

        /* On insère les variables dans la requête */
        $query->bindParam(":pseudo", $pseudo);
        $query->bindParam(":password", hash("SHA512", $mdp)); // On hash le mot de passe pour ne pas le stocker en clair dans la database
        $query->bindParam(":nom", $nom);
        $query->bindParam(":prenom", $prenom);
        $query->bindParam(":email", $email);
        try{
            $db->exec($query); // On exécute la requête
        }catch (Error $error){ // S'il y a une erreur
            echo "Erreur: " . $error; // On l'affiche
        }
        header("Location: ../frontend/page_connexion.html"); // On redirige vers la page de connexion

        $db = null; // On ferme la connexion
    }
}
