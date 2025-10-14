<?php 

	class Usuario
	{
		private $id;
		private $nombre;
		private $apellido;
		private $email;
		private $password;
		private $rol;
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


		public function getNombre()
		{
		    return $this->nombre;
		}
		
		public function setNombre($nombre)
		{
		    $this->nombre = $this->db->real_escape_string($nombre);			//realizando un escape de comillas para guardar los datos
		    return $this->nombre;
		}


		public function getApellido()
		{
		    return $this->apellido;
		}
		
		public function setApellido($apellido)
		{
		    $this->apellido = $this->db->real_escape_string($apellido);
		}


		public function getEmail()
		{
		    return $this->email;
		}
		
		public function setEmail($email)
		{
		    $this->email = $this->db->real_escape_string($email);
		}


		public function getPassword()
		{
		    return $this->password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
		}
		
		public function setPassword($password)
		{
		    $this->password = $password;
		}


		public function getRol()
		{
		    return $this->rol;
		}
		
		public function setRol($rol)
		{
		    $this->rol = $rol;
		}

		public function getImagen()
		{
		    return $this->imagen;
		}
		
		public function setImagen($imagen)
		{
		    $this->imagen = $imagen;
		}	


	//metodo para guardar los datos
		public function save()
		{

		//sentencia sql
			$sql = "INSERT INTO usuarios VALUES(null, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";

		//guardando datos en la base de datos
			$save = $this->db->query($sql);

			$result = false;
			if ($save) {
				$result = true;
			}

		return $result;
	}

	//metodo para login
	public function login()
	{
		$result = false;

		//obteniendo los datos
		$email = $this->email;
		$password = $this->password;

		//comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email';";
		$login = $this->db->query($sql);								//ejecutando sentencia sql

		if ($login && $login->num_rows == 1) {
			$usuario = $login->fetch_object();			//guardando los datos obtenidos en un objeto

			//verificar contraseña
			$verify = password_verify($password, $usuario->password);

			if ($verify) {
				$result = $usuario;
			}
		}

		return $result;
	}
}

?>