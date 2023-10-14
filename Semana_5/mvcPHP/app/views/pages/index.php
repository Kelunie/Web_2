<!DOCTYPE html>
		<html lang="en">
		<head>
			<?php
			   require_once(appRoot . '/views/includes/enca.php');
			?>
			<title><?php echo siteName; ?></title>
		</head>
		<body class="container">
			<header class="col-12">
				<?php
					require_once(appRoot . '/views/includes/menu.php');
				?>        
			</header>
			<main class="col-12 linea_sep">
				<?php
					if(isLoggedIn()){
                        echo "Usted es: " . $_SESSION['usuario'];
                    }else{
                        echo "Por favor autentiquese ante nosotros...";
                    }
				?>
			</main>
			<footer class="col-12 linea_sep">
				<?php
					require_once(appRoot . '/views/includes/pie.php');
				?>
			</footer>
		</body>
		</html>