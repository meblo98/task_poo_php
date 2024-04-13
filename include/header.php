<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Inclure FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <!-- Barre de navigation -->
    <aside class="col-md-3 bg-light">
        <div class="logo">
            <a href="dashboard.php"><span>Sama</span>Tâche</a>
        </div>
        <nav aria-label="Barre de navigation">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php"><i class="fas fa-user"></i> Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logout" href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </li>
            </ul>
        </nav>

    </aside>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélectionne le lien de déconnexion
            var logoutLink = document.querySelector('.logout');
            // Ajoute un gestionnaire d'événements au clic sur le lien de déconnexion
            logoutLink.addEventListener('click', function(event) {
                // Empêche le lien de se comporter comme un lien normal
                event.preventDefault();
                // Affiche une alerte
                if (confirm("Voulez-vous vraiment vous déconnecter?")) {
                    // Si l'utilisateur confirme, redirige vers la page de déconnexion
                    window.location.href = "logout.php";
                }
            });
        });
    </script>
</body>
</html>
