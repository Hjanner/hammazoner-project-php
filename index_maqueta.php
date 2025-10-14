<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="recursos/assets/css/stylesh.css">
	<title>Hamazonner</title>
</head>
<body>
	<header>
		<div class="logo">
			<a href="" class="logo_img">
				<img src="recursos/assets/img/camiseta.png" alt="logo de la pagina">
			</a>
			<a href="" class="logo_text"><h1>Hamazonner</h1></a>
		</div>

		<nav>
			<ul>
				<li><a href=""></a>Inicio</li>
				<li><a href=""></a>Categia 1</li>
				<li><a href=""></a>Categia 2</li>
				<li><a href=""></a>Categia 2</li>
				<li><a href=""></a>Sobre Nosotros</li>
				<li><a href=""></a>Contactanos</li>
			</ul>
		</nav>
	</header>

<!-- aside -->
	<aside class="block_aside">
		<div class="block login">
			<h3>Login</h3>

			<form action="login.php" method="POST">
				<label for="email">Email</label>
				<input type="email" name="email" placeholder="Ingresar correo">

				<label for="password">Contraseña</label>
				<input type="password" name="password" placeholder="Ingresar contraseña">

				<input type="submit" name="enviar" value="Entrar" class="boton_enviar">
			</form>

			<div  class="acciones">
				<a href="" class="boton_a">Mis pedidos</a>
				<a href="" class="boton_a">Gestionar pedidos</a>
				<a href="" class="boton_a">Gestionar categorias</a>	
			</div>

		</div>

		<div class="block registro">
			<h3>Registro</h3>

			<form action="registro.php" method="POST">

				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" placeholder="Ingresar nombre">

				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" placeholder="Ingresar apellido">

				<label for="email">Email</label>
				<input type="email" name="email" placeholder="Ingresar email">

				<label for="password">Contraseña</label>
				<input type="password" name="password" placeholder="Ingresar contraseña">

				<input type="submit" name="submit_registro" class="boton_enviar" value="Entrar">
			</form>
		</div>
	</aside>

	<main>		
		<div class="principal">
			<h2>Titulo</h2>

			<div>
				<article>
					<img src="recursos/assets/img/camiseta.png" alt="">
					<h3>Titulo 2</h3>
					<p>"Lorem ipsum dolor sit amederit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  deserunt mollit anim id est laborum."</p>
					<a href="" class="boton comprar">Comprar</a>
				</article>
				<article>
					<img src="recursos/assets/img/camiseta.png" alt="">
					<h3>Titulo 2</h3>
					<p>"Lorem ipsum dolor sit amrit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat  anim id est laborum."</p>
					<a href="" class="boton comprar">Comprar</a>
				</article>
				<article>
					<img src="recursos/assets/img/camiseta.png" alt="">
					<h3>Titulo 2</h3>
					<p>"Lorem ipsum dolor sit aptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
					<a href="" class="boton comprar">Comprar</a>
				</article>
				<article>
					<img src="recursos/assets/img/camiseta.png" alt="">
					<h3>Titulo 2</h3>
					<p>"Lorem ipsum dolor sit amet, conse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
					<a href="" class="boton comprar">Comprar</a>
				</article>
				<article>
					<img src="recursos/assets/img/camiseta.png" alt="">
					<h3>Titulo 2</h3>
					<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna  Exceptent, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
					<a href="" class="boton comprar">Comprar</a>
				</article>
				<article>
					<img src="recursos/assets/img/camiseta.png" alt="">
					<h3>Titulo 2</h3>
					<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minst mollit anim id est laborum."</p>
					<a href="" class="boton comprar">Comprar</a>
				</article>
				</div>
			</div>
		</main>

		<div class="add">
			<a href="">
				<img src="recursos/assets/img/publicidad.jpg" alt="">
			</a>
		</div>

	<footer>Desarrollado por HannerCompany &copy 2023</footer>		

</body>
</html>	