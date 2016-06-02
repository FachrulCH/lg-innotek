<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LG: innotek</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?= base_url('assets/plugins/fontawesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?= base_url('assets/plugins/ionicons/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url('assets/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/dist/css/skins/skin-red.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/gaya.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.1.3 -->
        <script src="<?= base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="<?= base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>    
        <!-- FastClick -->
        <script src='<?= base_url('assets/plugins/fastclick/fastclick.min.js'); ?>'></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets/dist/js/app.min.js'); ?>" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?= base_url('assets/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script type="text/javascript">
            BASE_URL = "<?= base_url(); ?>";
            function loading_on() {
                $('#modal-loading').modal('show');
            }

            function loading_off() {
                setTimeout(function () {
                    $('#modal-loading').modal('hide');
                }, 500);
            }
        </script>
    </head>
    <body class="skin-red fixed">

        <div class="modal" style="display: none" id="modal-loading">
            <div class="center">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                <h3>Mohon tunggu...</h3>
            </div>
        </div>

        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= base_url(); ?>" class="logo"><img src="<?= base_url('assets/img/logo-innotek.png'); ?>" alt="Lg:innotek"/></a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <i id="motto">Inside your life!</i>
                    <?php $this->view('design/rightmenu'); ?>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->view('design/leftmenu'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Selamat datang <?= $this->session->username; ?>!
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Info boxes -->