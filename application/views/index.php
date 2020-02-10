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
          <a class="navbar-brand" href="#">IoT-Shop</a>
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
                      <li><a href="#"><span class="fa fa-power-off"></span>Logout</a></li>
                  </ul>
              </li>

          </ul>
      </div>
  </nav>

  <aside id="side-menu" class="aside" role="navigation">
        <ul class="nav nav-list accordion">
          <li class="nav-header">
            <div class="link"><i class="fa fa-lg fa-globe"></i>Admin-Panel<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Settings</a></li>
              <li><a href="#">Administration</a></li>
            </ul>
          </li>

          <li class="nav-header">
            <div class="link"><i class="fa fa-lg fa-users"></i>Customers<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
            </ul>
          </li>

          <li class="nav-header">
            <div class="link"><i class="fa fa-cloud"></i>Sales<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
            </ul>
          </li>

           <li class="nav-header">
            <div class="link"><i class="fa fa-lg fa-map-marker"></i>Branches<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
              	<li><a href="#">Matara</a></li>
              	<li><a href="#">Hakmana</a></li>
				<li><a href="#">Walsmulla</a></li>
            </ul>
          </li>

          <li class="nav-header">
            <div class="link"><i class="fa fa-lg fa-file-image-o"></i>Reports<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
              <li><a href="#">Entries</a></li>
              <li><a href="#">Redirects</a></li>
              <li><a href="#">Pingbacks</a></li>
              <li><a href="#">Tags</a></li>
            </ul>
          </li>

      </ul>
  </aside>

  <!--Body content-->
  <div class="content">
		<div class="top-bar">
      <a href="#menu" class="side-menu-link burger">
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>
    </div>

    <section class="content-inner">
      <h2>Group Project</h2>
      <h3>University of Ruhuna Faculty of Technology Group project</h3>
    </section>
  </div>

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
<script  src=""<?php echo base_url('public/assets/js/script.js'); ?>"></script>

</body>
</html>
