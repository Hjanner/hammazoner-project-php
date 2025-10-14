<?php 

   //layout
    require_once 'views/layout/header.php';
    require_once 'views/layout/menu.php';
 ?>

	<?php if($_SESSION['register']) : ?>

		<div class="block registro">
			<h3>Registro</h3>

			<form action="<?=base_url?>Usuario/save" method="POST">

				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" placeholder="Ingresar nombre" required>

				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" placeholder="Ingresar apellido" required>

				<label for="email">Email</label>
				<input type="email" name="email" placeholder="Ingresar email" required>

				<label for="password">Contraseña</label>
				<input type="password" name="password" placeholder="Ingresar contraseña" required>

				<input type="submit" name="submit_registro" class="boton_enviar" value="Enviar">
			</form>
		</div>

	<?php elseif($_SESSION['register'] == 'Complete') : ?>
		<strong>Registro completado exitosamente.</strong>

	<?php  elseif($_SESSION['register'] == 'Failed') : ?>
		<strong>Ha ocurrido un error inesperado</strong>
	<?php endif; ?>	

	<!-- cerrando session -->
	<?php Utils::deleteSession('register'); ?>

 <?php 
	include_once 'views/layout/main.php';    
  	include_once 'views/layout/footer.php'; 
  ?>