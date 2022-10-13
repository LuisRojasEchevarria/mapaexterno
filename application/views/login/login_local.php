<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FONDEPES | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
  <?php 
  $base_url = load_class('Config')->config['base_url']; 
  ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_url;?>assets/img/favicon.ico" />

  <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome 4.6.3. -->
  <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/plugins/ionicons/ionicons.min.css"/>
  <!-- AdminLTE estilo principal -->
  <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/AdminLTE/css/AdminLTE.min.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>FONDEPES</b></a><br>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión para acceder</p>


    <?php
    $csrf = array(
          'name' => $this->security->get_csrf_token_name(),
          'hash' => $this->security->get_csrf_hash()
          );
    ?>    
    <form action="<?php echo $base_url?>login/login" method="post">
    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
      <div class="form-group has-feedback">
        <input name="email" type="text" class="form-control" placeholder="Email" autofocus maxlength="45" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email');?>
      </div>
      <div class="form-group has-feedback">
        <input name="pass" type="password" class="form-control" placeholder="Password" maxlength="45" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('pass');?>
      </div>
      <div class="row">
        <div class="col-xs-7">
  
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar sesión</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- LIBRERIAS JS -->

<!-- jQuery -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jQuery/jquery-2.2.4.min.js"></script>
<!-- Bootstrap Core -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
   
</body>
</html>
