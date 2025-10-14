<?php
require_once 'models/pedido.php';
require_once 'models/productoM.php';

class PedidoController
{

	public function index()
	{
		// Mostrar lista de pedidos del usuario
		if (isset($_SESSION['identify'])) {
			$usuario_id = $_SESSION['identify']->id;

			$pedido = new Pedido();
			$pedidos = $pedido->getByUser($usuario_id);

			require_once 'views/layout/header.php';
			require_once 'views/layout/menu.php';
			require_once 'views/layout/aside.php';
			require_once 'views/pedido/index.php';
			require_once 'views/layout/footer.php';
		} else {
			header("Location:".base_url);
		}
	}


	public function add()
	{
		if (isset($_SESSION['identify'])) {
			$usuario_id = $_SESSION['identify']->id;

			// Calcular total del carrito
			$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
			$total = 0;
			foreach ($carrito as $item) {
				$total += $item['precio'] * $item['unidades'];
			}

			require_once 'views/layout/header.php';
			require_once 'views/layout/menu.php';
			require_once 'views/layout/aside.php';
			require_once 'views/pedido/add.php';
			require_once 'views/layout/footer.php';
		} else {
			header("Location:".base_url);
		}
	}


	public function save()
	{
		if (isset($_SESSION['identify'])) {
			$usuario_id = $_SESSION['identify']->id;

			// Validar datos del formulario
			if (isset($_POST)) {
				$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
				$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
				$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

				if ($provincia && $localidad && $direccion) {
					// Calcular total del carrito
					$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
					$coste = 0;
					foreach ($carrito as $item) {
						$coste += $item['precio'] * $item['unidades'];
					}

					// Crear objeto pedido
					$pedido = new Pedido();
					$pedido->setUsuario_id($usuario_id);
					$pedido->setProvincia($provincia);
					$pedido->setLocalidad($localidad);
					$pedido->setDireccion($direccion);
					$pedido->setCoste($coste);
					$pedido->setEstado('confirm');

					// Guardar pedido en la base de datos
					$save = $pedido->save();

					if ($save) {
						$pedido_id = $pedido->getLastId();

						// Guardar líneas del pedido
						foreach ($carrito as $item) {
							$save_linea = $pedido->saveLinea($pedido_id, $item['id'], $item['unidades']);
						}

						// Limpiar carrito
						unset($_SESSION['carrito']);

						$_SESSION['pedido'] = 'completed';
						header("Location:".base_url."pedido/confirmado&id={$pedido_id}");
					} else {
						$_SESSION['pedido'] = 'failed';
						header("Location:".base_url."carrito/index");
					}
				} else {
					$_SESSION['pedido'] = 'failed';
					header("Location:".base_url."carrito/index");
				}
			}
		} else {
			header("Location:".base_url);
		}
	}


	public function confirmado()
	{
		if (isset($_SESSION['identify']) && isset($_GET['id'])) {
			$pedido_id = $_GET['id'];

			// Obtener datos del pedido
			$pedidoObj = new Pedido();
			$pedidoObj->setId($pedido_id);
			$pedido = $pedidoObj->getOne();

			// Obtener líneas del pedido
			$lineas = $pedidoObj->getLineasPedido($pedido_id);

			require_once 'views/layout/header.php';
			require_once 'views/layout/menu.php';
			require_once 'views/layout/aside.php';
			require_once 'views/pedido/confirmado.php';
			require_once 'views/layout/footer.php';
		} else {
			header("Location:".base_url);
		}
	}


	public function detalle()
	{
		if (isset($_SESSION['identify']) && isset($_GET['id'])) {
			$pedido_id = $_GET['id'];

			// Obtener datos del pedido
			$pedidoObj = new Pedido();
			$pedidoObj->setId($pedido_id);
			$pedido = $pedidoObj->getOne();

			// Verificar que el pedido pertenece al usuario (excepto admin)
			if ($pedido->usuario_id == $_SESSION['identify']->id || isset($_SESSION['admin'])) {
				// Obtener líneas del pedido
				$lineas = $pedidoObj->getLineasPedido($pedido_id);

				require_once 'views/layout/header.php';
				require_once 'views/layout/menu.php';
				require_once 'views/layout/aside.php';
				require_once 'views/pedido/detalle.php';
				require_once 'views/layout/footer.php';
			} else {
				header("Location:".base_url);
			}
		} else {
			header("Location:".base_url);
		}
	}


	public function gestion()
	{
		// Solo admin puede acceder
		Utils::isAdmin();

		$pedido = new Pedido();
		$pedidos = $pedido->getAll();

		require_once 'views/layout/header.php';
		require_once 'views/layout/menu.php';
		require_once 'views/layout/aside.php';
		require_once 'views/pedido/gestion.php';
		require_once 'views/layout/footer.php';
	}


	public function estado()
	{
		// Solo admin puede acceder
		Utils::isAdmin();

		if (isset($_GET['id']) && isset($_GET['estado'])) {
			$pedido_id = $_GET['id'];
			$estado = $_GET['estado'];

			$pedido = new Pedido();
			$update = $pedido->updateEstado($pedido_id, $estado);

			if ($update) {
				$_SESSION['pedido_estado'] = 'completed';
			} else {
				$_SESSION['pedido_estado'] = 'failed';
			}
		}

		header("Location:".base_url."pedido/gestion");
	}
}

?>
