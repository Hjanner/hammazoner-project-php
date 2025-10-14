<?php 

	class Utils
	{

		public static function deleteSession($name)
		{
			if (isset($_SESSION[$name])) {
				unset($_SESSION[$name]);
				$_SESSION[$name] = null;
			}
		}

		public static function isAdmin()
		{
			if (!isset($_SESSION['admin'])) {
				header("location:".base_url."inicio.php");
			}else{
				return true;
			}
		}

		public static function showCategorias()
		{
			require_once 'models/categoriaM.php';

			$categoria = new Categoria();
			$categorias = $categoria->getAll();

			return $categorias;
		}
	}



 ?>