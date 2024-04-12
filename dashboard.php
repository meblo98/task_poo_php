<?php
// Inclure le fichier de configuration de la base de données
require_once 'config.php';
// Démarrez ou reprenez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if(isset($_SESSION['id'])) {
    // Récupérez l'identifiant de l'utilisateur à partir de la session
    $idUtilisateur = $_SESSION['id'];
} else {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: index.php");
    exit; // Arrêtez l'exécution du script
}
?>
