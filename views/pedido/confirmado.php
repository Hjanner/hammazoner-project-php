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

<style>
.confirmacion-container {
	max-width: 900px;
	margin: 20px auto;
	background: white;
	padding: 40px;
	border-radius: 12px;
	box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.confirmacion-header {
	text-align: center;
	margin-bottom: 40px;
	padding-bottom: 30px;
	border-bottom: 3px solid #4CAF50;
}

.icon-success {
	font-size: 80px;
	margin-bottom: 20px;
	animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
	from { transform: scale(0); }
	to { transform: scale(1); }
}

.confirmacion-header h2 {
	color: #4CAF50;
	font-size: 32px;
	margin-bottom: 10px;
}

.mensaje-exito {
	color: #666;
	font-size: 18px;
}

.pedido-info {
	background: #f8f9fa;
	padding: 25px;
	border-radius: 8px;
	margin-bottom: 30px;
}

.pedido-info h3 {
	color: #333;
	margin-bottom: 20px;
	font-size: 20px;
}

.info-grid {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 20px;
	margin-bottom: 25px;
}

.info-item {
	display: flex;
	flex-direction: column;
	gap: 5px;
}

.info-label {
	font-size: 14px;
	color: #666;
	font-weight: normal;
}

.info-value {
	font-size: 18px;
	color: #333;
	font-weight: bold;
}

.estado-badge {
	display: inline-block;
	padding: 6px 12px;
	border-radius: 20px;
	font-size: 14px;
}

.estado-confirm {
	background-color: #d4edda;
	color: #155724;
}

.direccion-envio {
	background: white;
	padding: 20px;
	border-radius: 6px;
	border-left: 4px solid #4CAF50;
}

.direccion-envio h4 {
	margin-bottom: 15px;
	color: #333;
}

.direccion-envio p {
	margin: 8px 0;
	color: #555;
}

.productos-pedido {
	margin-bottom: 30px;
}

.productos-pedido h3 {
	margin-bottom: 20px;
	color: #333;
	font-size: 20px;
}

.tabla-productos {
	width: 100%;
	border-collapse: collapse;
	background: white;
	box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.tabla-productos th {
	background-color: #333;
	color: white;
	padding: 12px;
	text-align: left;
	font-size: 14px;
}

.tabla-productos td {
	padding: 12px;
	border-bottom: 1px solid #eee;
}

.producto-detalle {
	display: flex;
	align-items: center;
	gap: 12px;
}

.img-producto-mini {
	width: 50px;
	height: 50px;
	object-fit: cover;
	border-radius: 4px;
}

.total-row {
	background-color: #f9f9f9;
	font-size: 18px;
}

.total-row td {
	padding: 15px 12px !important;
	border-top: 2px solid #4CAF50;
}

.total-precio {
	color: #4CAF50;
	font-size: 22px;
}

.acciones-confirmacion {
	display: flex;
	gap: 15px;
	justify-content: center;
	margin: 30px 0;
}

.acciones-confirmacion .boton {
	flex: 1;
	max-width: 250px;
	text-align: center;
	padding: 14px 20px;
	font-size: 16px;
	font-weight: bold;
	border-radius: 6px;
	transition: all 0.3s;
}

.btn-primary {
	background-color: #4CAF50;
	color: white;
}

.btn-primary:hover {
	background-color: #45a049;
	transform: translateY(-2px);
	box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
}

.btn-secondary {
	background-color: #2196F3;
	color: white;
}

.btn-secondary:hover {
	background-color: #1976D2;
	transform: translateY(-2px);
	box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
}

.info-adicional {
	background: #e3f2fd;
	padding: 20px;
	border-radius: 8px;
	border-left: 4px solid #2196F3;
	text-align: center;
}

.info-adicional p {
	margin: 8px 0;
	color: #555;
	font-size: 14px;
}

.error-mensaje {
	text-align: center;
	padding: 40px;
}

.error-mensaje p {
	font-size: 18px;
	color: #d32f2f;
	margin-bottom: 20px;
}

@media (max-width: 768px) {
	.confirmacion-container {
		padding: 20px;
	}
	
	.info-grid {
		grid-template-columns: 1fr;
	}
	
	.tabla-productos {
		font-size: 12px;
	}
	
	.img-producto-mini {
		width: 40px;
		height: 40px;
	}
	
	.acciones-confirmacion {
		flex-direction: column;
	}
	
	.acciones-confirmacion .boton {
		max-width: 100%;
	}
}
</style>
