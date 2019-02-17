<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo $titulo; ?></title>		
	<!-- BootStrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap/bootstrap-4.min.css")?>">
	<!-- FontAwesome 5 -->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/fontawesome/fontawesome.package.min.css")?>">
	<!-- FavIcon -->
	<link rel="icon" href="<?php echo base_url("assets/images/logo.png")?>" sizes="16x16" type="image/gif">
	<!-- Color Scheme -->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/color%20schemes/colors.css")?>">
</head>
<body class="container-fluid">
	<div class="container">
		<header class="row">
			<div class="col-xs-6">
				<img class="img-fluid" style="width: 100px; height: 100px;" src="<?php echo base_url("assets/images/logo.png")?>" alt="Insertar Imagen Aqui">
			</div>
			<div class="clear">&nbsp;</div>
			<div class="col-xs-6">
				<h1><img src="<?php echo base_url("assets/images/banner_2.png")?>" alt="Travelopolis"></h1>
				<small class="text-white">La capital del viaje</small>
			</div>
		</header>
	</div>