<?php
session_start();
require_once "database/config.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: index.php");
    exit;
}

// Récupérer l'ID de l'utilisateur à partir de la session
$userId = $_SESSION['id'];

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les nouvelles informations de l'utilisateur depuis le formulaire
    $newNom = $_POST['nom'];
    $newPrenom = $_POST['prenom'];
    $newEmail = $_POST['email'];
    $newMotDePasse = $_POST['mot_de_passe'];

    // Requête SQL pour mettre à jour les informations de l'utilisateur
    $sql = "UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':nom', $newNom);
    $stmt->bindParam(':prenom', $newPrenom);
    $stmt->bindParam(':email', $newEmail);
    $stmt->bindParam(':mot_de_passe', $newMotDePasse);
    $stmt->bindParam(':id', $userId);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger l'utilisateur vers la page de profil avec un message de succès
        header("Location: profil.php?success=1");
        exit;
    } else {
        // En cas d'erreur lors de l'exécution de la requête, afficher un message d'erreur
        echo "Erreur lors de la mise à jour des informations de l'utilisateur.";
    }
}

// Récupérer les informations actuelles de l'utilisateur
$sql = "SELECT * FROM Utilisateur WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les informations</title>
    <link rel="stylesheet" href="css/updateUser.css">
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="titre"><h2>Modifier mes informations</h2></div>
    <form method="post" action="">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user['nom']; ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<style>
    .form-control{
    padding: 12px 20px;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 30px;
    border-bottom: 1px solid var(--couleur-positive);
    border-top: none;
    border-left: none;
    border-right: none;
    border-radius: 20px;
    height: 50px;
}
</style>
</body>
</html>
