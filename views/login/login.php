<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Admin - Login</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=url('assets/portal/favicon.ico')?>">
    <link rel="icon" href="<?=url('assets/portal/favicon.ico')?>" type="image/x-icon">

    <!-- Custom CSS -->
    <link href="<?=url('assets/portal/dist/css/style.css')?>" rel="stylesheet" type="text/css">
</head>

<body>

<!-- HK Wrapper -->
<div class="hk-wrapper">
<?php get_flash(); ?>
    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <header class="d-flex justify-content-between align-items-center">
            <a class="d-flex font-24 font-weight-500 auth-brand" href="<?=url('')?>">
                DescomplicaZap
            </a>
            <div class="btn-group btn-group-sm">
                <a href="https://api.whatsapp.com/send?phone=553491739934&text=Preciso%20de%20ajuda!" target="_blank" class="btn btn-outline-secondary">Preciso de ajuda</a>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5 pa-0">
                    <div class="auth-cover-img overlay-wrap" style="background-image:url(<?=url('assets/portal/img/pages/login/data2.png')?>);">

                    </div>
                </div>
                <div class="col-xl-7 pa-0">
                    <div class="auth-form-wrap py-xl-0 py-50">
                        <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                            <form action="<?=url('login/signin')?>" method="POST">
                                <h1 class="display-5 mb-10">Portal do Administrador</h1>
                                <p class="mb-30">Faça login em sua conta, para genrenciar o cardápio.</p>
                                <div class="form-group">
                                    <input class="form-control" name="email_user" placeholder="Digite seu E-mail" type="email">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" name="password" placeholder="Digite sua senha" type="password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-danger btn-block mb-20" type="submit">Entrar</button>

                                <p class="text-center">Esqueceu a Senha ? <a href="<?=url('login/forgotPass')?>">Redefinir</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->

<!-- jQuery -->
<script src="<?=url('assets/portal/vendors/jquery/dist/jquery.min.js')?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=url('assets/portal/vendors/popper.js/dist/umd/popper.min.js')?>"></script>
<script src="<?=url('assets/portal/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>

<!-- Slimscroll JavaScript -->
<script src="<?=url('assets/portal/dist/js/jquery.slimscroll.js')?>"></script>

<!-- Fancy Dropdown JS -->
<script src="<?=url('assets/portal/dist/js/dropdown-bootstrap-extended.js')?>"></script>

<!-- Owl JavaScript -->
<script src="<?=url('assets/portal/vendors/owl.carousel/dist/owl.carousel.min.js')?>"></script>

<!-- FeatherIcons JavaScript -->
<script src="<?=url('assets/portal/dist/js/feather.min.js')?>"></script>

<!-- Init JavaScript -->
<script src="<?=url('assets/portal/dist/js/init.js')?>"></script>
<script src="<?=url('assets/portal/dist/js/login-data.js')?>"></script>
</body>

</html>
