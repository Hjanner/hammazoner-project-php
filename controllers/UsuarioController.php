<?php 

	require_once 'models/usuario.php';		//cargando el modelo

	class usuarioController
	{
		
		public function index()
		{
			header("Location:".base_url.'inicio.php');

			if (isset($_SESSION['identify'])) {
				header("Location:".base_url.'inicio.php');
			}
		}



		//metodo para guardar datos
		public function save()
		{
			if (!empty($_POST)) {
				$usuario = new Usuario();					//instanciando objeto usuario

			//validando datos (tocaria adaptar la validacioni del proyecto anterior)
				$nombre = isset($_POST['nombre']) ? ($_POST['nombre']) : false;
				$apellido = isset($_POST['apellido']) ? ($_POST['apellido']) : false;
				$email = isset($_POST['email']) ? ($_POST['email']) : false;
				$password = isset($_POST['password']) ? ($_POST['password']) : false;


			//recogiendo datos
				if ($nombre && $apellido && $email && $password) {
					$usuario->setNombre($nombre);	
					$usuario->setApellido($apellido);		
					$usuario->setEmail($email);		
					$usuario->setPassword($password);	
				}else{
					$_SESSION['register'] = "Failed";
				}
	

			//guardando datos
				$save = $usuario->save();

			//sessiones de informacion para el registro
				if ($save) {
					$_SESSION['register'] = "Complete";
				}else{
					$_SESSION['register'] = "Failed";
				}
			}

			//header("Location:".base_url.'usuario/register');
		}

		//metodo login
		public function login()
		{

			if (isset($_POST)) {
			//identificar usuario
			
			//consulta a la base de datos (logica)
				$usuario = new Usuario();				//instanciamos el modelo que nos va a permitir realizar consulta a la base de datos

			//seteamos los datos
			$usuario->setEmail($_POST['email']);		
			$usuario->setPassword($_POST['password']);

			$identify = $usuario->login();						//llamamos al metodo que realiza la consulta


				if ($identify && is_object($identify)) {
					$_SESSION['identify'] = $identify;

					if ($_SESSION['identify']->rol == "admin") {
						$_SESSION['admin'] = true;
					}
				}else{
					$_SESSION['error_login'] = "identificacion fallida";
				}

//			var_dump($identify);
//			die();

			}
		
			
			header("Location:".base_url.'producto/index');
			//header("Location:".base_url.'usuario/index');
		}


		public function logout()
		{
			if (isset($_SESSION['identify'])) {
				unset($_SESSION['identify']);
			}

			if (isset($_SESSION['admin'])) {
				unset($_SESSION['admin']);
			}

			header("Location:".base_url.'producto/index');
			//header("Location:".base_url.'usuario/index');
			//header("Location:".base_url.'index.php');
		}
		

	}

 ?>