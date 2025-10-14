	<nav>
			<ul>
				<li><a href="<?=base_url?>producto/index">Inicio</a></li>

				<?php
				$categorias = Utils::showCategorias();

				if(isset($categorias)) :
					while($categoria = $categorias->fetch_object()) : ?>

					<li><a href="<?=base_url?>/categoria/verCategoria&id=<?=$categoria->id?>"><?=$categoria->nombre;?></a></li>

					<?php endwhile; ?>
				<?php endif; ?>

				<li><a href="<?=base_url?>carrito/index">Carrito</a></li>
				<li><a href="<?=base_url?>pagina/about">Sobre Nosotros</a></li>
				<li><a href="<?=base_url?>pagina/contact">Contactanos</a></li>
			</ul>
		</nav>
	</header>