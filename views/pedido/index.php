<main>
	<div class="principal">
		<h2>📦 Mis Pedidos</h2>

		<?php if(isset($pedidos) && $pedidos->num_rows > 0) : ?>
			<div class="pedidos-lista">
				<?php while($pedido = $pedidos->fetch_object()) : ?>
					<div class="pedido-card">
						<div class="pedido-header">
							<div class="pedido-numero">
								<span class="label">Pedido</span>
								<span class="numero">#<?= str_pad($pedido->id, 6, '0', STR_PAD_LEFT) ?></span>
							</div>
							<div class="pedido-fecha">
								<span class="fecha">📅 <?= date('d/m/Y', strtotime($pedido->fecha)) ?></span>
								<span class="hora">🕐 <?= $pedido->hora ?></span>
							</div>
						</div>

						<div class="pedido-body">
							<div class="info-row">
								<div class="info-col">
									<span class="icon">📍</span>
									<div class="info-content">
										<strong>Dirección de Envío</strong>
										<p><?= $pedido->direccion ?></p>
										<p><?= $pedido->localidad ?>, <?= $pedido->provincia ?></p>
									</div>
								</div>
								<div class="info-col">
									<span class="icon">💰</span>
									<div class="info-content">
										<strong>Total</strong>
										<p class="precio-grande"><?= number_format($pedido->coste, 2) ?> $</p>
									</div>
								</div>
							</div>

							<div class="pedido-estado">
								<span class="estado-label">Estado:</span>
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
							</div>
						</div>

						<div class="pedido-footer">
							<a href="<?=base_url?>pedido/detalle&id=<?= $pedido->id ?>" class="boton btn-ver-detalle">
								👁️ Ver Detalle
							</a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

		<?php else : ?>
			<div class="sin-pedidos">
				<div class="icon">📦</div>
				<h3>No tienes pedidos realizados</h3>
				<p>Cuando realices tu primera compra, aparecerá aquí</p>
				<a href="<?=base_url?>producto/index" class="boton btn-comprar">
					🛍️ Comenzar a Comprar
				</a>
			</div>
		<?php endif; ?>
	</div>
</main>

<style>
.pedidos-lista {
	display: grid;
	gap: 20px;
	margin: 20px 0;
}

.pedido-card {
	background: white;
	border-radius: 10px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	overflow: hidden;
	transition: all 0.3s;
}

.pedido-card:hover {
	box-shadow: 0 4px 16px rgba(0,0,0,0.15);
	transform: translateY(-2px);
}

.pedido-header {
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	color: white;
	padding: 20px;
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.pedido-numero {
	display: flex;
	flex-direction: column;
}

.pedido-numero .label {
	font-size: 12px;
	opacity: 0.9;
}

.pedido-numero .numero {
	font-size: 24px;
	font-weight: bold;
}

.pedido-fecha {
	display: flex;
	flex-direction: column;
	align-items: flex-end;
	gap: 5px;
	font-size: 14px;
}

.pedido-body {
	padding: 25px;
}

.info-row {
	display: grid;
	grid-template-columns: 2fr 1fr;
	gap: 30px;
	margin-bottom: 20px;
	padding-bottom: 20px;
	border-bottom: 1px solid #eee;
}

.info-col {
	display: flex;
	gap: 15px;
	align-items: flex-start;
}

.info-col .icon {
	font-size: 28px;
	line-height: 1;
}

.info-content strong {
	display: block;
	color: #333;
	margin-bottom: 5px;
	font-size: 14px;
}

.info-content p {
	margin: 3px 0;
	color: #666;
	font-size: 14px;
}

.precio-grande {
	font-size: 28px !important;
	font-weight: bold !important;
	color: #4CAF50 !important;
}

.pedido-estado {
	display: flex;
	align-items: center;
	gap: 10px;
}

.estado-label {
	font-weight: bold;
	color: #666;
}

.estado-badge {
	display: inline-block;
	padding: 8px 16px;
	border-radius: 20px;
	font-size: 14px;
	font-weight: bold;
}

.estado-confirm {
	background-color: #d4edda;
	color: #155724;
}

.estado-preparation {
	background-color: #fff3cd;
	color: #856404;
}

.estado-shipped {
	background-color: #d1ecf1;
	color: #0c5460;
}

.estado-delivered {
	background-color: #d4edda;
	color: #155724;
}

.pedido-footer {
	padding: 15px 25px;
	background: #f8f9fa;
	text-align: right;
}

.btn-ver-detalle {
	background-color: #667eea;
	color: white;
	padding: 10px 20px;
	border-radius: 6px;
	display: inline-block;
	font-weight: bold;
	transition: all 0.3s;
}

.btn-ver-detalle:hover {
	background-color: #5568d3;
	transform: translateY(-2px);
	box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
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
	margin-bottom: 30px;
	font-size: 16px;
}

.btn-comprar {
	background-color: #4CAF50;
	color: white;
	padding: 14px 30px;
	border-radius: 8px;
	display: inline-block;
	font-weight: bold;
	font-size: 16px;
	transition: all 0.3s;
}

.btn-comprar:hover {
	background-color: #45a049;
	transform: translateY(-2px);
	box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
}

@media (max-width: 768px) {
	.pedido-header {
		flex-direction: column;
		gap: 15px;
		text-align: center;
	}
	
	.pedido-fecha {
		align-items: center;
	}
	
	.info-row {
		grid-template-columns: 1fr;
		gap: 20px;
	}
	
	.pedido-footer {
		text-align: center;
	}
	
	.btn-ver-detalle {
		display: block;
		width: 100%;
	}
}
</style>
