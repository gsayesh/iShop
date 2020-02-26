<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>iShop</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">

<script  src="<?php echo base_url('public/assets/js/script.js'); ?>"></script>

</head>
<body>

<div id="viewport">

  <div id="sidebar">
    <header>
      <a href="#">iShop</a>
    </header>
    <ul class="nav">
		<li>
	        	<a href="#"> <i class="fa fa-tachometer" aria-hidden="true"> </i><p>Dashboard</p></a>
	      </li>
	      <li>
	        	<a href="#"><i class="fa fa-cart-arrow-down" aria-hidden="true"> </i><p>Products</p></a>      </li>
	      <li>
	        	<a class="active" href="#"><i class="fa fa-sitemap" aria-hidden="true"> </i><p>Branches</p></a>
	      </li>
	      <li>
	            <a href="#"><i class="fa fa-truck" aria-hidden="true"> </i><p>Suppliers</p></a>
	      </li>
	      <li>
	      		<a href="#"><i class="fa fa-users" aria-hidden="true"> </i><p>Users</p></a>
	      </li>

      
      	<hr>

      <li>
        <a href="#"><i class="fa fa-cogs" aria-hidden="true"> </i><p>Settings</p></a>
      </li>
      <li>
      	<a href="#"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
      </li>
      <li>
		<a href="#"><i class="fa fa-sign-out" aria-hidden="true"> </i><p>Log Out</p></a>
	  </li>
    </ul>



    <div class="side-info">
		<div class="date">
          <p id="dt"></p>
      	</div>
	  	<div class="time-container">
	        <div class="time">
	          <p id="tm"></p>
	          <p id="apm"></p>
	        </div>
      	</div>
    </div>
  </div>

  <div id="content">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
            </a>
          </li>

        </ul>
      </div>
    </nav>
    <div class="container-fluid">

    	<div class="main-panel">

	    <div class="main-panel-content">


	        <div class="card" id="sales-summary">
	          <div class="title">
	            <h2>Sales Summary - Feb 2020</h2>
	            <p class="subtitle">Sales Performance for the Month</p>
	          </div>
	          <div class="content">
	             <div class="row">
                  <div class="panel branches">
                    <a href="javascript:void();"><span>MT1 </span>Matara</a>
                  </div>
                  <div class="panel branches">
                    <a href="javascript:void();"><span>HK1 </span>Hakmana</a>
                  </div>
                  <div class="panel branches">
                    <a href="javascript:void();"><span>WL1 </span>Walasmulla</a>
                  </div>
                  <div class="panel branchesAdd">
                    <a href="javascript:void();"><span>+ </span>Add User</a>
                  </div>
                </div>
	          </div>
	        </div>
	      </div>
    	
    </div>
  </div>
</div>

  
</body>
</html>
