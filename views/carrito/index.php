<main>
	<div class="principal">
		<h2>🛒 Carrito de Compras</h2>

		<?php if(isset($carrito) && count($carrito) > 0) : ?>
			<table class="tabla-carrito">
				<thead>
					<tr>
						<th>Imagen</th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Unidades</th>
						<th>Subtotal</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($carrito as $item) : ?>
						<tr>
							<td>
								<img src="<?=base_url?>uploads/images/<?=$item['imagen']?>" 
								     alt="<?=$item['nombre']?>" 
								     class="img-carrito">
							</td>
							<td><strong><?=$item['nombre']?></strong></td>
							<td><?=number_format($item['precio'], 2)?> $</td>
							<td>
								<div class="cantidad-control">
									<a href="<?=base_url?>carrito/remove&id=<?=$item['id']?>" 
									   class="btn-cantidad btn-minus" 
									   title="Disminuir cantidad">-</a>
									<span class="cantidad"><?=$item['unidades']?></span>
									<a href="<?=base_url?>carrito/increase&id=<?=$item['id']?>" 
									   class="btn-cantidad btn-plus" 
									   title="Aumentar cantidad">+</a>
								</div>
							</td>
							<td class="subtotal"><strong><?=number_format($item['precio'] * $item['unidades'], 2)?> $</strong></td>
							<td>
								<a href="<?=base_url?>carrito/remove&id=<?=$item['id']?>" 
								   class="boton btn-small btn-warning" 
								   title="Eliminar una unidad">
									🗑️ Quitar
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<div class="carrito-resumen">
				<div class="total-container">
					<h3>Total a Pagar: <span class="precio-total"><?=number_format($total, 2)?> $</span></h3>
				</div>
				<div class="botones-carrito">
					<a href="<?=base_url?>producto/index" class="boton btn-secondary">← Seguir Comprando</a>
					<a href="<?=base_url?>carrito/delete" 
					   class="boton btn-danger" 
					   onclick="return confirm('¿Estás seguro de vaciar el carrito?')">
						🗑️ Vaciar Carrito
					</a>
					<a href="<?=base_url?>pedido/add" class="boton btn-success">
						💳 Proceder al Pago →
					</a>
				</div>
			</div>

		<?php else : ?>
			<div class="carrito-vacio">
				<p>😕 Tu carrito está vacío</p>
				<a href="<?=base_url?>producto/index" class="boton">Ver Productos</a>
			</div>
		<?php endif; ?>

	</div>
</main>

<style>
/* Estilos para el carrito */
.tabla-carrito {
	width: 100%;
	border-collapse: collapse;
	margin: 20px 0;
	background: white;
	box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.tabla-carrito thead {
	background-color: #333;
	color: white;
}

.tabla-carrito th, .tabla-carrito td {
	padding: 12px;
	text-align: center;
	border-bottom: 1px solid #ddd;
}

.tabla-carrito th {
	font-weight: bold;
	text-transform: uppercase;
	font-size: 14px;
}

.img-carrito {
	width: 80px;
	height: 80px;
	object-fit: cover;
	border-radius: 4px;
}

.cantidad-control {
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 10px;
}

.btn-cantidad {
	display: inline-block;
	width: 30px;
	height: 30px;
	line-height: 28px;
	text-align: center;
	background: #4CAF50;
	color: white;
	text-decoration: none;
	border-radius: 50%;
	font-weight: bold;
	transition: all 0.3s;
}

.btn-cantidad:hover {
	transform: scale(1.1);
	box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.btn-minus {
	background: #f44336;
}

.cantidad {
	font-weight: bold;
	font-size: 16px;
	min-width: 30px;
	display: inline-block;
}

.subtotal {
	color: #4CAF50;
	font-size: 16px;
}

.carrito-resumen {
	margin-top: 30px;
	padding: 20px;
	background: #f5f5f5;
	border-radius: 8px;
}

.total-container {
	text-align: right;
	margin-bottom: 20px;
}

.total-container h3 {
	font-size: 24px;
	color: #333;
}

.precio-total {
	color: #4CAF50;
	font-weight: bold;
}

.botones-carrito {
	display: flex;
	gap: 15px;
	justify-content: flex-end;
	flex-wrap: wrap;
}

.btn-small {
	padding: 5px 10px;
	font-size: 12px;
}

.btn-secondary {
	background-color: #6c757d;
}

.btn-danger {
	background-color: #dc3545;
}

.btn-success {
	background-color: #28a745;
}

.btn-warning {
	background-color: #ffc107;
	color: #333;
}

.carrito-vacio {
	text-align: center;
	padding: 60px 20px;
	background: #f9f9f9;
	border-radius: 8px;
	margin: 20px 0;
}

.carrito-vacio p {
	font-size: 20px;
	color: #666;
	margin-bottom: 20px;
}

@media (max-width: 768px) {
	.tabla-carrito {
		font-size: 12px;
	}
	
	.img-carrito {
		width: 50px;
		height: 50px;
	}
	
	.botones-carrito {
		flex-direction: column;
	}
	
	.botones-carrito .boton {
		width: 100%;
	}
}
</style>
