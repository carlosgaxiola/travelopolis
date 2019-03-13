<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo "Travelopolis | ".$titulo ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- FavIcon -->
    <link rel="icon" href="<?php echo base_url("assets/images/logo.png")?>" sizes="16x16" type="image/gif">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/fontawesome.package.min.css") ?>">  
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/AdminLTE.min.css") ?>">    
    <!-- Skins -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/_all-skins.min.css") ?>">  
    <!-- Bootstrap 3.3.7 -->    
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-3.min.css") ?>">    
    <!-- BootstrapDialog -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-dialog.min.css") ?>">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/formulario.css") ?>">
    <!-- Google Font -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->      
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
        <?php $this->load->view("Global/navbar") ?>
    </header> 
    <?php if ($this->session->userdata("login") != null): ?>
        <?php $this->load->view("Global/aside", array("idModuloActual" => isset($idModuloActual)? $idModuloActual: 0)) ?>        
    <?php endif; ?>  