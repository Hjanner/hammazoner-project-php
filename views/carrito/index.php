<main>
	<div class="principal">
		<h2>Carrito de Compras</h2>

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
