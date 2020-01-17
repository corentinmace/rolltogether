<?php

class Database{
    private static $_instance = null; // L'attribut d'instance du Singleton

    private $ini = null; // La variable qui va stocker l'objet .ini
    private $db = null; // La variable qui va stocker l'objet PDO

    /**
     * Database constructor.
     */
    private function __construct(){}

    public function __destruct(){
        self::$_instance = null;
    }

    /**
     * @return Database|null Si la classe a déjà été instanciée, on la renvoie. Sinon, on la crée
     */
    public static function getInstance(){
        if(is_null(self::$_instance)){ // Si aucune instance n'a été créée
            self::$_instance = new Database(); // On en crée une
        }
        return self::$_instance; // On renvoie l'instance créée
    }

    /**
     * @param $ini // On stocke dans l'objet le chemin vers le fichier de conf ini
     */
    public function setIni($ini){
        if(!is_null($ini) && "" != $ini){ // Si le chemin est valide
            $this->ini = $ini; // On enregistre le fichier ini
            $this->connectDatabase(); // On se connecte à la bdd
        }
    }

    /**
     * @return array|false On retourne le fichier parsé
     */
    private function getIniData(){
        if(parse_ini_file($this->ini) == false){ // Si l'ouverture du fichier échoue
            throw new InvalidArgumentException("Chemin de fichier incorrect");
        }else{
            return parse_ini_file($this->ini); // On renvoie les valeurs du fichier
        }
    }

    /**
     * Fonction de connexion à la database avec gestion des erreurs
     */
    private function connectDatabase(){
        try{
            $this->getIniData();  // On essaye d'ouvrir le fichier ini
        }catch(InvalidArgumentException $i){ // S'il y a une erreur
            echo "Erreur lors de l'ouverture du fichier de configuration ini: " . $i->getMessage();
            exit(-1);
        }

        try{
            $this->db = new PDO($this->getIniData()['dbname'], $this->getIniData()['user'], $this->getIniData()['password']); // On se connecte à la database
        }catch(PDOException $e){
            echo "Erreur lors de la connexion à la BDD: " . $e->getMessage(); // On affiche l'erreur
        }
    }

    /**
     * @param $q // La requête à effectuer
     * @return mixed // Renvoie le résultat de la requête
     */
    public function query($query){
        return $this->db->query($query);
    }

    /**
     * @param $q // La requête à effectuer
     * @return mixed // Renvoie le résultat de la requête
     */
    public function prepare($query){
        return $this->db->prepare($query);
    }
}
