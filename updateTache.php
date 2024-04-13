<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'database/config.php';

    // Récupérer les valeurs du formulaire
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $dateEcheance = $_POST['dateEcheance'];
    $priorite = $_POST['priorite'];
    $etat = $_POST['etat']; // Ajout de l'état
    $taskId = $_POST['taskId']; // Récupérer l'ID de la tâche à mettre à jour

    // Mettre à jour la tâche
    try {
        
        $tache->mettreAJourTache($taskId, $libelle, $description, $dateEcheance, $priorite, $etat);
        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Une erreur s'est produite lors de la mise à jour de la tâche.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour une tâche</title>
    <link rel="stylesheet" href="css/update.css">
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

button[type="submit"] {
    background-color: var(--couleur-principale); 
    border-color: var(--couleur-fond); 
    color:var(--couleur-fond);
    font-family: Roboto;
    border: none;
    border-radius: 20px;
    padding: 12px 20px;
    font-size: 18px;
    cursor: pointer;
    margin-bottom: 60px;
}

button[type="submit"]:hover {
    background-color: var(--couleur-positive);
    color:var(--couleur-fond);
    font-size: 24px;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="container">
    <div class="titre"><h1 >Mettre à jour une tâche</h1></div>
    <?php
    // Récupérer l'ID de la tâche à partir de la requête GET
    $taskId = $_GET['id'];

    // Requête SQL pour récupérer les détails de la tâche
    require_once 'database/config.php';
   
    try {
        $sql = "SELECT * FROM Tache WHERE id = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(1, $taskId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Une erreur s'est produite lors de la récupération des détails de la tâche.";
    }
    ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="libelle">Libellé :</label>
            <input type="text" class="form-control" id="libelle" name="libelle" value="<?php echo $row['libelle']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="dateEcheance">Date et heure d'échéance :</label>
            <input type="datetime-local" class="form-control" id="dateEcheance" name="dateEcheance" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_echeance'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="priorite">Priorité :</label>
            <select class="form-control" id="priorite" name="priorite" required>
                <option value="faible" <?php if($row['priorite'] == 'faible') echo 'selected'; ?>>Faible</option>
                <option value="moyenne" <?php if($row['priorite'] == 'moyenne') echo 'selected'; ?>>Moyenne</option>
                <option value="élevée" <?php if($row['priorite'] == 'élevée') echo 'selected'; ?>>Élevée</option>
            </select>
        </div>
        <div class="form-group">
            <label for="etat">État :</label>
            <select class="form-control" id="etat" name="etat" required>
                <option value="à faire" <?php if($row['etat'] == 'à faire') echo 'selected'; ?>>À faire</option>
                <option value="en cours" <?php if($row['etat'] == 'en cours') echo 'selected'; ?>>En cours</option>
                <option value="terminée" <?php if($row['etat'] == 'terminée') echo 'selected'; ?>>Terminée</option>
            </select>
        </div>
        <input type="hidden" name="taskId" value="<?php echo $taskId; ?>"> <!-- Ajoutez un champ caché pour stocker l'ID de la tâche -->
        <button type="submit" class="btn ">Mettre à jour la tâche</button>
    </form>
</div>

