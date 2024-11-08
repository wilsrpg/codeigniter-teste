<?php
$end_dashboard = base_url().'admin/dashboard';
$end_viewblog = base_url().'admin/blog';
$end_addblog = base_url().'admin/blog/addblog';
$pagina_atual = base_url().uri_string();
$pagina_ativa = '';
if ($pagina_atual == $end_dashboard)
  $pagina_ativa = 'Dashboard';
if ($pagina_atual == $end_viewblog)
  $pagina_ativa = 'View blog';
if ($pagina_atual == $end_addblog)
  $pagina_ativa = 'Add blog';
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
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?=base_url().'admin/'?>logout">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link <?php if ($pagina_ativa == 'Dashboard') echo 'active'; ?>"
                  href="<?= $end_dashboard?>">
                  <span data-feather="home"></span>
                  Dashboard
                  <?php if ($pagina_ativa == 'Dashboard') echo '<span class="sr-only">(current)</span>'; ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if ($pagina_ativa == 'Add blog') echo 'active'; ?>"
                  href="<?= $end_addblog?>">
                  <span data-feather="file"></span>
                  Add Blog
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if ($pagina_ativa == 'View blog') echo 'active'; ?>"
                  href="<?= $end_viewblog?>">
                  <span data-feather="shopping-cart"></span>
                  View Blog
                </a>
              </li>
            </ul>
          </div>
        </nav>
