<?php 

	class Producto
	{
		private $id;
		private $categoria_id;
		private $nombre;
		private $descripcion;
		private $precio;
		private $stock;
		private $oferta;
		private $fecha;
		private $imagen;
		private $db;


		public function __construct()
		{
			$this->db = Database::connect();			//conectar a la abse de datos
		}

	//getters y setters
		public function getId()
		{
		    return $this->id;
		}
		
		public function setId($id)
		{
		    $this->id = $id;
		}


		public function getCategoria_id()
		{
		    return $this->categoria_id;
		}
		
		public function setCategoria_id($categoria_id)
		{
		    $this->categoria_id = $categoria_id;
		    return $this;
		}


		public function getNombre()
		{
		    return $this->nombre;
		}
		
		public function setNombre($nombre)
		{
		    $this->nombre = $this->db->real_escape_string($nombre);			//realizando un escape de comillas para guardar los datos
		    return $this->nombre;
		}


		public function getDescripcion()
		{
		    return $this->descripcion;
		}
		
		public function setDescripcion($descripcion)
		{
		    $this->descripcion = $this->db->real_escape_string($descripcion);	
		    return $this;
		}


		public function getPrecio()
		{
		    return $this->precio;
		}
		
		public function setPrecio($precio)
		{
		    $this->precio = $this->db->real_escape_string($precio);	
		    return $this;
		}


		public function getStock()
		{
		    return $this->stock;
		}
		
		public function setStock($stock)
		{
		    $this->stock = $this->db->real_escape_string($stock);	
		    return $this;
		}


		public function getOferta()
		{
		    return $this->oferta;
		}
		
		public function setOferta($oferta)
		{
		    $this->oferta = $this->db->real_escape_string($oferta);	
		    return $this;
		}


		public function getFecha()
		{
		    return $this->fecha;
		}
		
		public function setFecha($fecha)
		{
		    $this->fecha = $fecha;
		    return $this;
		}
		

		public function getImagen()
		{
		    return $this->imagen;
		}
		
		public function setImagen($imagen)
		{
		    $this->imagen = $imagen;
		}	


	//metodo para listar
		public function getAll()
		{
			$sql = "SELECT * FROM productos ORDER BY id DESC;";
			$productos = $this->db->query($sql);
			return $productos;
		}


	//mostrar un solo producto, para la seccion de editar prod
		public function getOne()
		{
			$sql = "SELECT * FROM productos WHERE id = {$this->getId()};";
			$producto = $this->db->query($sql);
			return $producto->fetch_object();			//lo devolvemos de una vez como un objeto usable
		}

	//mostrar producto por categoria especifica	
		public function getForCategory()
		{
			$sql = "SELECT p.*, c.nombre AS 'categoria_nombre' FROM productos p "
			."INNER JOIN categorias c ON c.id = p.categoria_id "
			."WHERE p.categoria_Id= {$this->getCategoria_id()};";

			$producto = $this->db->query($sql);

			return $producto;		
		}


	//metodo para guardar los datos
		public function save()
		{
		//sentencia sql
			$sql = "INSERT INTO productos VALUES(null, '{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}');";

		//guardando datos en la base de datos
			$save = $this->db->query($sql);

			$result = false;
			if ($save) {
				$result = true;
			}

			//***********************************************************echo $this->db->error;

		return $result;
	 }


	//borrar
		public function deleteM()
		{
			$sql = "DELETE FROM productos WHERE id = {$this->id};";
			$delete = $this->db->query($sql);

			$result = false;

				if ($delete) {
					$result = true;
				}

			return $result;
		}


	//editar
		public function editM()
		{
			//sentencia sql
			$sql = "UPDATE productos SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock = {$this->getStock()}, categoria_id = {$this->getCategoria_id()} ";

			if ($this->getImagen() != null) {
				$sql .= ",imagen =  '{$this->getImagen()}'";
			}

			$sql .= "WHERE id = '{$this->getId()}';";				//concatenando la coma al final
			

		//guardando datos en la base de datos
			$save = $this->db->query($sql);

			$result = false;
			if ($save) {
				$result = true;
			}


		return $result;
	 }
		

	//obtener productos
	 public function getRandom($limit)
	 {
	 	$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit;");

	 	return $productos;
	 }



}
?>



