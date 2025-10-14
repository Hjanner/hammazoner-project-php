<?php
require_once 'models/productoM.php';

class CarritoController
{

	public function index()
	{
		$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
		$total = 0;
		foreach ($carrito as $item) {
			$total += $item['precio'] * $item['unidades'];
		}
		require_once 'views/layout/header.php';
		require_once 'views/layout/menu.php';
		require_once 'views/layout/aside.php';
		require_once 'views/carrito/index.php';
		require_once 'views/layout/footer.php';
	}


	public function add()
	{
		if (isset($_GET['id'])) {
			$producto_id = $_GET['id'];

			// Obtener producto de la base de datos
			$producto = new Producto();
			$producto->setId($producto_id);
			$prod = $producto->getOne();

			if ($prod) {
				// Inicializar carrito si no existe
				if (!isset($_SESSION['carrito'])) {
					$_SESSION['carrito'] = array();
				}

				// Verificar si el producto ya está en el carrito
				if (isset($_SESSION['carrito'][$producto_id])) {
					$_SESSION['carrito'][$producto_id]['unidades']++;
				} else {
					$_SESSION['carrito'][$producto_id] = array(
						'id' => $prod->id,
						'nombre' => $prod->nombre,
						'precio' => $prod->precio,
						'imagen' => $prod->imagen,
						'unidades' => 1
					);
				}

				$_SESSION['carrito_add'] = 'completed';
			}
		}

		header("Location:".base_url."carrito/index");
	}


	public function remove()
	{
		if (isset($_GET['id'])) {
			$producto_id = $_GET['id'];

			if (isset($_SESSION['carrito'][$producto_id])) {
				if ($_SESSION['carrito'][$producto_id]['unidades'] > 1) {
					$_SESSION['carrito'][$producto_id]['unidades']--;
				} else {
					unset($_SESSION['carrito'][$producto_id]);
				}
			}
		}

		header("Location:".base_url."carrito/index");
	}


	public function increase()
	{
		if (isset($_GET['id'])) {
			$producto_id = $_GET['id'];

			if (isset($_SESSION['carrito'][$producto_id])) {
				$_SESSION['carrito'][$producto_id]['unidades']++;
			}
		}

		header("Location:".base_url."carrito/index");
	}


	public function delete()
	{
		unset($_SESSION['carrito']);
		$_SESSION['carrito_delete'] = 'completed';
		header("Location:".base_url."carrito/index");
	}


	public function deleteItem()
	{
		if (isset($_GET['id'])) {
			$producto_id = $_GET['id'];

			if (isset($_SESSION['carrito'][$producto_id])) {
				unset($_SESSION['carrito'][$producto_id]);
			}
		}

		header("Location:".base_url."carrito/index");
	}
}

?>
