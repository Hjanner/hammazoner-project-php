<?php 

class Pedido
{
	private $id;
	private $usuario_id;
	private $provincia;
	private $localidad;
	private $direccion;
	private $coste;
	private $estado;
	private $fecha;
	private $hora;
	private $db;

	public function __construct()
	{
		$this->db = Database::connect();
	}

	// Getters y Setters
	public function getId()
	{
	    return $this->id;
	}
	
	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getUsuario_id()
	{
	    return $this->usuario_id;
	}
	
	public function setUsuario_id($usuario_id)
	{
	    $this->usuario_id = $usuario_id;
	}

	public function getProvincia()
	{
	    return $this->provincia;
	}
	
	public function setProvincia($provincia)
	{
	    $this->provincia = $this->db->real_escape_string($provincia);
	}

	public function getLocalidad()
	{
	    return $this->localidad;
	}
	
	public function setLocalidad($localidad)
	{
	    $this->localidad = $this->db->real_escape_string($localidad);
	}

	public function getDireccion()
	{
	    return $this->direccion;
	}
	
	public function setDireccion($direccion)
	{
	    $this->direccion = $this->db->real_escape_string($direccion);
	}

	public function getCoste()
	{
	    return $this->coste;
	}
	
	public function setCoste($coste)
	{
	    $this->coste = $coste;
	}

	public function getEstado()
	{
	    return $this->estado;
	}
	
	public function setEstado($estado)
	{
	    $this->estado = $this->db->real_escape_string($estado);
	}

	public function getFecha()
	{
	    return $this->fecha;
	}
	
	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getHora()
	{
	    return $this->hora;
	}
	
	public function setHora($hora)
	{
	    $this->hora = $hora;
	}

	// Métodos para operaciones con la base de datos

	// Guardar pedido
	public function save()
	{
		$sql = "INSERT INTO pedidos VALUES(
			null, 
			{$this->getUsuario_id()}, 
			'{$this->getProvincia()}', 
			'{$this->getLocalidad()}', 
			'{$this->getDireccion()}', 
			{$this->getCoste()}, 
			'{$this->getEstado()}', 
			CURDATE(), 
			CURTIME()
		);";

		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}

		return $result;
	}

	// Obtener el ID del último pedido insertado
	public function getLastId()
	{
		return $this->db->insert_id;
	}

	// Guardar línea de pedido
	public function saveLinea($pedido_id, $producto_id, $unidades)
	{
		$sql = "INSERT INTO lineas_pedidos VALUES(
			null, 
			{$pedido_id}, 
			{$producto_id}, 
			{$unidades}
		);";

		$save = $this->db->query($sql);

		return $save ? true : false;
	}

	// Obtener un pedido por ID
	public function getOne()
	{
		$sql = "SELECT * FROM pedidos WHERE id = {$this->getId()};";
		$pedido = $this->db->query($sql);

		return $pedido->fetch_object();
	}

	// Obtener todos los pedidos de un usuario
	public function getByUser($usuario_id)
	{
		$sql = "SELECT * FROM pedidos WHERE usuario_id = {$usuario_id} ORDER BY id DESC;";
		$pedidos = $this->db->query($sql);

		return $pedidos;
	}

	// Obtener todos los pedidos (para admin)
	public function getAll()
	{
		$sql = "SELECT p.*, u.nombre, u.apellidos 
		        FROM pedidos p 
		        INNER JOIN usuarios u ON u.id = p.usuario_id 
		        ORDER BY p.id DESC;";
		$pedidos = $this->db->query($sql);

		return $pedidos;
	}

	// Obtener líneas de un pedido
	public function getLineasPedido($pedido_id)
	{
		$sql = "SELECT lp.*, pr.nombre, pr.precio, pr.imagen 
		        FROM lineas_pedidos lp 
		        INNER JOIN productos pr ON pr.id = lp.producto_id 
		        WHERE lp.pedido_id = {$pedido_id};";
		$lineas = $this->db->query($sql);

		return $lineas;
	}

	// Actualizar estado del pedido
	public function updateEstado($pedido_id, $estado)
	{
		$sql = "UPDATE pedidos SET estado = '{$estado}' WHERE id = {$pedido_id};";
		$update = $this->db->query($sql);

		return $update ? true : false;
	}
}

?>
