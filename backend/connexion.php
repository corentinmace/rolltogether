<?php

if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
        $pseudo = $_POST['pseudo']; // On récupère le pseudo
        $mdp = $_POST['mdp']; // On récupère le password

        $db_infos = parse_ini_file("db.ini"); // On récupère les infos de connexion depuis le fichier ini
        $db = new PDO($db_infos['dsn'], $db_infos['username'], $db_infos['password']); // On se connecte à la database

        $query = $db->query("SELECT id, password FROM User WHERE pseudo='" . $pseudo . "';")->fetch(); // On récupère le hash du mot de passe en database
        if(hash("SHA512", $mdp) === $query['password']){ // Si les deux correspondent
            session_start(); // On lance la session
            $_SESSION['pseudo'] = $pseudo; // On stocke le pseudo en session
            $_SESSION['id'] = $query['id']; // On stocke le pseudo en session
            header("Location: ../frontend/user.html"); // On redirige vers la page utilisateur
        }else{
            return "Les identifiants sont incorrects !";
        }
    }
}