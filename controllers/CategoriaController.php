<?php 
require_once 'models/categoriaM.php';
require_once 'models/productoM.php';

	class categoriaController
	{
		
		//para dirigir al index
		public function index()
		{
			Utils::isAdmin(); 						//redireccion en caso de que no sea admin
			$categoria = new Categoria();	
			$categorias = $categoria->getAll();		////variable que se para almacenar las categoriasr en la vista

			require 'views/categoria/index.php';						//llamamos a la vista
			//header("Location:".base_url."views/categoria/index.php");
		}

	//para llevara a la pagina de crear categoria
		public function create()
		{
			Utils::isAdmin();
			require_once 'views/categoria/create.php';
		}

	//guardar la categoria enla base de datos
		public function save()
		{
			Utils::isAdmin();
			
			if ($_POST && isset($_POST['nombre'])) {
				$categorias = new Categoria();
				$categorias->setNombre($_POST['nombre']);
				$categoria = $categorias->save();	
			}

			header("Location:".base_url.'categoria/index');
		}


	//para mostrar la categoria seleccionada
		public function verCategoria()
		{
			if(isset($_GET['id'])){
				$id = $_GET['id'];

			//conseguir categoria
				$categoriaO = new Categoria();
				$categoriaO->setId($id);
				$categoria = $categoriaO->getOne();					//var disponible para la view

			//conseguir productos
				$producto = new Producto();			//cargado del modelo producto, en el require de inicio
				$producto->setCategoria_id($id);
				$productos = $producto->getForCategory();			//var disponible para view
			}

			require_once 'views/layout/header.php';
			require_once 'views/layout/menu.php';
			require_once 'views/layout/aside.php';
			require_once 'views/categoria/ver.php';
			require_once 'views/layout/footer.php';
		}

	}




 ?>