<?php
$end_pagina_inicial = base_url().'admin/pagina_inicial';
$end_lista = base_url().'admin/blog';
$end_novo = base_url().'admin/blog/novo';
$pagina_atual = base_url().uri_string();
$pagina_ativa = '';
if ($pagina_atual == $end_pagina_inicial)
  $pagina_ativa = 'Página inicial';
if ($pagina_atual == $end_lista)
  $pagina_ativa = 'Todas as postagens';
if ($pagina_atual == $end_novo)
  $pagina_ativa = 'Nova postagem';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.4/examples/dashboard/dashboard.css">

    <title><?= $pagina_ativa ?></title>
  </head>
  
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?= $end_pagina_inicial?>">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?=base_url().'admin/'?>sair">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link <?php if ($pagina_ativa == 'Página inicial') echo 'active'; ?>"
                  href="<?= $end_pagina_inicial?>">
                  <span data-feather="home"></span>
                  Página inicial
                  <?php if ($pagina_ativa == 'Página inicial') echo '<span class="sr-only">(current)</span>'; ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if ($pagina_ativa == 'Nova postagem') echo 'active'; ?>"
                  href="<?= $end_novo?>">
                  <span data-feather="file"></span>
                  Nova postagem
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if ($pagina_ativa == 'Todas as postagens') echo 'active'; ?>"
                  href="<?= $end_lista?>">
                  <span data-feather="shopping-cart"></span>
                  Todas as postagens
                </a>
              </li>
            </ul>
          </div>
        </nav>
