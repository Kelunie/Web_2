<!DOCTYPE html>
		<html lang="en">
		<head>
			<?php
			   require_once(appRoot . '/views/includes/enca.php');
			?>
			<title><?php echo siteName; ?></title>
			<style>
				.centrar{
    				margin-left: 30%;
				}
			</style>
		</head>
		<body class="container">
			<header class="col-12">
				<?php
					require_once(appRoot . '/views/includes/menu.php');
				?>        
			</header>
			<main class="col-12 linea_sep centrar">        
				<div class="col-5 ">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Autentificación de usuarios</h4>
						</div>
						<div class="card-body">
							<form action="<?php echo urlRoot; ?>/users/login" method="post">
								<table class="table">
									<tbody>
										<tr>
											<td align="right"><strong>Usuario:</strong></td>
											<td><input type="Text" name="txtUsua" size="20" maxlength="15" required></td>
											<span class="invalidFeedback">
												<?php echo $data['userError']; ?>
											</span>
										</tr>
										<tr>
											<td align="right"><strong>Contraseña:</strong></td>
											<td><input type="password" name="txtContra" size="20" maxlength="15" required></td>
											<span class="invalidFeedback">
												<?php echo $data['passError']; ?>
											</span>
										</tr>
										<tr>
											<td colspan="2" align="center"><input type="submit" value="Aceptar" class="btn btn-primary"></td>
										</tr>
									</tbody>
								</table>						
								<a href="<?php echo urlRoot; ?>/users/register">Registrar usuario</a>
							</form>
						</div>
					</div>
				</div>
			</main>
			<footer class="col-12 linea_sep">
				<?php
					require_once(appRoot . '/views/includes/pie.php');
				?>
			</footer>
		</body>
		</html>