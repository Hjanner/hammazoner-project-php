<main>		
	<div class="principal">
		<?php if(isset($categoria) && is_object($categoria)) :?>

			<h2><?= $categoria->nombre ?></h2>

			<div>
				<?php if(isset($productos) && $productos->num_rows > 0) : ?>  <!-- verificando que existan productos enla categoria -->

					<?php while($producto = $productos->fetch_object()) : ?>		<!-- recorriendo el objeto productos -->
						<article>
							<a href="<?=base_url?>/producto/ver&id=<?=$producto->id?>" class="a_producto">	 <!-- enlace apunta al PRODcontroller -->
								<img src="<?=base_url?>/uploads/images/<?=$producto->imagen?>" alt="">
								<h3> <?= $producto->nombre ?> </h3>
							</a>
							<p class="precio"><?= $producto->precio ?> $</p>
							<a href="<?=base_url?>/carrito/add&id=<?=$producto->id?>" class="boton comprar">Comprar</a>
						</article>
					<?php endwhile; ?>

				<?php else : ?>
					<h3 style="color: red; margin: 0 auto;">No existen prductos registrado en esta categoria</h3>
				<?php endif; ?>

			<?php else: ?>
				<h2>La categoria no existe</h2>
			<?php endif; ?>
		</div>
	</div>
</main>