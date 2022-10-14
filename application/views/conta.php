<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?= MS_SITE ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?= MS_DESCRIPTION ?>" name="description" />
        <meta content="<?= MS_AUTHOR ?>" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">
        <!-- preloader css -->
        <link rel="stylesheet" href="<?= base_url('assets/css/preloader.min.css') ?>" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url('assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />
    </head>  
    <body data-topbar="dark"> 
        <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0"> 
                    <!-- end col -->
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-50">
                                    <div class="mb-4 mb-md-4 text-center">
                                        <span class="d-block auth-logo">
                                            <img src="<?= base_url('assets/images/logo.png') ?>" alt="">
                                        </span>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <?= validation_errors(); ?>
                                        <div class="text-center">
                                            <h5 class="mb-0">Crie sua conta no INATU</h5>
                                            <p class="text-muted mt-2">e veja como é fácil gerenciar sua usina.</p>
                                        </div>
                                        <form method="POST" class="needs-validation mt-4 pt-2" novalidate action="<?= base_url('conta/token/') ?>">

                                            <div class="form-floating form-floating-custom mb-4">
                                                <input name="INTDoc" type="number" class="form-control" id="input-documents" placeholder="000000000000" required>
                                                <div class="invalid-feedback">
                                                    Entre com um email válido.
                                                </div> 
                                                <label for="input-documents">CNPJ <small>(* somente números)</small></label>
                                                <div class="form-floating-icon">
                                                    <i data-feather="users"></i>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-custom mb-4">
                                                <input name="INTName" type="text" class="form-control" id="input-username" placeholder="Enter User Name" required>
                                                <div class="invalid-feedback">
                                                    Informe a Razão Social.
                                                </div> 
                                                <label for="input-username">Razão Social</label>
                                                <div class="form-floating-icon">
                                                    <i data-feather="users"></i>
                                                </div>
                                            </div>
                                            
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input name="INTEmail" type="email" class="form-control" id="input-email" placeholder="Enter Email" required>
                                                <div class="invalid-feedback">
                                                    Entre com um email válido.
                                                </div> 
                                                <label for="input-email">Email</label>
                                                <div class="form-floating-icon">
                                                    <i data-feather="mail"></i>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-custom mb-4">
                                                <input name="INTPas" type="password" class="form-control" id="input-password" placeholder="Enter Password" required>
                                                <div class="invalid-feedback">
                                                    Digite uma senha.
                                                </div> 
                                                <label for="input-password">Senha</label>
                                                <div class="form-floating-icon">
                                                    <i data-feather="lock"></i>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <p class="mb-0">
                                                    Saiba como funciona nosso
                                                    <a href="#" class="text-primary">Termos de Uso</a>
                                                </p>
                                            </div>
                                            <div class="mb-3">
                                                <button 
                                                    class="btn btn-primary w-100 waves-effect waves-light" 
                                                    type="submit">
                                                    Registrar
                                                </button>
                                            </div>
                                        </form> 

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Já possuo uma conta INATU ? 
                                                <a href="<?= base_url() ?>" class="text-primary fw-semibold"> 
                                                    Login 
                                                </a> 
                                            </p>
                                        </div>
                                        <div class="mt-4 mt-md-5 text-center">
                                            <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> <?= MS_SITE ?>.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end auth full page content -->
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg pt-md-5 p-4 d-flex">
                            <div class="bg-overlay"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center align-items-end">
                                <div class="col-xl-7">
                                    <div class="p-0 p-sm-4 px-xl-0">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end row -->
                </div>
                <!-- end container fluid -->
            </div> 
            <!-- JAVASCRIPT -->
            <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/metisMenu.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/simplebar.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/waves.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/feather.min.js') ?>"></script>
            <!-- pace js -->

            <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/pass-addon.init.js') ?>"></script>
            <script src="<?= base_url('assets/js/feather-icon.init.js') ?>"></script>
    </body>
</html>