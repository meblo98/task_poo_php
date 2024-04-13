<?php
require_once "database/config.php";

if(isset($_GET['id'])){
    $idTache = $_GET['id'];
}
$tache->supprimerTache($idTache);

header ('location: dashboard.php');
exit();


?>


