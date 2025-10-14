<main>
	<div class="principal">	
		<h2>Crear nueva categoria</h2>

		<div class="block registro">
			<form action="<?=base_url?>categoria/save" method="POST">		<!-- el link lleva al metodo save del controller categoria -->
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" placeholder="Nombre de la categoria" required>

				<input type="submit" name="submit_registro" class="boton_enviar" value="Enviar">
			</form>	
		</div>
	</div>
</main>