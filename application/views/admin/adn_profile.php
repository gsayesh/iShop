<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>iShop</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
          <a href="#"><i class="fa fa-sitemap" aria-hidden="true"> </i><p>Branches</p></a>
      </li>
      <li>
            <a href="#"><i class="fa fa-truck" aria-hidden="true"> </i><p>Suppliers</p></a>
      </li>
      <li>
          <a href="#"><i class="fa fa-users" aria-hidden="true"> </i><p>Users</p></a>
      </li>
      
      <li>
        <hr>

      <li>
        <a href="#"><i class="fa fa-cogs" aria-hidden="true"> </i><p>Settings</p></a>
      </li>
      <li>
      <li>
      	<a class="active" href="<?=base_url('Common/profile_adn'); ?>"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
      </li>
      <li>
<a href="<?= base_url().'Auth/logout'?>"><i class="fa fa-sign-out" aria-hidden="true"> </i><p>Log Out</p></a>
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
            <h2>Profile</h2>
            <!-- <p class="subtitle">Sales Performance for the Month</p> -->
          </div>
          <div class="content">
            <?php echo '<label style="color: green">'.$this->session->flashdata("password_success").'</label>'; ?>
            <?php echo '<label style="color: red">'.$this->session->flashdata("password_fail").'</label>'; ?>
            <?php echo '<label style="color: green">'.$this->session->flashdata("update_success").'</label>'; ?>
            <?php foreach($result as $res) : ?>
            <form action="<?= base_url('Common/adn_edited_profile/'.$res->user_id) ?>" method="POST">
              <div class="form-group">
                <label for="userid">User ID</label>
                <input type="text" class="form-control" name="userid" value="<?= $res->user_id ?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" name="position" value="<?= $res->position ?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="userfname">First Name</label>
                <input type="text" class="form-control" name="userfname" value="<?= $res->first_name ?>" >
              </div>
              
              <div class="form-group">
                <label for="userlname">Last Name</label>
                <input type="text" class="form-control" name="userlname" value="<?= $res->last_name ?>">
              </div>
              <div class="form-group">
                <label for="usernic">NIC</label>
                <input type="text" class="form-control" name="usernic" value="<?= $res->nic ?>">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address"  rows="3"><?= $res->address ?></textarea>
              </div>
              <div class="form-group">
                <label for="gender">Gender</label><br>
                  <input type="radio" name="gender"  value="male" <?php if($res->gender=='male') {echo "checked";}?> > Male
                  <input type="radio" name="gender" value="female" <?php if($res->gender=='female') {echo "checked";}?> > Female
              </div>
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" value="<?= $res->email ?>">
              </div>
              <div class="form-group">
                <label for="telno">Contact No</label>
                <input type="text" class="form-control" name="telno" value="<?= $res->contact_no ?>">
              </div>
              <div class="form-group">
                <label for="pass">New Password</label>
                <input type="text" class="form-control" name="pass" >
              </div>
              <div class="form-group">
                <label for="cpass">Confirm Password</label>
                <input type="text" class="form-control" name="cpass" >
              </div>
              <?php endforeach; ?>
              <button type="submit" class="btn btn-warning">Update</button>
            </form>
          </div>
        </div>

      </div>
    	
    </div>
  </div>
</div>
</body>
</html>
