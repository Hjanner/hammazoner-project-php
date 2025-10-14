<main>		
	<div class="principal">
		<h2>Destacados</h2>

		<div>
			<?php while($producto = $productos->fetch_object()) : ?>
				<article>
					<a href="<?=base_url?>/producto/ver&id=<?=$producto->id?>" class="a_producto">	 <!-- enlace apunta al PRODcontroller -->
						<img src="<?=base_url?>/uploads/images/<?=$producto->imagen?>" alt="">
						<h3> <?= $producto->nombre ?> </h3>
					</a>
					<p class="precio"><?= $producto->precio ?> $</p>
					<a href="<?=base_url?>/carrito/add&id=<?=$producto->id?>" class="boton comprar">Comprar</a>
				</article>
			<?php endwhile; ?>
		</div>

	</div>
</main>

<!-- 
 -->