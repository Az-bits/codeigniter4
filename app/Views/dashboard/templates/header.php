<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url()?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/dashboard/css/style.custom.css">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= base_url()?>">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url()?>"><?= lang('Form.home')?> <span class="sr-only"></span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
          CRUD
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url()?>/movie"><i class="fa fa-play"></i> Películas</a>
          <a class="dropdown-item" href="<?= base_url()?>/category"><i class="fa fa-list"></i> Categorías</a>
          <a class="dropdown-item" href="<?= base_url()?>/client"><i class="fa fa-user"></i> Usuario</a>

          
          
        </div>
      </li>
     
    </ul>
    <ul class="navbar-nav">
      
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
          Usuario
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <!-- <a class="dropdown-item" href="<?= base_url()?>/logout"><i class="fas fa-times-circle"></i> Cerrar Sección</a> -->
          <form action="<?= base_url()?>/logout" method="POST" class="dropdown-item">
            <button class="btn btn-link btn-sm" type="submit"><i class="fas fa-times-circle"></i> Cerrar Sección</button>
          </form>
        </div>
      </li>
     
    </ul>

  </div>
</nav>
    <h1 class="text-center mb-3 mt-3"><?= $title ?></h1>
    <div class="container"> 
      <hr>
           <?= view("dashboard/partials/_session")?>