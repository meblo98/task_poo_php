<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "database/config.php";
require_once "classe/Tache.php";
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si toutes les données du formulaire sont présentes
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])  && isset($_POST['password'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mot_de_passe = $_POST['password'];

        // Expression régulière pour valider le prénom et le nom (par exemple, seulement des lettres et espaces)
        $regex_nom_prenom = "/^[a-zA-Z\s]+$/";

        // Expression régulière pour valider l'email
        $regex_email = "/^\S+@\S+\.\S+$/";


       
        // Vérifier si les données saisies correspondent aux expressions régulières
        if (preg_match($regex_nom_prenom, $nom) && preg_match($regex_nom_prenom, $prenom) && preg_match($regex_email, $email)  ) {
            // Les données sont valides, vous pouvez les traiter
            $user->addUser($nom, $prenom, $email, $mot_de_passe);

            header("Location: index.php"); // Rediriger vers une page de succès
            exit();
        } else {
            header("Location: inscription.php"); // Rediriger vers une page de succès
            exit();
           
        }
        
    }
}
?>