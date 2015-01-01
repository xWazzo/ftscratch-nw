<!Doctype html>
<!--[if lt IE 7]><html lang="es-mx" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-mx" class="no-js"><!--<![endif]-->

<html>
<head>
	
	<meta charset="UTF-8">
	
	<meta name="author" content="The NuevaWeb Team">
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>

	<?php //This is my custom stylesheet ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/style.css">
	<?php // icons & favicons ?>
	<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/img/assets/apple-icon-touch.png">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/img/assets/favicon.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/assets/favicon.ico">
	<![endif]-->
	<meta name="msapplication-TileColor" content="#f8e047">
	<meta name="msapplication-TileImage" content="<?php bloginfo('template_url'); ?>/img/assets/win8-tile-icon.png">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); // wordpress admin-bar functions ?>

	<?php // Your Google Analytics goes here. ?>


</head>
<body>

	<?php 
	/*
	*
	* El css que genera el "En Construcción" está salvado en el archivo .less
	* únicamente comenta la línea o elimínala para quitar el display en construcción
	*
	* Elimina éste comentario y ya estás listo 
	* Happy Developing!
	*
	*/
	?>

	<header id="main-header">
		<nav class="navbar" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
			      	<h1><?php bloginfo('name'): ?></h1>
			      </a>
			    </div>

				<nav id="main-nav" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="#">Inicio</a></li>
						<li><a href="#">Nosotros</a></li>
						<li><a href="#">Proyectos</a>
							<ul>
								<li><a href="#">Lorem ipsum</a></li>
								<li><a href="#">Lorem ipsum</a></li>
								<li><a href="#">Lorem ipsum</a>
									<ul>
										<li><a href="#">Lorem ipsum</a></li>
										<li><a href="#">Lorem ipsum</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a href="#">Blog</a></li>
					</ul>
					<div id="utilities-nav" class="hidden-xs">
						<a href="#" title="Log In">Log In</a>
						<div id="fullscreen" title="Fullscreen" class="fa fa-expand"></div>
					</div>
				</nav>

			</div><!-- /.container-fluid -->
		</nav><!-- /navbar -->
	</header><!-- /#main-header -->



