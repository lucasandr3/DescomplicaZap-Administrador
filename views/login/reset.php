<!DOCTYPE html>
<html lang="pt_BR">

<head><meta charset="euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Portal - Nova Senha</title>
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
        <header class="d-flex justify-content-end align-items-center">
            <div class="btn-group btn-group-sm">
                <a href="https://api.whatsapp.com/send?phone=553491739934&text=Preciso%20de%20ajuda!" target="_blank" class="btn btn-outline-secondary">Preciso de ajuda</a>
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
                            <form action="<?=url('login/newPassAction')?>" method="POST">
                                <h1 class="display-5 mb-30 text-center">Crie uma nova senha</h1>
                                <div class="form-group">
                                    <input class="form-control" name="password" id="r-pass" placeholder="Digite a senha" type="password">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" onkeyup="verifyPass(this.value)" placeholder="Confirme a senha" type="password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <p id="feedback-reset" style="margin-bottom: 15px;padding: 10px;border-radius: 3px;"></p>
                                <input class="sr-only" type="text" name="id_user" value="<?=$_SESSION['id_user_reset'];?>">
                                <button class="btn btn-danger btn-block mb-20" type="submit">Criar nova Senha</button>
                                <p class="text-right"><a href="<?=url('')?>">Voltar para login</a></p>
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

<!-- FeatherIcons JavaScript -->
<script src="<?=url('assets/portal/dist/js/feather.min.js')?>"></script>

<!-- Init JavaScript -->
<script src="<?=url('assets/portal/dist/js/init.js')?>"></script>

<script>
    function verifyPass(pass) {

        let confirm = document.querySelector('#r-pass').value;
        let feedback = document.querySelector('#feedback-reset');
        let btn = document.querySelector('#btn-sub');
        console.log(confirm)
        if (pass === confirm) {
            //feedback.classList.add('text-success', 'alert-success');
            feedback.style.display = 'none';
            btn.removeAttribute('disabled');
        } else {
            feedback.style.display = 'block';
            feedback.innerHTML = 'As Senhas não Conferem.';
            feedback.classList.add('text-danger', 'alert-danger');
            btn.setAttribute('disabled', true);
        }

    }
    if (localStorage.getItem('theme-mode')) {
        let themeMode = localStorage.getItem('theme-mode');
        document.querySelector('body').classList.add(themeMode);
    }
</script>
</body>

</html>
