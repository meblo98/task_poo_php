<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Inclure FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/profil.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <?php
 require_once "include/header.php";
session_start();
if (!isset($_SESSION['id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: index.php");
    exit;
}
?>

<main>
    <?php
    require_once "database/config.php";
    // Récupérer l'ID de l'utilisateur à partir de la session
    $userId = $_SESSION['id'];

    // Requête SQL pour récupérer les informations de l'utilisateur à partir de son ID
    $sql = "SELECT * FROM Utilisateur WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe dans la base de données
    if ($user) {
        // Afficher les informations de l'utilisateur
        echo "<div class='container'>";
        echo "<div class='card'>";
        echo "<div class='card-header'>Informations de l'utilisateur</div>";
        echo "<div class='card-body'>";
        echo "<p class='texte'><i class='fas fa-user'><span> Nom : </span></i> " . $user['nom'] . "</p>";
        echo "<p class='texte'><i class='fas fa-user'> <span> Prénom : </span></i>" . $user['prenom'] . "</p>";
        echo "<p class='texte'><i class='fas fa-envelope'><span> Email : </span></i> " . $user['email'] . "</p>";
        echo "<p class='texte'><i class='fas fa-key'> <span> Mot de passe : </span></i>" . $user['mot_de_passe'] . "</p>";
        echo "<p class='icon'>";
        // Lien vers la page d'édition de la tâche
        echo "<a href='updateUser.php?id=" . $userId . "' title='Modifier mes informations'>";
        echo "<i class='fas fa-edit fa-2x' style='color: #2ECC71;'></i>";
        echo "</a>";
        echo "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        // Afficher d'autres informations selon vos besoins
    } else {
        echo "Utilisateur non trouvé.";
    }
    ?>
    
</main>
    </div>
</div>
<style>

    .card-header {
  font-size: 28px; /* Taille de la police du titre */
  text-align: center;
  font-weight: bold;
  margin-bottom: 30px;
  background: var(--couleur-principale);
  color: var(--couleur-fond);
}
</style>
</body>
</html>
