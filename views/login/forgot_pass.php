<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Portal - Esqueci a senha</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=url('assets/portal/favicon.ico')?>">
    <link rel="icon" href="<?=url('assets/portal/favicon.ico')?>" type="image/x-icon">

    <!-- Custom CSS -->
    <link href="<?=url('assets/portal/dist/css/style.css')?>" rel="stylesheet" type="text/css">
</head>

<body>


<div class="hk-wrapper">
    <?php get_flash(); ?>
    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <header class="d-flex justify-content-end align-items-center">
            <div class="btn-group btn-group-sm">
                <a href="https://api.whatsapp.com/send?phone=553491739934&text=Preciso%20de%20ajuda!" target="_blank" class="btn btn-outline-secondary">Preciso de Ajuda</a>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 pa-0">
                    <div class="auth-form-wrap pt-xl-0 pt-70">
                        <div class="auth-form w-xl-30 w-sm-50 w-100">
                            <a class="font-24 font-weight-500 auth-brand text-center d-block mb-20" href="#">
                                DescomplicaZap
                            </a>
                            <form action="<?=BASE_URL?>login/forgotAction" method="POST">
                                <h1 class="display-5 mb-10 text-center">Precisa de ajuda com sua Senha?</h1>
                                <p class="mb-30 text-center">Digite seu e-mail para recuperar sua senha.</p>
                                <div class="form-group">
                                    <input class="form-control" name="email" placeholder="Digite seu e-mail" type="email">
                                </div>
                                <button class="btn btn-danger btn-block mb-20" type="submit">Enviar</button>
                                <p class="text-right"><a href="<?=url('login')?>">Voltar para Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

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

<!-- Switchery JavaScript -->
<script src="<?=url('assets/portal/vendors/switchery/dist/switchery.min.js')?>"></script>

<!-- FeatherIcons JavaScript -->
<script src="<?=url('assets/portal/dist/js/feather.min.js')?>"></script>

<!-- Tablesaw JavaScript -->
<script src="<?=url('assets/portal/vendors/tablesaw/dist/tablesaw.jquery.js')?>"></script>
<script src="<?=url('assets/portal/dist/js/tablesaw-data.js')?>"></script>

<!-- Init JavaScript -->
<script src="<?=url('assets/portal/dist/js/init.js')?>"></script>
</body>

</html>
