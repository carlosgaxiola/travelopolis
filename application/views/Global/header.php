<?php $this->load->helper("global_functions_helper") ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "Travelopolis | ".$titulo ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- FavIcon -->
  <link rel="icon" href="<?php echo base_url("assets/images/logo.png")?>" sizes="16x16" type="image/gif">
  <!-- Bootstrap 3.3.7 -->
  <!-- Bootstrap 4.0.0 -->
  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap/bootstrap-3.min.css") ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/css/fontawesome/fontawesome.package.min.css") ?>">  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets/css/main/plantilla.min.css") ?>">    
  <!-- Skins -->
  <link rel="stylesheet" href="<?php echo base_url("assets/css/main/_all-skins.min.css") ?>">  
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Ajuste -->
  <style>
    .no-margin-left {
      margin-left: 0px !important;
      padding-left: 1% !important;
    }
  </style>
</head>
<body class="hold-transition skin-blue-light sidebar-mini sidebar-collapse">
<div class="wrapper">
  <div class="row">       
      <div class="col-xs-1" style="margin-top: 1%">
        <img class="img-fluid" style="width: 100px; height: 100px;" src="<?php echo base_url("assets/images/logo.png")?>" alt="Insertar Imagen Aqui">
      </div>      
      <div class="col-xs-6">
        <h1 style="margin-bottom: 0; "><img src="<?php echo base_url("assets/images/banner_2.png")?>" alt="Travelopolis"></h1>
        <h5 style="margin-top: -3%; margin-left: 5%;" class="text-primary">La capital del viaje</h5>
      </div>
    </div>
  <header class="main-header">    
    <?php if ($this->session->userdata("login") != null): ?>
      <a href="<?php echo base_url() ?>" class="logo">      
        <span class="logo-mini"><b>TVL</b></span>      
        <span class="logo-lg"><b>Travelopolis</b></span>
      </a>    
    <?php endif; ?>
    <nav class="navbar navbar-static-top">
      <?php if ($this->session->userdata("login") != null): ?>             
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            &nbsp;<i class="fas fa-bars"></i>
            <span class="sr-only">Conmutar navegacion</span>
          </a>          
      <?php endif; ?>      
      <ul class="nav navbar-nav">        
        <li id="inicio-link" class="nav-item pull-left" style="color: white;">
          <a class="nav-link" href="<?php echo base_url() ?>">              
            Inicio
          </a>
        </li>          
        <li id="ingresar-link" class="nav-item pull-left" style="color: white;">
          <a class="nav-link" href="<?php echo base_url('inicio/ingresar') ?>">
            Ingresar
          </a>            
        </li>
      </ul>      
    </nav>
  </header> 
  <?php if ($this->session->userdata("login") != null): ?>
    <aside class="main-sidebar" style="margin-top: 8.5%;">    
      <section class="sidebar">      
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url('assets/images/logo45x45.png') ?>" class="rounded-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo "Carlos Gaxiola" ?></p>  
            <span><?php echo "Administrador" ?></span>        
          </div>
        </div>        
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Menu</li>
          <?php imprimirModulos($modulos) ?>
        </ul>
      </section>    
    </aside>
  <?php endif; ?>  