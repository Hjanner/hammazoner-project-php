<main>
	<div class="principal">
		<?php if(isset($pedido)) : ?>
			<div class="detalle-container">
				<div class="detalle-header">
					<h2>📋 Detalle del Pedido #<?= str_pad($pedido->id, 6, '0', STR_PAD_LEFT) ?></h2>
					<a href="<?=base_url?>pedido/index" class="boton btn-volver">← Volver a Mis Pedidos</a>
				</div>

				<div class="detalle-grid">
					<!-- Información del Pedido -->
					<div class="detalle-card">
						<h3>📦 Información General</h3>
						<div class="info-list">
							<div class="info-item">
								<span class="label">Fecha de Pedido:</span>
								<span class="value"><?= date('d/m/Y', strtotime($pedido->fecha)) ?> a las <?= $pedido->hora ?></span>
							</div>
							<div class="info-item">
								<span class="label">Estado:</span>
								<span class="value">
									<span class="estado-badge estado-<?= $pedido->estado ?>">
										<?php 
											switch($pedido->estado) {
												case 'confirm':
													echo '✅ Confirmado';
													break;
												case 'preparation':
													echo '📦 En Preparación';
													break;
												case 'shipped':
													echo '🚚 Enviado';
													break;
												case 'delivered':
													echo '✅ Entregado';
													break;
												default:
													echo ucfirst($pedido->estado);
											}
										?>
									</span>
								</span>
							</div>
							<div class="info-item">
								<span class="label">Total:</span>
								<span class="value precio-destacado"><?= number_format($pedido->coste, 2) ?> $</span>
							</div>
						</div>
					</div>

					<!-- Dirección de Envío -->
					<div class="detalle-card">
						<h3>📍 Dirección de Envío</h3>
						<div class="direccion-box">
							<p><strong>Provincia:</strong> <?= $pedido->provincia ?></p>
							<p><strong>Localidad:</strong> <?= $pedido->localidad ?></p>
							<p><strong>Dirección:</strong> <?= $pedido->direccion ?></p>
						</div>
					</div>
				</div>

				<!-- Productos del Pedido -->
				<?php if(isset($lineas) && $lineas->num_rows > 0) : ?>
					<div class="productos-detalle">
						<h3>🛍️ Productos del Pedido</h3>
						<table class="tabla-detalle">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Precio Unitario</th>
									<th>Cantidad</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$total_calculado = 0;
								while($linea = $lineas->fetch_object()) : 
									$subtotal = $linea->precio * $linea->unidades;
									$total_calculado += $subtotal;
								?>
									<tr>
										<td>
											<div class="producto-info">
												<img src="<?=base_url?>uploads/images/<?=$linea->imagen?>" 
												     alt="<?=$linea->nombre?>" 
												     class="img-mini">
												<span class="nombre"><?= $linea->nombre ?></span>
											</div>
										</td>
										<td class="precio"><?= number_format($linea->precio, 2) ?> $</td>
										<td class="cantidad"><?= $linea->unidades ?></td>
										<td class="subtotal"><?= number_format($subtotal, 2) ?> $</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3" class="text-right"><strong>Total:</strong></td>
									<td class="total-final"><strong><?= number_format($pedido->coste, 2) ?> $</strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
				<?php endif; ?>

				<div class="detalle-acciones">
					<a href="<?=base_url?>pedido/index" class="boton btn-secondary">← Volver a Mis Pedidos</a>
					<a href="<?=base_url?>producto/index" class="boton btn-primary">🛍️ Seguir Comprando</a>
				</div>
			</div>

		<?php else : ?>
			<div class="error-mensaje">
				<p>❌ No se pudo obtener la información del pedido.</p>
				<a href="<?=base_url?>pedido/index" class="boton">Ver Mis Pedidos</a>
			</div>
		<?php endif; ?>
	</div>
</main>

<style>
.detalle-container {
	display: block;
	max-width: 1100px;
	margin: 20px auto;
}

.detalle-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 30px;
	padding-bottom: 15px;
	border-bottom: 3px solid #667eea;
}

.detalle-header h2 {
	color: #333;
	font-size: 28px;
}

.btn-volver {
	background-color: #6c757d;
	color: white;
	padding: 10px 20px;
	border-radius: 6px;
	transition: all 0.3s;
}

.btn-volver:hover {
	background-color: #5a6268;
	transform: translateY(-2px);
}

.detalle-grid {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 25px;
	margin-bottom: 30px;
}

.detalle-card {
	background: white;
	padding: 25px;
	border-radius: 10px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.detalle-card h3 {
	color: #333;
	margin-bottom: 20px;
	font-size: 20px;
	padding-bottom: 10px;
	border-bottom: 2px solid #f0f0f0;
}

.info-list {
	display: flex;
	flex-direction: column;
	gap: 15px;
}

.info-item {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 10px 0;
	border-bottom: 1px solid #f5f5f5;
}

.info-item .label {
	color: #666;
	font-weight: bold;
}

.info-item .value {
	color: #333;
	font-weight: 500;
}

.precio-destacado {
	color: #4CAF50 !important;
	font-size: 24px !important;
	font-weight: bold !important;
}

.estado-badge {
	display: inline-block;
	padding: 6px 12px;
	border-radius: 20px;
	font-size: 14px;
	font-weight: bold;
}

.estado-confirm { background-color: #d4edda; color: #155724; }
.estado-preparation { background-color: #fff3cd; color: #856404; }
.estado-shipped { background-color: #d1ecf1; color: #0c5460; }
.estado-delivered { background-color: #d4edda; color: #155724; }

.direccion-box {
	background: #f8f9fa;
	padding: 20px;
	border-radius: 8px;
	border-left: 4px solid #667eea;
}

.direccion-box p {
	margin: 8px 0;
	color: #555;
	font-size: 15px;
}

.productos-detalle {
	background: white;
	padding: 25px;
	border-radius: 10px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	margin-bottom: 30px;
}

.productos-detalle h3 {
	color: #333;
	margin-bottom: 20px;
	font-size: 20px;
}

.tabla-detalle {
	width: 100%;
	border-collapse: collapse;
}

.tabla-detalle thead {
	background-color: #333;
	color: white;
}

.tabla-detalle th {
	padding: 12px;
	text-align: left;
	font-size: 14px;
	font-weight: bold;
}

.tabla-detalle td {
	padding: 15px 12px;
	border-bottom: 1px solid #eee;
}

.producto-info {
	display: flex;
	align-items: center;
	gap: 12px;
}

.img-mini {
	width: 60px;
	height: 60px;
	object-fit: cover;
	border-radius: 6px;
}

.nombre {
	font-weight: 500;
	color: #333;
}

.precio, .cantidad {
	color: #666;
}

.subtotal {
	color: #4CAF50;
	font-weight: bold;
}

.tabla-detalle tfoot {
	background-color: #f8f9fa;
}

.text-right {
	text-align: right !important;
}

.total-final {
	color: #4CAF50;
	font-size: 20px;
}

.timeline-container {
	background: white;
	padding: 30px;
	border-radius: 10px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	margin-bottom: 30px;
}

.timeline-container h3 {
	color: #333;
	margin-bottom: 30px;
	font-size: 20px;
}

.timeline {
	display: grid;
	grid-template-columns: repeat(4, 1fr);
	gap: 20px;
	position: relative;
}

.timeline::before {
	content: '';
	position: absolute;
	top: 25px;
	left: 10%;
	right: 10%;
	height: 3px;
	background: #e0e0e0;
	z-index: 0;
}

.timeline-item {
	text-align: center;
	position: relative;
	z-index: 1;
}

.timeline-marker {
	width: 50px;
	height: 50px;
	background: #e0e0e0;
	border-radius: 50%;
	margin: 0 auto 15px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 24px;
	transition: all 0.3s;
}

.timeline-item.completed .timeline-marker {
	box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
	transform: scale(1.1);
}

.timeline-content h4 {
	color: #333;
	font-size: 16px;
	margin-bottom: 5px;
}

.timeline-content p {
	color: #999;
	font-size: 13px;
}

.timeline-item.completed .timeline-content h4 {
	color: #667eea;
	font-weight: bold;
}

.timeline-item.completed .timeline-content p {
	color: #666;
}

.detalle-acciones {
	display: flex;
	gap: 15px;
	justify-content: center;
}

.detalle-acciones .boton {
	padding: 14px 30px;
	border-radius: 8px;
	font-weight: bold;
	font-size: 16px;
	transition: all 0.3s;
}

.btn-secondary {
	background-color: #6c757d;
	color: white;
}

.btn-secondary:hover {
	background-color: #5a6268;
	transform: translateY(-2px);
	box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
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

.error-mensaje {
	text-align: center;
	padding: 60px 20px;
	background: #f8f9fa;
	border-radius: 10px;
	margin: 20px 0;
}

.error-mensaje p {
	font-size: 18px;
	color: #d32f2f;
	margin-bottom: 20px;
}

@media (max-width: 1024px) {
	.detalle-grid {
		grid-template-columns: 1fr;
	}
	
	.timeline {
		grid-template-columns: repeat(2, 1fr);
	}
}

@media (max-width: 768px) {
	.detalle-header {
		flex-direction: column;
		gap: 15px;
		text-align: center;
	}
	
	.detalle-header h2 {
		font-size: 22px;
	}
	
	.tabla-detalle {
		font-size: 12px;
	}
	
	.img-mini {
		width: 40px;
		height: 40px;
	}
	
	.timeline {
		grid-template-columns: 1fr;
	}
	
	.timeline::before {
		display: none;
	}
	
	.detalle-acciones {
		flex-direction: column;
	}
	
	.detalle-acciones .boton {
		width: 100%;
	}
}
</style>
