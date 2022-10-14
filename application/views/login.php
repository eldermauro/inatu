<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=MS_SITE?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?=MS_DESCRIPTION?>" name="description" />
        <meta content="<?=MS_AUTHOR?>" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.ico')?>">
        <!-- preloader css -->
        <link rel="stylesheet" href="<?=base_url('assets/css/preloader.min.css')?>" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="<?=base_url('assets/css/bootstrap.min.css')?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=base_url('assets/css/icons.min.css')?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=base_url('assets/css/app.min.css')?>" id="app-style" rel="stylesheet" type="text/css" />
    </head>  
    <body data-topbar="dark"> 
        <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0"> 
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
                    <!-- end col -->
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-50">
                                    <div class="mb-4 mb-md-4 text-center">
                                        <span class="d-block auth-logo">
                                            <img src="<?=base_url('assets/images/logo.png')?>" alt="">
                                        </span>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <?=validation_errors();?>
                                        <form method="POST" class="mt-4 pt-2" action="<?=base_url('login/token?='.base64_encode(date('Ydmhis')))?>">
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input value="<?=set_value('MSLoginAP')?>" name="MSLoginAP" type="text" class="form-control" id="MSLoginAP" placeholder="seu usuário" required >
                                                <label for="input-username">Usuário / Username</label>
                                                <div class="form-floating-icon">
                                                   <i data-feather="users"></i>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                <input name="MSSenhaAP" type="password" class="form-control pe-5" id="MSSenhaAP" placeholder="sua senha" required >
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                                <label for="input-password">Senha / Password</label>
                                                <div class="form-floating-icon">
                                                    <i data-feather="lock"></i>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col">
                                                    <div class="form-check font-size-15">
                                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                                        <label class="form-check-label font-size-13" for="remember-check">
                                                            Lembrar acesso
                                                        </label>
                                                    </div>  
                                                </div>
                                                
                                                <div class="col">
                                                    <div class="form-check font-size-15">
                                                         <a href="<?=base_url('recuperar')?>" class="text-primary fw-semibold"> 
                                                            Esqueci a senha.
                                                        </a>
                                                    </div>  
                                                </div>
                                                
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-outline-success w-100 waves-effect waves-light" type="submit">
                                                    Login
                                                </button>
                                            </div>
                                        </form> 

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Ainda não possui usuário? 
                                                <a href="<?=base_url('conta')?>" class="text-primary fw-semibold"> 
                                                    Criar conta
                                                </a> 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> <?=MS_SITE?>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div> 
        <!-- JAVASCRIPT -->
        <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
        <script src="<?=base_url('assets/js/metisMenu.min.js')?>"></script>
        <script src="<?=base_url('assets/js/simplebar.min.js')?>"></script>
        <script src="<?=base_url('assets/js/waves.min.js')?>"></script>
        <script src="<?=base_url('assets/js/feather.min.js')?>"></script>
        <!-- pace js -->
        <script src="<?=base_url('assets/js/pace.min.js')?>"></script>
        <script src="<?=base_url('assets/js/pass-addon.init.js')?>"></script>
        <script src="<?=base_url('assets/js/feather-icon.init.js')?>"></script>
    </body>
</html>
