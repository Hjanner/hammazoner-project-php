<?php 

require_once 'models/productoM.php';	

	class productoController
	{
	
	//index
		public function index()
		{

			$producto = new Producto();
			$productos = $producto->getRandom(6);			//para tener disponibles los objetos(producto) a mostrar en la vista

			//renderizar vista
			require_once 'views/layout/header.php';
			require_once 'views/layout/menu.php';
			require_once 'views/layout/aside.php';
			require_once 'views/productos/destacado.php';
			require_once 'views/layout/footer.php';
		}


	//pagina de gestion
		public function gestion()
		{
			Utils::isAdmin();

			$producto = new Producto();
			$productos = $producto->getAll();

			require_once 'views/productos/gestion.php';
		}


	//metodo llevar a la pagina create producto
		public function create()
		{
			Utils::isAdmin();
			require_once 'views/productos/create.php';
		}


	//guardar un producto nuevo o editar un producto existente
		public function save()
		{
			Utils::isAdmin();

		//comprobacion
			if (isset($_POST)) {
				//tomando los datos
					 $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
					 $categoria_id = isset($_POST['categoria']) ? $_POST['categoria'] : false;
					 $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
					 $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
					 $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
					// $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
			

				//comprobando si llegan bien
				if ($nombre && $categoria_id && $descripcion && $precio && $stock){
					
				//instanciando el producto
					$producto = new Producto();

				//seteamos los datos en el objeto
					$producto->setNombre($nombre);
					$producto->setCategoria_id($categoria_id);
					$producto->setDescripcion($descripcion);
					$producto->setPrecio($precio);
					$producto->setStock($stock);
					
				//guardar la imagen
					if (isset($_FILES['imagen'])) {
						$file = $_FILES['imagen'];			//recogiendo el archivo
						$filename= $file['name'];			//guardando el nombre el archivo
						$mimetype = $file['type'];			//tipo de dato del archivo
					}


				//verificamos que el mimetype del archivo sea el de una imagen
					if ($mimetype == 'image/jpg' || $mimetype == 'image/png' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif') {
					

						if (!is_dir('uploads/images')) {			//creando directorio de guardado de imagenes
							mkdir('uploads/images', 077, true);
						}

						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);			//moviendo la imagen al directorio
						$producto->setImagen($filename);				//seteando la imagen 
					}

				//verificamos si se quiere realizar un edit o un guardado
					if (isset($_GET['id'])) {	
						$id = $_GET['id'];						//guardamos id que llega de la url
						$producto->setId($id);
						$save = $producto->editM();				//para edit
					}else{
						$save = $producto->save();				//para guardar uno nuevo
					}

					

					if ($save) {
						$_SESSION['producto'] = 'completed';
					
					}else{
						$_SESSION['producto'] = 'failed';
					}

				}else{
						$_SESSION['producto'] = 'failed';
						var_dump("hola3"); die();
					}

			}else{
					$_SESSION['producto'] = 'failed';
				}

			header("Location:".base_url.'producto/gestion'); //me va a llevar al metodo gestion del controlador de producto
		}


	//eliminar producto
		public function delete()
		{
			Utils::isAdmin();

			if (isset($_GET['id'])) {

				$id = $_GET['id'];					//guardamos valor de get
				$producto = new Producto();			//instanciamos el objeto
				$producto->setId($id);				//seteamos la propiedad id
				$delete = $producto->deleteM();				//utilizamos el metodo delete 

				if ($delete) {								//creamos sesion de control
					$_SESSION['delete'] = "completed";
				}
				else{
					$_SESSION['delete'] = "failed";
				}
			}
			else{
					$_SESSION['delete'] = "failed";
				}			
		
			header("Location:".base_url."/producto/gestion");			//redireccion al metodo gestion que nos lleva a la vista

			return $_SESSION['delete'];
		}


	//para mostrar el producto que se quiere cambiar
		public function edit()
		{
			Utils::isAdmin();
			$edit = true; 			//variable de control

			if ($_GET['id']) {
				$id = $_GET['id'];

				$productoOne = new Producto();
				$productoOne->setId($id);
				$producto = $productoOne->getOne();

				require_once 'views/productos/create.php';				//cargando vista
			}else{
				$_SESSION['edit'] = "failed";
			}
		}


	//para ver detalles de un producto
		public function ver()
		{
			if ($_GET['id']) {
				$id = $_GET['id'];

				$productoOne = new Producto();
				$productoOne->setId($id);
				$producto = $productoOne->getOne();
			}

			require_once 'views/layout/header.php';
			require_once 'views/layout/menu.php';
			require_once 'views/layout/aside.php';
			require_once 'views/productos/ver.php';				//cargando vista
			require_once 'views/layout/footer.php';
		}
}
?>