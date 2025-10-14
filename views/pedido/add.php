<main>
	<div class="principal">
		<h2>💳 Realizar Pedido</h2>

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

						<div class="form-info">
							<p>ℹ️ <strong>Nota:</strong> Todos los campos son obligatorios.</p>
							<p>📦 El pedido será procesado y enviado en un plazo de 3-5 días hábiles.</p>
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

<style>
/* Estilos para el pedido */
.pedido-container {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 30px;
	margin: 20px 0;
}

.pedido-resumen, .pedido-formulario {
	background: white;
	padding: 25px;
	border-radius: 8px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.pedido-resumen h3, .pedido-formulario h3 {
	margin-bottom: 20px;
	padding-bottom: 10px;
	border-bottom: 2px solid #4CAF50;
	color: #333;
}

.tabla-pedido {
	width: 100%;
	border-collapse: collapse;
}

.tabla-pedido th {
	background-color: #f5f5f5;
	padding: 12px;
	text-align: left;
	font-size: 14px;
	font-weight: bold;
	border-bottom: 2px solid #ddd;
}

.tabla-pedido td {
	padding: 12px;
	border-bottom: 1px solid #eee;
}

.producto-info {
	display: flex;
	align-items: center;
	gap: 10px;
}

.img-pedido {
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

.precio-total {
	color: #4CAF50;
	font-size: 20px;
}

/* Formulario */
.form-pedido {
	display: flex;
	flex-direction: column;
	gap: 20px;
}

.form-group {
	display: flex;
	flex-direction: column;
}

.form-group label {
	display: flex;
	align-items: center;
	gap: 8px;
	margin-bottom: 8px;
	font-weight: bold;
	color: #333;
	font-size: 14px;
}

.label-icon {
	font-size: 18px;
}

.form-input {
	padding: 12px 15px;
	border: 2px solid #ddd;
	border-radius: 6px;
	font-size: 14px;
	transition: all 0.3s;
}

.form-input:focus {
	outline: none;
	border-color: #4CAF50;
	box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
}

.form-info {
	background-color: #e3f2fd;
	padding: 15px;
	border-radius: 6px;
	border-left: 4px solid #2196F3;
}

.form-info p {
	margin: 5px 0;
	font-size: 13px;
	color: #555;
}

.form-botones {
	display: flex;
	gap: 15px;
	justify-content: space-between;
	margin-top: 10px;
}

.form-botones .boton {
	flex: 1;
	text-align: center;
	padding: 14px 20px;
	font-size: 16px;
	font-weight: bold;
	border: none;
	cursor: pointer;
	transition: all 0.3s;
}

.btn-secondary {
	background-color: #6c757d;
	color: white;
}

.btn-secondary:hover {
	background-color: #5a6268;
}

.btn-success {
	background-color: #28a745;
	color: white;
}

.btn-success:hover {
	background-color: #218838;
	transform: translateY(-2px);
	box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
}

.alert {
	padding: 12px 15px;
	border-radius: 6px;
	margin-bottom: 20px;
}

.alert-danger {
	background-color: #f8d7da;
	color: #721c24;
	border: 1px solid #f5c6cb;
}

.carrito-vacio {
	text-align: center;
	padding: 60px 20px;
	background: #f9f9f9;
	border-radius: 8px;
	margin: 20px 0;
}

.carrito-vacio p {
	font-size: 18px;
	color: #666;
	margin-bottom: 15px;
}

/* Responsive */
@media (max-width: 1024px) {
	.pedido-container {
		grid-template-columns: 1fr;
	}
}

@media (max-width: 768px) {
	.tabla-pedido {
		font-size: 12px;
	}
	
	.img-pedido {
		width: 40px;
		height: 40px;
	}
	
	.form-botones {
		flex-direction: column;
	}
	
	.form-botones .boton {
		width: 100%;
	}
}
</style>
