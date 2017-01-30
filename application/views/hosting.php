<!DOCTYPE HTML>
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
	<script type="text/javascript">
	function cargar()
	{
		msg=	'<div class="row">' 
					+'<form action="up_file" method="post" accept-charset="utf-8" enctype="multipart/form-data">'
					    +'Selecciona el archivo que subiras:'
					    +'<input type="hidden" class="form-control" name="folder" value="<?=$_GET['d']?>" placeholder="Buscar archivo...">'
					    +'<div class="input-group input-group-lg">'
					      	+'<input type="file" class="form-control" name="userfile" placeholder="Buscar archivo...">'
					      	+'<span class="input-group-btn">'
					        	+'<button class="btn btn-success" type="submit">Subir!</button>'
					      	+'</span>'
					    +'</div>'
					+'</form>'
				+'</div>';
		bootbox.dialog({
			message: msg,
			title: "Subir Archivo",
			className: "in_form",
			buttons: {
				
				danger: {
					label: "Cancelar",
					className: "btn-danger",
					callback: function() {

						}
				}
			}
		});
	}
	function new_dir(dentro,lvl)
	{
		msg=	'<div class="row">' 
					+'<form id="registro">'
					    +'Nombre del Directorio'
					    +'<div class="input-group input-group-lg">'
					    	+'<span class="input-group-addon"><?=$url?></span>'
					      	+'<input type="text" class="form-control" name="dirname" placeholder="nombre del Directorio">'
					      	
					    +'</div>'
					    +'<input type="hidden" name="bajo" class="form-control" value="'+dentro+'">'
					    +'<input type="hidden" name="lvl" class="form-control" value="'+lvl+'">'
					+'</form>'
				+'</div>';
		bootbox.dialog({
			message: msg,
			title: "Ingresar",
			className: "in_form",
			buttons: {
				success: {
					label: "Crear Carpeta",
					className: "btn-success",
					callback: function() {
						$.ajax({
							type: "post",
							url: "new_dir",
							data: $('#registro').serialize()
						})
						.done(function(msg){
							if(msg=="Se ha creado la carpeta con exito")
							{
								bootbox.dialog({
									message: msg,
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
									message: msg,
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
	</script>
	
  </head>
	<body>
		<header id="header">  
			<h2 id="logo"><a href="/inicio/principal"><img src="/template/images/logo3.gif" alt="" /></a></h2>
			<nav id="nav">
				<ul>
					<!-- Aquí Empiezan los menus aun no esta definidos :/ -->
					<li><a href="/inicio/principal">Inicio</a></li>
					<li>
						<a href="#">Hosting</a>
					</li>
					<!-- Opcional-->
					<li><a href="/incio/principal">BIENVENIDO <?=$username?></a></li>
					<li><a href="/auth/logout">Cerrar Sesión</a></li>
				</ul>
			</nav>
		</header>
		<div id="banner" style="margin-top:-60px;">
			<div class="content">
				
			    <nav id="caja">
					<ul>
                        <br>
                        <br>
                        <li>
                            <a href="" id ="con">Actualizar</a>
                       
						</li>
                        <br>
                        
                            <br>

						<li>
							<a href="#" id ="con">Borrar</a>
						</li>
                        <br>
                        <br>
						<li>
							<a href="#" id ="con" onclick="cargar()">Subir</a>
						</li>
                        <br>
                        <br>
						<li>
							<a href="#" id ="con">Descargar</a>
						</li>
						<br>
                        <br>
                       		<li>
									<a href='#' id ='con' onclick='new_dir(<?=$debajo?>,<?=$nivel?>)'>Nueva Carpeta</a>
							</li>
                        
                        	
                    </br>
					</ul>
			    </nav>
                <div class="box-out">
                	<h2 style="text-align:left; color:#222;">
                		<img src="/template/images/folder-icon.png" style="max-width:25px;"><a href="?d=0"><?=$username?></a><?=$navegar?>
                	</h2>
                	<ul>
			       	<?php
			       		foreach ($directorio as $key) {
			       			echo "<li><a href='?d=".$key->id_carpeta."'>".$key->nombre."</a></li><br/>";
			       		}
			       		foreach($file as $key){
			       			echo "<li><a href='/media/".$user_id.$url.$key->nombre_completo."'>".$key->nombre_completo."</a></li><br/>";
			       		}
			       	?>
			   		</ul>
		        </div>
				
            </div>
    	</div>
				
		
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
