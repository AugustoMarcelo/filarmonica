<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Banda de Música</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
        <button class="btn btn-link btn-sm text-white" id="sidebarToggle" href="#">
            <i class="fas fa-bars fa-lg"></i>
        </button>
        <a class="navbar-brand mr-1 d-none d-lg-block" href="#">Menu</a>
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="badge badge-danger">9+</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span class="badge badge-danger">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-power-off"></i>
                        Sair
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav fixed-top">
            <li class="nav-item <?php echo htmlspecialchars( $componentesClassActive, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <a class="nav-link" href="/componentes">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Componentes</span>
                </a>
            </li>
            <li class="nav-item <?php echo htmlspecialchars( $tocatasClassActive, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <a class="nav-link" href="/tocatas">
                    <i class="fas fa-fw fa-drum"></i>
                    <span>Tocatas</span>
                </a>
            </li>
            <li class="nav-item <?php echo htmlspecialchars( $userClassActive, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <a class="nav-link" href="/users"
                    title="Aqui você pode cadastrar, alterar, pesquisar e remover usuários">
                    <i class="fas fa-user-cog"></i>
                    <span>Usuários</span>
                </a>
            </li>
        </ul>

        <div id="content-wrapper">
            <div class="container-fluid">