			<div  class="acciones block">
				<a href="<?=base_url?>carrito/index" class="boton_a">🛒 Ver Carrito <?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) echo '('.count($_SESSION['carrito']).')'; ?></a>
				<a href="<?=base_url?>pedido/index" class="boton_a">📦 Mis pedidos</a>
				<?php if(isset($_SESSION['admin'])) : ?>					<!-- mostrar solamente cuando el user sea admin-->
					<a href="<?=base_url?>categoria/index" class="boton_a">📁 Gestionar categorias</a>	<!-- //el link te manda al controller y al metodo index -->
					<a href="<?=base_url?>Producto/gestion" class="boton_a">📦 Gestionar productos</a>
					<a href="<?=base_url?>pedido/gestion" class="boton_a">📋 Gestionar pedidos</a>
				<?php endif; ?>
				<a href="<?=base_url?>Usuario/logout" class="boton_a">🚪 Cerrar sesión</a>	
			</div>
