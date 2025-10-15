<main>
	<div class="principal">
		<div class="confirmacion-container">
			<div class="confirmacion-header">
				<div class="icon-success">✅</div>
				<h2>¡Pedido Confirmado!</h2>
				<p class="mensaje-exito">Tu pedido ha sido procesado exitosamente</p>
			</div>

			<?php if(isset($pedido)) : ?>
				<div class="pedido-info">
					<h3>📋 Información del Pedido</h3>
					<div class="info-grid">
						<div class="info-item">
							<span class="info-label">Número de Pedido:</span>
							<span class="info-value">#<?= str_pad($pedido->id, 6, '0', STR_PAD_LEFT) ?></span>
						</div>
						<div class="info-item">
							<span class="info-label">Fecha:</span>
							<span class="info-value"><?= date('d/m/Y', strtotime($pedido->fecha)) ?></span>
						</div>
						<div class="info-item">
							<span class="info-label">Hora:</span>
							<span class="info-value"><?= $pedido->hora ?></span>
						</div>
						<div class="info-item">
							<span class="info-label">Estado:</span>
							<span class="info-value estado-badge estado-<?= $pedido->estado ?>">
								<?= $pedido->estado == 'confirm' ? 'Confirmado' : ucfirst($pedido->estado) ?>
							</span>
						</div>
					</div>

					<div class="direccion-envio">
						<h4>📍 Dirección de Envío</h4>
						<p><strong>Provincia:</strong> <?= $pedido->provincia ?></p>
						<p><strong>Localidad:</strong> <?= $pedido->localidad ?></p>
						<p><strong>Dirección:</strong> <?= $pedido->direccion ?></p>
					</div>
				</div>

				<?php if(isset($lineas)) : ?>
					<div class="productos-pedido">
						<h3>📦 Productos del Pedido</h3>
						<table class="tabla-productos">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php while($linea = $lineas->fetch_object()) : ?>
									<tr>
										<td>
											<div class="producto-detalle">
												<img src="<?=base_url?>uploads/images/<?=$linea->imagen?>" 
												     alt="<?=$linea->nombre?>" 
												     class="img-producto-mini">
												<span><?= $linea->nombre ?></span>
											</div>
										</td>
										<td><?= number_format($linea->precio, 2) ?> $</td>
										<td><?= $linea->unidades ?></td>
										<td><strong><?= number_format($linea->precio * $linea->unidades, 2) ?> $</strong></td>
									</tr>
								<?php endwhile; ?>
							</tbody>
							<tfoot>
								<tr class="total-row">
									<td colspan="3"><strong>Total:</strong></td>
									<td><strong class="total-precio"><?= number_format($pedido->coste, 2) ?> $</strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				<?php endif; ?>

				<div class="acciones-confirmacion">
					<a href="<?=base_url?>pedido/index" class="boton btn-primary">
						📦 Ver Mis Pedidos
					</a>
					<a href="<?=base_url?>producto/index" class="boton btn-secondary">
						🛍️ Seguir Comprando
					</a>
				</div>

				<div class="info-adicional">
					<p>📧 Recibirás un correo de confirmación con los detalles de tu pedido.</p>
					<p>🚚 El tiempo estimado de entrega es de 3-5 días hábiles.</p>
				</div>

			<?php else : ?>
				<div class="error-mensaje">
					<p>❌ No se pudo obtener la información del pedido.</p>
					<a href="<?=base_url?>producto/index" class="boton">Volver al Inicio</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>
