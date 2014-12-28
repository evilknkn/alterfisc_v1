<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="Violate Responsive Admin Template">
        <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

        <title>Administratdor</title>
            
        <!-- CSS -->
        <link href="<?=base_url('assets')?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url('assets')?>/css/form.css" rel="stylesheet">
        <link href="<?=base_url('assets')?>/css/style.css" rel="stylesheet">
        <link href="<?=base_url('assets')?>/css/animate.css" rel="stylesheet">
        <link href="<?=base_url('assets')?>/css/generics.css" rel="stylesheet"> 
    </head>
    <body id="skin-tectile">
        <section id="login">
            <header>
                <h1>ALTERFIS</h1>
            </header>
        
            <div class="clearfix"></div>
            
            <!-- Login -->
            
            <?=form_open('',array('class'=>'box tile animated active'))?>
                <h2 class="m-t-0 m-b-15">Login</h2>
                <input type="text" class="login-control m-b-10" name="username" placeholder="Nombre de usuario" autocomplete="off" autofocus="true" >
                <input type="password" class="login-control m-b-10" name="password" placeholder="Contraseña" autocomplete="off" autofocus="true" >
                <?=form_error('username')?>
                <?=form_error('password')?>
                <button class="btn btn-sm m-r-5">Entrar</button>
               
            <?=form_close();?>
            
        </section>                      
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="<?=base_url('assets')?>/js/jquery.min.js"></script> <!-- jQuery Library -->
        
        <!-- Bootstrap -->
        <script src="<?=base_url('assets')?>/js/bootstrap.min.js"></script>
        
        <!--  Form Related -->
        <script src="<?=base_url('assets')?>/js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
        
        <!-- All JS functions -->
        <script src="<?=base_url('assets')?>/js/functions.js"></script>
    </body>
</html>
