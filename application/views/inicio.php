<html>
  <head>
    <title>Service Hosting</title>
    <meta charset="utf-8" />
	<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->

    <link rel="stylesheet" href="/template/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/template/css/demo.min.css" />
    <link rel="stylesheet" href="/template/css/style.css" />
      
    <script src="/template/js/libs/jquery-2.1.3.min.js"></script>
	<script src="/template/js/libs/bootstrap.min.js"></script>
	<script src="/template/js/plugins/bootbox/bootbox.min.js"></script>
	<script>
	function ingresar()
	{
		msg=	"<div>"
					+"<form id='form_in'>"
						+"Usuario : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='login'><br><br>"
						+"Contraseña : &nbsp;<input type='password' name='password'>"
					+"</form>"
				+"</div>";
		bootbox.dialog({
			message: msg,
			title: "Ingresar",
			className: "in_form",
			buttons: {
				success:{
					label: "Ingresar!",
					className: "btn-success",
					callback: function(){
						$.ajax({
							type: "post",
							url: "/auth/login",
							data: $('#form_in').serialize()
						})
						.done(function(msg){
							if(msg!="no")
							{
								location.href="";
							}
							else
							{
								bootbox.dialog({
									message: "Usuario o Contraseña incorrectas",
									title: "Error",
									className: "",
									buttons: {
										danger:{
											label: "OK!",
											className: "btn-danger",
											callback: function()
											{

											}
										}
									}
								})
							}
						})
					}
				},
				danger: {
					label: "Cancelar",
					className: "btn-danger",
					callback: function() {

						}
				}
			}
		});
	}
	function registrarse()
	{
		msg= "<div>"
				+"<form id='registro'>"
					+"Nombre: <input type='text' name='nombre'><br><br>"
					+"Apellido: <input type='text' name='apellido'><br><br>"
					+"Correo: <input type='text' name='email'><br><br>"
					+"Usuario: <input type='text' name='username'><br><br>"
					+"Contraseña: <input type='password' name='password' id='pswd1'><br><br>"
					+"Repita su contraseña: <input type='password' name='confirm_password' id='pswd2'><br><br>"
				+"<form>"
		     +"</div>" ;
		bootbox.dialog({
			message: msg,
			title: "Registro",
			className: "registroForm",
			buttons: {
				success:{
					label: "Registrarse",
					className: "btn-success",
					callback: function(){
						var pswd1=$("#pswd1").val();
						var pswd2=$("#pswd2").val();
						if(pswd1==pswd2)
						{
							$.ajax({
								type: "post",
								url: "/auth/register",
								data: $('#registro').serialize()
							})
							.done(function(msg){
								if(msg=="You have successfully registered. Check your email address to activate your account.")
								{
									bootbox.dialog({
										message: "Te has registrado exitosamente",
										title: "Exito",
										className: "",
										buttons: {
											danger:{
												label: "OK!",
												className: "btn-success",
												callback: function()
												{

												}
											}
										}
									})
								}
								else
								{
									bootbox.dialog({
										message: "Oooops! Algo salio mal...",
										title: "Error",
										className: "",
										buttons: {
											danger:{
												label: "OK!",
												className: "btn-danger",
												callback: function()
												{

												}
											}
										}
									})
								}
							})
						}
						else
						{
							bootbox.dialog({
								message: "Las contraseñas no coinciden",
								title: "Error",
								className: "",
								buttons: {
									danger:{
										label: "OK!",
										className: "btn-danger",
										callback: function()
										{

										}
									}
								}
							})
						}
					}
				},
				danger: {
					label: "Cancelar",
					className: "btn-danger",
					callback: function() {

						}
				}
			}
		});
	}
	</script>
  </head>
	<body>
		<header id="header">  
			<h2 id="logo"><a href="#"><img src="/template/images/logo3.gif" alt=""/></a></h1>
				<nav id="nav">
					<ul>
						<!-- Aquí Empiezan los menus aun no esta definidos :/ -->
						<li><a href="#">Inicio</a></li>
						<!--<li>
							<a href="anchor.php">Hosting</a>
						</li>-->
						<!-- Opcional-->
						
								<li><a href="#" class="buttonspecial" onclick="registrarse()">Registrate</a></li>
								<li><a href="#" onclick="ingresar()">Ingresa</a></li>
						
								<!--<li><a href="#">BIENVENIDO </a></li>
								<li><a href="php/salir.php">Cerrar Sesión</a></li>-->
							
					</ul>
				</nav>
			</header>
			<!-- Slide AQUI VA IR EL SLIDE 
			<section id="one">
				<div class="content1">
					<header>
						<h2>Aqui va el slide</h2>
					</header>
					<ul class="actions">
						<li><a href="#" class="button">Mas acerca de nosotros</a></li>
					</ul>
				</div>
				<a href="#banner" class="sig-icon">Sig</a>
			</section>-->
			<!-- Banner -->
			<section id="banner">
				<div class="content">
					<header>
						<h2>Servicio de Hosting Gratuito</h2>
						<p>Crea tu cuenta con nosotros<br />
						Obten mas de 1 Tb de almacenamiento</p>
					</header>
					<span class="image"><img src="/template/images/host.jpg" alt="" /></span>
				</div>
				<!--<a href="#footer" class="sig-icon">Sig</a><a href="#header">Regresar</a>-->
			</section>

		
		<!-- Footer -->
			<footer id="footer">
				<!--<ul class="icons">
				
				</ul>-->
                </br>
				<p class="copyright">
                    &copy; Untitled. All rights reserved.</p>
			</footer>
			
	</body>
</html>