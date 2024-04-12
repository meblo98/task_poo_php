<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* Inclure le fichier config */
require_once "database/config.php";

// Récupérer les données du formulaire
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

// Vérifier si les champs email et mot_de_passe ne sont pas vides
if(empty($email) || empty($mot_de_passe)) {
    echo "<script>alert('Veuillez saisir votre email et mot de passe'); window.location='login.php?error=veuillez saisir votre email et mot de passe';</script>";
    exit;
}

// Préparer et exécuter la requête SQL de vérification
$sql = "SELECT * FROM Utilisateur WHERE email = :email AND mot_de_passe = :mot_de_passe";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":mot_de_passe", $mot_de_passe);
$stmt->execute();
$resultat = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultat) {
    // Utilisateur trouvé, connectez l'utilisateur
    session_start();
    $_SESSION['email'] = $email;

    // Récupérer les informations de l'utilisateur
    $_SESSION['id'] = $resultat['id']; 
    $_SESSION['prenom'] = $resultat['prenom'];
    $_SESSION['nom'] = $resultat['nom'];
    $_SESSION['email'] = $resultat['email'];
    $_SESSION['logged'] = true;

    header('Location: dashboard.php'); // Redirigez l'utilisateur vers la page d'accueil après la connexion
    exit();
} else {
    // Utilisateur non trouvé, afficher un message d'erreur avec une alerte en JavaScript
    echo "<script>alert('Utilisateur non trouvé, rediriger avec un message d\'erreur'); window.location='index.php?error=email ou mot de passe incorrect';</script>";
    exit;
}

// Fermer la connexion
$connexion = null;
?>
