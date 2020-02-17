<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>IoT-Shop Management Dashboard</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">
</head>
<body>

<div class="wrap">
  <nav class="nav-bar navbar-inverse" role="navigation">
      <div id ="top-menu" class="container-fluid active">
          <a class="navbar-brand" href="#">IoT-Shop Admin</a>
          <ul class="nav navbar-nav">
              <form id="qform" class="navbar-form pull-left" role="search">
                 <input type="text" class="form-control" placeholder="Search" />
               </form>
              <li class="dropdown movable">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="fa fa-4x fa-child"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="#"><span class="fa fa-user"></span>My Profile</a></li>
                      <li><a href="#"><span class="fa fa-gear"></span>Settings</a></li>
                      <li class="divider"></li>
                      <li><a href="<?= base_url('Auth/logout') ?>"><span class="fa fa-power-off"></span>Logout</a></li>
                  </ul>
              </li>

          </ul>
      </div>
  </nav>
