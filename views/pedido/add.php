<main>
	<div class="principal">
		<h2>Realizar Pedido</h2>

		<?php if(isset($carrito) && count($carrito) > 0) : ?>
			
			<div class="pedido-container">
				<!-- Resumen del Pedido -->
				<div class="pedido-resumen">
					<h3>📦 Resumen del Pedido</h3>
					<table class="tabla-pedido">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Precio</th>
								<th>Unidades</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($carrito as $item) : ?>
								<tr>
									<td>
										<div class="producto-info">
											<img src="<?=base_url?>uploads/images/<?=$item['imagen']?>" 
											     alt="<?=$item['nombre']?>" 
											     class="img-pedido">
											<span><?=$item['nombre']?></span>
										</div>
									</td>
									<td><?=number_format($item['precio'], 2)?> $</td>
									<td><?=$item['unidades']?></td>
									<td><strong><?=number_format($item['precio'] * $item['unidades'], 2)?> $</strong></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr class="total-row">
								<td colspan="3"><strong>Total a Pagar:</strong></td>
								<td><strong class="precio-total"><?=number_format($total, 2)?> $</strong></td>
							</tr>
						</tfoot>
					</table>
				</div>

				<!-- Formulario de Datos de Envío -->
				<div class="pedido-formulario">
					<h3>📍 Datos de Envío</h3>
					
					<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failed') : ?>
						<div class="alert alert-danger">
							❌ Error al procesar el pedido. Por favor, inténtalo de nuevo.
						</div>
						<?php Utils::deleteSession('pedido'); ?>
					<?php endif; ?>

					<form action="<?=base_url?>pedido/save" method="POST" class="form-pedido">
						<div class="form-group">
							<label for="provincia">
								<span class="label-icon">🏙️</span> Provincia *
							</label>
							<input type="text" 
							       name="provincia" 
							       id="provincia" 
							       placeholder="Ej: Buenos Aires" 
							       required 
							       class="form-input">
						</div>

						<div class="form-group">
							<label for="localidad">
								<span class="label-icon">📍</span> Localidad *
							</label>
							<input type="text" 
							       name="localidad" 
							       id="localidad" 
							       placeholder="Ej: La Plata" 
							       required 
							       class="form-input">
						</div>

						<div class="form-group">
							<label for="direccion">
								<span class="label-icon">🏠</span> Dirección Completa *
							</label>
							<input type="text" 
							       name="direccion" 
							       id="direccion" 
							       placeholder="Calle, número, piso, depto" 
							       required 
							       class="form-input">
						</div>

						<div class="form-botones">
							<a href="<?=base_url?>carrito/index" class="boton btn-secondary">
								← Volver al Carrito
							</a>
							<button type="submit" class="boton btn-success">
								✅ Confirmar Pedido
							</button>
						</div>
					</form>
				</div>
			</div>

		<?php else : ?>
			<div class="carrito-vacio">
				<p>😕 No hay productos en el carrito</p>
				<p>Agrega productos antes de realizar un pedido.</p>
				<a href="<?=base_url?>producto/index" class="boton">Ver Productos</a>
			</div>
		<?php endif; ?>

	</div>
</main>
