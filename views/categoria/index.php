<!--VISTA DEL METODO INDEX DEL CONTROLADOR--->

<main>		
	<h2 style="text-align: center;">Categorias</h2>

	<div>
		<div class="tabla_block">
			<h3 class="tabla">ID</h3>
			<h3 class="tabla">NOMBRE</h3>
		</div>
		<div class="tabla_block">
			<?php while($categoria = $categorias->fetch_object())  : ?>
				<P class="tabla"><?= $categoria->id; //accedemos a la propiedad id del objeto?></P>
				<P class="tabla"><?= $categoria->nombre; ?></P>
			<?php endwhile; ?>
		</div>
	</div>
	
	<a href="<?=base_url?>categoria/create" class="boton_a" style="display: block;">Crear Categoria</a>
</main>

<?php 

	

 ?>