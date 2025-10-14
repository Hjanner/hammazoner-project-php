<main>
	<div class="principal">	

		<?php if(isset($edit) && isset($producto) && is_object($producto)) :?>

			<h2>Editar producto</h2>
			<?php  $url_action = base_url.'producto/save&id='.$producto->id; ?>
		
		<?php else: ?>
		
			<h2>Añadir un nuevo producto</h2>
			<?php  $url_action = base_url.'producto/save'; ?>
		
		<?php endif; ?>

		<div class="block registro">
			<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">		<!-- el link lleva al metodo save de controller de producto -->
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" placeholder="Nombre del producto" value="<?=isset($producto) && is_object($producto) ? $producto->nombre : ""?>" required> 				<!-- ña ternaria es para mostrar los valores de del objeto a editar, si existe edit -->

				<label for="descripcion">Descripcion:</label>
				<input type="text" name="descripcion" placeholder="Descripcion del producto" value="<?=isset($producto) && is_object($producto) ? $producto->descripcion : ""?>" required>

				<label for="precio">Precio:</label>
				<input type="text" name="precio" placeholder="Precio del producto" value="<?=isset($producto) && is_object($producto) ? $producto->precio : ""?>" required>

				<label for="stock">Stock:</label>
				<input type="number" name="stock" placeholder="Stock del producto" value="<?=isset($producto) && is_object($producto) ? $producto->stock : ""?>" required>

				<label for="categoria">Categoria:</label>
				<?php $categorias = Utils::showCategorias();  ?>
					<select name="categoria">
						<?php while($categoria = $categorias->fetch_object()) : ?>
							<option value="<?= $categoria->id?><?=isset($producto) && is_object($producto) && $categoria->id == $producto->categoria_id ? 'selected' : "" ?>">
								<?= $categoria->nombre; ?>
							</option>
						<?php endwhile; ?>
					</select>
				
				<div class="img_edit_block">
					<label for="imagen" placeholder="Ingrese imagen del producto: ">Imagen: </label>

					<?php if(isset($producto) && is_object($producto) && !empty($producto->imagen)) : ?>
						<img class="img_edit"src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="imagen del producto">
					<?php endif; ?>

					<input type="file" name="imagen">
				</div>

				<input type="submit" name="submit_registro" class="boton_enviar" value="Enviar">
			</form>	
		</div>
	</div>
</main>