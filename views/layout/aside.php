	<aside class="block_aside">
		
			
		<?php if(!isset($_SESSION['identify'])) :?>
			<div class="block login">
				<h3>Login</h3>

				<form action="<?=base_url?>Usuario/login" method="POST">
					<label for="email">Email</label>
					<input type="email" name="email" placeholder="Ingresar correo">

					<label for="password">Contraseña</label>
					<input type="password" name="password" placeholder="Ingresar contraseña">

					<input type="submit" name="enviar" value="Entrar" class="boton_enviar">
				</form>
			</div>

			<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'Complete') : ?>
				<strong>Registro completado exitosamente</strong>
			<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'Failed'): ?>
				<strong>Registro fallido</strong>
			<?php endif; ?>

		<!-- cerrando session -->
			<?php Utils::deleteSession('register'); ?>

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
		<?php else : ?>
			<div class="block">
				<h3> <?= $_SESSION['identify']->nombre.' '.$_SESSION['identify']->apellidos ?> </h3>
			</div>
		<?php endif; ?>

		


		<div>
			<?php if(isset($_SESSION['identify'])) : ?>
				<?=  include_once 'views/layout/action.php'; ?>
			<?php endif; ?>
		</div>


	</aside>
