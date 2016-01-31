	<!-- ##### Capçalera ########################################################## -->

	<div id="header">

		<div id="logo">
			<img src="img/logo.jpg" />
		</div>
		<div class="header_1">
			<a href="#" title="5DB">5DB PROFESSIONAL GAMING TEAM</a>
		</div>
		<div class="subheader">
			&nbsp;
			<div class="barra">
				<a href="">5DB</a> >> <a href="registre.php">Tienda Online</a>
				<a class="login2" style="padding-left:200px"><?php if (isset($_SESSION['login'])) echo "Logueado como: ".$_SESSION['login']; ?></a>
			</div>
			<?php if (!isset($_SESSION['login'])) { ?>
				<a class="login" href="login.php">Login</a>
			<?php } else { ?>
				<a class="login" href="logout.php">Salir</a>
			<?php } ?>
		</div>
	</div>


	<!-- ##### Barra esquerra ########################################################## -->

    <div id="barra_esquerra">				

		<div id="menu_esquerra">

			<ul id="nav">
				<li>
					<a href="login.php">Login</a>
				</li>
				<li>
					<a href="registre.php">Registro</a>
				</li>
				<li>
					<a href="#">Conoce al team</a>
				</li>
				<li>
					<a href="#">Palmarés</a>
				</li>
				<li>
					<a href="#">Horarios de entreno</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- ##### Barra dreta ########################################################## -->

	<div id="barra_dreta">
		<img src="img/shyvana.jpg" alt="foto_derecha" />
	</div>