<!--los modelos son la representacion de las tablas de la base de datos-->
<!--cuando yo creo un objeto con el modelo, lo que hago es simular que estoy creando un registro en la base de datos, eque al final se genera
Un objeto representa un registro
Los modelos interactuan con la base de datos
y los controladores llaman a los modelos para generar la informacion en la bade dedatos-->
<?php 

	class Categoria
	{
		private $id;
		private $nombre;
		private $db;


		public function __construct()
		{
			$this->db = Database::connect();			//conectar a la base de datos
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


		public function getNombre()
		{
		    return $this->nombre;
		}
		
		public function setNombre($nombre)
		{
		    $this->nombre = $this->db->real_escape_string($nombre);			//realizando un escape de comillas para guardar los datos
		    return $this->nombre;
		}


	//metodo consultar las categorias
		public function getAll()
		{

		//sentencia sql
			$sql = "SELECT * FROM categorias ORDER BY id DESC;";

		//guardando datos en la base de datos
			$categorias = $this->db->query($sql);

		return $categorias;
	}
	

	//PARA GUARDAR LAS CATEGORIAS
		public function save()
		{
			//sentencia sql
			$sql = "INSERT INTO categorias VALUES(null, '{$this->getNombre()}');";

		//guardando datos en la base de datos
			$save = $this->db->query($sql);

			$result = false;
			if ($save) {
				$result = true;
			}

		return $result;
		}


	//sacar categoria 
		public function getOne()
		{
			$sql = "SELECT * from categorias WHERE id = '{$this->getID()}';";

			$categoria = $this->db->query($sql);

		return $categoria->fetch_object();
		}
	
}


?>