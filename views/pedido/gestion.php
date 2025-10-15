<main>
	<div class="principal">
		<h2>Gestión de Pedidos</h2>

		<?php if(isset($_SESSION['pedido_estado']) && $_SESSION['pedido_estado'] == 'completed') : ?>
			<div class="alert alert-success">
				✅ Estado del pedido actualizado correctamente
			</div>
			<?php Utils::deleteSession('pedido_estado'); ?>
		<?php elseif(isset($_SESSION['pedido_estado']) && $_SESSION['pedido_estado'] == 'failed') : ?>
			<div class="alert alert-danger">
				❌ Error al actualizar el estado del pedido
			</div>
			<?php Utils::deleteSession('pedido_estado'); ?>
		<?php endif; ?>

		<?php if(isset($pedidos) && $pedidos->num_rows > 0) : ?>
			<div class="tabla-responsive">
				<table class="tabla-gestion">
					<thead>
						<tr>
							<th>ID</th>
							<th>Cliente</th>
							<th>Dirección</th>
							<th>Total</th>
							<th>Estado</th>
							<th>Fecha</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php while($pedido = $pedidos->fetch_object()) : ?>
							<tr>
								<td><strong>#<?= str_pad($pedido->id, 6, '0', STR_PAD_LEFT) ?></strong></td>
								<td>
									<div class="cliente-info">
										<strong><?= $pedido->nombre . ' ' . $pedido->apellidos ?></strong>
									</div>
								</td>
								<td>
									<div class="direccion-info">
										<?= $pedido->direccion ?><br>
										<small><?= $pedido->localidad ?>, <?= $pedido->provincia ?></small>
									</div>
								</td>
								<td class="precio-col"><strong><?= number_format($pedido->coste, 2) ?> $</strong></td>
								<td>
									<select class="estado-select estado-<?= $pedido->estado ?>" 
									        onchange="cambiarEstado(<?= $pedido->id ?>, this.value)">
										<option value="confirm" <?= $pedido->estado == 'confirm' ? 'selected' : '' ?>>✅ Confirmado</option>
										<option value="preparation" <?= $pedido->estado == 'preparation' ? 'selected' : '' ?>>📦 En Preparación</option>
										<option value="shipped" <?= $pedido->estado == 'shipped' ? 'selected' : '' ?>>🚚 Enviado</option>
										<option value="delivered" <?= $pedido->estado == 'delivered' ? 'selected' : '' ?>>✅ Entregado</option>
									</select>
								</td>
								<td>
									<?= date('d/m/Y', strtotime($pedido->fecha)) ?><br>
									<small><?= $pedido->hora ?></small>
								</td>
								<td>
									<div class="acciones">
										<a href="<?=base_url?>pedido/detalle&id=<?= $pedido->id ?>" 
										   class="boton-mini btn-ver" 
										   title="Ver detalle">
											👁️
										</a>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>

		<?php else : ?>
			<div class="sin-pedidos">
				<div class="icon">📦</div>
				<h3>No hay pedidos registrados</h3>
				<p>Los pedidos aparecerán aquí cuando los clientes realicen compras</p>
			</div>
		<?php endif; ?>
	</div>
</main>

<script>
function cambiarEstado(pedidoId, nuevoEstado) {
	if(confirm('¿Estás seguro de cambiar el estado del pedido?')) {
		window.location.href = '<?=base_url?>pedido/estado&id=' + pedidoId + '&estado=' + nuevoEstado;
	} else {
		location.reload();
	}
}
</script>

<style>
.alert {
	padding: 15px 20px;
	border-radius: 8px;
	margin-bottom: 20px;
	font-weight: bold;
}

.alert-success {
	background-color: #d4edda;
	color: #155724;
	border: 1px solid #c3e6cb;
}

.alert-danger {
	background-color: #f8d7da;
	color: #721c24;
	border: 1px solid #f5c6cb;
}

.tabla-responsive {
	overflow-x: auto;
	background: white;
	border-radius: 10px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	margin: 20px 0;
}

.tabla-gestion {
	width: 100%;
	border-collapse: collapse;
	min-width: 900px;
}

.tabla-gestion thead {
	color: black;
}

.tabla-gestion th {
	padding: 15px 12px;
	text-align: left;
	font-size: 14px;
	font-weight: bold;
	text-transform: uppercase;
}

.tabla-gestion td {
	padding: 15px 12px;
	border-bottom: 1px solid #eee;
}

.tabla-gestion tbody tr:hover {
	background-color: #f8f9fa;
}

.cliente-info strong {
	color: #333;
	font-size: 15px;
}

.direccion-info {
	color: #555;
	font-size: 14px;
}

.direccion-info small {
	color: #999;
	font-size: 12px;
}

.precio-col {
	color: #4CAF50;
	font-size: 16px;
}

.estado-select {
	padding: 8px 12px;
	border: 2px solid #ddd;
	border-radius: 6px;
	font-size: 14px;
	font-weight: bold;
	cursor: pointer;
	transition: all 0.3s;
	width: 100%;
	max-width: 180px;
}

.estado-select:focus {
	outline: none;
	border-color: #667eea;
}

.estado-confirm {
	background-color: #d4edda;
	color: #155724;
	border-color: #c3e6cb;
}

.estado-preparation {
	background-color: #fff3cd;
	color: #856404;
	border-color: #ffeaa7;
}

.estado-shipped {
	background-color: #d1ecf1;
	color: #0c5460;
	border-color: #bee5eb;
}

.estado-delivered {
	background-color: #d4edda;
	color: #155724;
	border-color: #c3e6cb;
}

.acciones {
	display: flex;
	gap: 8px;
	justify-content: center;
}

.boton-mini {
	display: inline-block;
	padding: 8px 12px;
	border-radius: 6px;
	text-decoration: none;
	font-size: 16px;
	transition: all 0.3s;
	border: none;
	cursor: pointer;
}

.btn-ver {
	background-color: #2196F3;
	color: white;
}

.btn-ver:hover {
	background-color: #1976D2;
	transform: scale(1.1);
}

.sin-pedidos {
	text-align: center;
	padding: 80px 20px;
	background: #f8f9fa;
	border-radius: 10px;
	margin: 20px 0;
}

.sin-pedidos .icon {
	font-size: 80px;
	margin-bottom: 20px;
	opacity: 0.5;
}

.sin-pedidos h3 {
	color: #333;
	margin-bottom: 10px;
	font-size: 24px;
}

.sin-pedidos p {
	color: #666;
	font-size: 16px;
}

@media (max-width: 768px) {
	.tabla-gestion {
		font-size: 12px;
	}
	
	.tabla-gestion th,
	.tabla-gestion td {
		padding: 10px 8px;
	}
	
	.estado-select {
		font-size: 12px;
		padding: 6px 8px;
	}
}
</style>
