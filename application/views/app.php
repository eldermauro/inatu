<!doctype html>
<html lang="en">
    <head> 
        <meta charset="utf-8" />
        <title><?= MS_SITE ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?=MS_DESCRIPTION?>" name="description" />
        <meta content="<?=MS_AUTHOR?>" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">
        <!-- preloader css -->
        <link rel="stylesheet" href="<?= base_url('assets/css/preloader.min.css') ?>" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/choices.min.css') ?>" type="text/css" />
        <link href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url('assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <?php
        $this->load->library('menu_lib');
        $menu = new Menu_lib;
        $menu->perfil = $this->session->userdata('WMS_CD_TIPO'); 
        ?>
    </head>
    <body id="body" data-layout="horizontal" data-topbar="">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="<?= base_url('main') ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="" height="54">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="" height="54">  
                                </span>
                            </a>

                            <a href="<?= base_url('main') ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url('assets/images/logow.png') ?>" alt="" height="54">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url('assets/images/logow.png') ?>" alt="" height="54">
                                </span>
                            </a>
                        </div>  
                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button> 
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="filter" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                 aria-labelledby="page-header-search-dropdown"> 
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <label class="d-sm-block">Proprietário</label>
                                        <select class="form-control">
                                            <option>Selecione o Produtor</option>
                                        </select>
                                    </div>

                                    <div class="form-group m-0">
                                        <label class="d-sm-block">Propriedade</label>
                                        <div class="input-group">
                                            <select class="form-control">
                                                <option>Selecione a propriedade</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group m-0">
                                        <button class="btn btn-outline-success btn-sm-block" type="submit">
                                            <i data-feather="filter" class="icon-lg"></i>
                                            Filtrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block d-none">
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i data-feather="settings" class="icon-lg"></i>
                            </button>
                        </div> 
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?= base_url('assets/images/user.png') ?>"
                                     alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">
                                    <?= $this->session->userdata('WMS_NM_PESSOA') ?><br>
                                    <?= $this->session->userdata('WMS_CD_PESSOA') ?>
                                </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="<?= base_url('profile') ?>"> 
                                    Meu Perfil
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/password') ?>"> 
                                    Mudar Senha
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('login/logout') ?>"> 
                                    Sair
                                </a>
                            </div>
                        </div>





                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </header>

            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="<?= base_url('main') ?>" id="topnav-dashboard" role="button">
                                        <i data-feather="home"></i>
                                        <span data-key="t-dashboard">Dashboard</span>
                                    </a>
                                </li>

                                <?php echo $menu->perfil(); ?>

                                <li class="nav-item dropdown d-none">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                        <i data-feather="file-text"></i><span data-key="t-extra-pages">Extra Pages</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-more">

                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                                                <span data-key="t-authentication">Authentication</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                                <a href="auth-login.html" class="dropdown-item" data-key="t-login">Login</a> 
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility" role="button">
                                                <span data-key="t-utility">Utility</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                                <a href="pages-starter.html" class="dropdown-item" data-key="t-starter-page">Starter Page</a> 
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- main-->
                        <?= $contents ?>
                        <!-- end main--> 
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content --> 
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> - <?=MS_SITE?>.</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block d-none">

                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper --> 

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->

        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/metisMenu.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/simplebar.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/waves.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/feather.min.js') ?>"></script>
        <!-- pace js -->
        <script src="<?= base_url('assets/js/pace.min.js') ?>"></script> 
        <script src="<?= base_url('assets/js/sweetalert2.min.js') ?>"></script>  
        <script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js') ?>"></script>

        <!-- Plugins js-->
        <script src="<?= base_url('assets/js/choices.min.js') ?>"></script> 
        <script src="<?= base_url('assets/js/app.js') ?>"></script>  
    </body>
</html>
