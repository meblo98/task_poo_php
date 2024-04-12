<?php

require_once "classe/Tache.php";
require_once "  classe/Utilisateur.php";

// Définition des constantes pour les informations de connexion à la base de données
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gestion_taches');

try {
    // Connexion à la base de données en utilisant PDO
    $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Configuration de PDO pour afficher les erreurs de requête SQL
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $user = new Utilisateur($connexion,"", "", "", "");
    $tache = new Tache($connexion, "", "", "", "", "", 1);
   
} catch(PDOException $e) {
    // Affichage d'un message d'erreur et arrêt du script si la connexion échoue
    die("ERREUR: Impossible de se connecter. " . $e->getMessage());
}
?>