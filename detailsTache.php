<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Tache</title>
    <link rel="stylesheet" href="detailsTache.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <!-- Inclure FontAwesome CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php
// Inclure votre classe Tache et établir la connexion à la base de données
require_once 'database/config.php';

try {
    // Récupérer l'ID de la tâche à afficher
    $taskId = $_GET['id'];

    // Récupérer les détails de la tâche spécifique
    $tacheDetails = $tache->TacheParId($taskId);

    // Afficher les détails de la tâche
    echo"<div class='container d-flex justify-content-center align-items-center' style='height: 100vh'>";
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title '> " . $tacheDetails['libelle'] . "</h5>";
    echo "<p class='card-text'> <span> Description : </span>" . $tacheDetails['description'] . "</p>";
    echo "<p class='card-text'><span> Date d'échéance :</span> " . $tacheDetails['date_echeance'] . "</p>";
    echo "<p class='card-text'><span> Priorité :</span> " . $tacheDetails['priorite'] . "</p>";
    echo "<p class='card-text'><span> État :</span> " . $tacheDetails['etat'] . "</p>";
    echo "<p class='icon'>";
     // Lien vers la page d'édition de la tâche
     echo "<a href='updateTache.php?id=" . $taskId . "' title='Modifier la tâche'>";
     echo "<i class='fas fa-edit fa-2x' style='color: #2ECC71;'></i>";
     echo "</a>";
     // Lien pour supprimer la tâche
     echo "<a href='deleteTache.php?id=" . $taskId . "' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet élément?');\" title='Supprimer la tâche'>";
     echo "<i class='fas fa-trash-alt fa-2x' style='color: red;'></i>";
     echo "</a>";
     echo "</p>";
     echo "<a href='javascript:history.go(-1)' class='btn'>Retour</a>"; 
    echo "</div>";
    echo "</div>";
    echo "</div>";
} catch (Exception $e) {
    echo "Une erreur s'est produite lors de la récupération des détails de la tâche : " . $e->getMessage();
}
?>
<style>
    .btn {
    background-color: var(--couleur-principale); 
    border-color: var(--couleur-fond); 
    color:var(--couleur-fond);
    font-family: Roboto;
    border: none;
    border-radius: 20px;
    padding: 12px 20px;
    font-size: 18px;
    cursor: pointer;
    margin-top: 40px;
}

.btn:hover {
    background-color: var(--couleur-positive);
    color:var(--couleur-fond);
    font-size: 24px;
    font-weight: bold;
}
</style>
</body>
</html>
