<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, 
						initial-scale=1.0">
	<title>login</title>
	<link rel="stylesheet"
		href="css/login.css">
</head>

<body>
	<header>
		<h1 class="heading">Welcome</h1>
	</header>

	<!-- container div -->
	<div class="container">

		<!-- upper button section to select
			the login or signup form -->
		<div class="slider"></div>
		<div class="btn">
			<button class="login">Login</button>
			<button class="signup">Signup</button>
		</div>

		<!-- Form section that contains the
			login and the signup form -->
		<div class="form-section">

			<!-- login form -->
            <form action="connexion.php" method="post">
            <div class="login-box">
				<input type="email"
					class="email ele" id="email" name="email"
					placeholder="youremail@email.com">
				<input type="password"
					class="password ele" id="password" name="mot_de_passe"
					placeholder="password">
				<button class="clkbtn">Login</button>
			</div>
            </form>

			<!-- signup form -->
			<form action="addUser.php" method="post">
            <div class="signup-box">
				<input type="text"
					class="name ele<?php echo (isset($erreurs['prenom'])) ? 'is-invalid' : ''; ?>" id="prenom" name="prenom"
					placeholder="Prenom">
                    <?php if (isset($erreurs['prenom'])) { ?>
                    <div class="invalid-feedback">
                        <?php echo $erreurs['prenom']; ?>
                    </div>
                     <?php } ?>
                <input type="text"
					class="name ele <?php echo (isset($erreurs['nom'])) ? 'is-invalid' : ''; ?>" id="nom" name="nom"
					placeholder="Nom">
                    <?php if (isset($erreurs['nom'])) { ?>
                    <div class="invalid-feedback">
                        <?php echo $erreurs['nom']; ?>
                    </div>
                    <?php } ?>
				<input type="email"
					class="email ele <?php echo (isset($erreurs['email'])) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" required>
                <?php if (isset($erreurs['email'])) { ?>
                    <div class="invalid-feedback">
                        <?php echo $erreurs['email']; ?>
                    </div>
                <?php } ?>
					
				<input type="password"
					class="password ele<?php echo (isset($erreurs['password'])) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Mot de passe" required>
                <?php if (isset($erreurs['password'])) { ?>
                    <div class="invalid-feedback">
                        <?php echo $erreurs['password']; ?>
                    </div>
                <?php } ?>
				
				<button type="submit" class="clkbtn">Signup</button>
			</div>
            </form>
		</div>
	</div>
	<script src="js/script.js"></script>
</body>
</html>
