<main>		
	<div class="principal">
		<?php if(isset($producto) && is_object($producto)) :?>

<!-- 			<h2><?= $producto->nombre ?></h2>
 -->
			<div>
				<article class="producto_ver">
					<img src="<?=base_url?>/uploads/images/<?=$producto->imagen?>" class="producto_ver_img">
					<div class="producto_ver_info">
						<h3> <?= $producto->nombre ?> </h3>
						<p> <?= $producto->descripcion ?> </p>
						<p class="precio"><?= $producto->precio ?> $</p>
						<a href="<?=base_url?>/carrito/add&id=<?=$producto->id?>" class="boton comprar">Comprar</a>
					</div>
				</article>

		<?php else : ?>
				<h3 style="color: red; margin: 0 auto;">El producto buscado no existe</h3>
			</div>
		<?php endif; ?>

	</div>
</main>