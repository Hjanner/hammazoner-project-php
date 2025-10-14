<!--//trabaja con lo que le llega desde la url
-->
<?php
session_start();

//conexiones
	require_once 'config/db.php';			//conectar la base da datos
    require_once 'autoload.php';			//conectar el autoload para los controller
    require_once 'config/parametros.php';	//cargando los parametros de apache para url linda
    require_once 'helpers/utils.php';

   //layout
    require_once 'views/layout/header.php';
    require_once 'views/layout/menu.php';
   // require_once 'views/layout/login_register.php';
    //require_once 'views/layout/aside.php';



    function showError()			//para mostrar error en caso de no encontrar la pagina web
    {
    	$error_pagina = new errorController();
	    $error_pagina->index();
    }

    if (isset($_SESSION['identify'])) {
    	require_once 'views/layout/action.php';
	}

    //para pagina de inicio
    if (!isset($_SESSION['identify'])) {
    	require_once 'views/layout/aside.php';
		require_once 'views/layout/main.php';
	}

/*
	    if (isset($_GET['controller'])) {						 	//cargando el controlador y verificaando que existe
	        $controllerName = $_GET['controller'].'Controller';		//asignando el nombre completo al controlador llega por get
	    }else{
	    	var_dump("hola");
	        showError();
	        exit();
	    }*/
/*
	    if (class_exists($controllerName)) {

	        $controlador = new $controllerName();			//instanciando el controlador 

	        if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {    //verificando que existe el motodo      
	            $action = $_GET['action'];			//asignando la accion que llega por get

	            $controlador->$action();
	        }else{
	            showError();
	        }

	    }else{

	       showError();
	    }*/

	include_once 'views/layout/main.php';    

  	include_once 'views/layout/footer.php'; 
  ?>
    
