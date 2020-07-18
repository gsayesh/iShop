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
        <a  href="#"> <i class="fa fa-tachometer" aria-hidden="true"> </i><p>Overview</p></a>
      </li>
      <li>
        <a  href="<?=base_url('Stock_Actions/new_item'); ?>"><i class="fa fa-file-text" aria-hidden="true"> </i><p>Add Product</p></a>
      </li>
      <li>
       <a class="active" href="<?=base_url('Stock_Actions/all_item_view'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"> </i><p>View Product</p></a>
      </li>
      <li>
      <a href="<?=base_url('Stock_Actions/item_stock_add'); ?>"><i class="fa fa-area-chart" aria-hidden="true"> </i><p>Add Stocks</p></a>
      <li>
      <a href="<?=base_url('Stock_Actions/all_stock_view'); ?>"><i class="fa fa-users" aria-hidden="true"> </i><p>View Stocks</p></a>
      </li>
      <li>
      	<hr>
      <li>
      <li>
        <a href="<?=base_url('Stock_Actions/orders_pending'); ?>"><i class="fa fa-cogs" aria-hidden="true"> </i><p>Orders</p></a>
      </li>
      <li>
      	<a href="<?=base_url('Stock_Actions/profile_stk'); ?>"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
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
            <h2>Update Product</h2>
            <!-- <p class="subtitle">Sales Performance for the Month</p> -->
          </div>
          <div class="content">
            <?php echo '<label style="color: green">'.$this->session->flashdata("update_success").'</label>'; ?>
            <?php foreach($result as $res) : ?>
            <form action="<?= base_url('Stock_Actions/edited_item/'.$res->item_code) ?>" method="POST">
              <div class="form-group">
                <label for="lastitemcode">Item Code</label>
                <input type="text" class="form-control" name="itemcode" value="<?= $res->item_code ?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="itemname">Name</label>
                <input type="text" class="form-control" name="itemname" value="<?= $res->item_name ?>">
              </div>
              <div class="form-group">
                <label for="itemdesc">Description</label>
                <textarea class="form-control" name="itemdesc"  rows="3"><?= $res->item_description ?></textarea>
              </div>
              <div class="form-group">
                <label for="itemcost">Cost</label>
                <input type="text" class="form-control" name="itemcost" value="<?= $res->cost ?>">
              </div>
              <div class="form-group">
                <label for="itemwsprice">Whole Sale Price</label>
                <input type="text" class="form-control" name="itemwsprice" value="<?= $res->whole_sale_price ?>">
              </div>
              <div class="form-group">
                <label for="itemrprice">Retail Price</label>
                <input type="text" class="form-control" name="itemrprice" value="<?= $res->retail_price ?>">
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
