<main>
	<div>

	<div class="principal">
		<h2>Gestión de productos</h2>
	</div>

		
		<!-- mensaje flash al ingresar un nuevo producto -->
				<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'completed') : ?>

					<div>
						<p class="exito">Se ha añadido con exito un nuevo producto.</p>
					</div>

				<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed') : ?>

					<div>
						<p class="error">Ha ocurrido un error al añadir un nuevo producto.</p>
					</div>

				<?php endif; ?>

			<!-- borrando sesiones -->
				<?php Utils::deleteSession('producto'); ?>



		<!-- mensaje flash al borrar un producto -->
				<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed') : ?>

					<div>
						<p class="exito">Se ha eliminado con exito un producto.</p>
					</div>

				<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>

					<div>
						<p class="error">Ha ocurrido un error al eliminar un producto.</p>
					</div>

				<?php endif; ?>

			<!-- borrando sesiones -->
				<?php Utils::deleteSession('delete'); ?>

				


				<div class="">
					<h3 class="tabla_title">NOMBRE</h3>
					<h3 class="tabla_title">PRECIO</h3>
					<h3 class="tabla_title">STOCK</h3>
					<h3 class="tabla_title">ACCIONES</h3>
				</div>
				<div class="tabla_block_productos">
					<?php while($producto = $productos->fetch_object())  : ?>
						<P class="tabla" style="text-align: start;"><?= $producto->nombre; //accedemos a la propiedad id del objeto?></P>
						<P class="tabla"><?= $producto->precio; ?></P>
						<P class="tabla"><?= $producto->stock; ?></P>
						<div class="tabla_boton">
							<a href="<?=base_url?>producto/edit&id=<?=$producto->id?>" class="boton_a boton_edit">Editar</a>	<!-- el link nos lleva al controller producto y metodo edit, con el id del producto, y como e link ya esta constituido por parametros get, el id es el tercer parametro, por lo tanto se usa &-->
							<a href="<?=base_url?>producto/delete&id=<?=$producto->id?>" class="boton_a boton_delete">Eliminar</a>
						</div>
						
					<?php endwhile; ?>
				</div>
			</div>

	
		<a href="<?=base_url?>producto/create" class="boton_a" style="display: block;">Crear Producto</a>
</main>