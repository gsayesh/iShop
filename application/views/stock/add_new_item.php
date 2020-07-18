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
        <a class="active"  href="<?=base_url('Stock_Actions/new_item'); ?>"><i class="fa fa-file-text" aria-hidden="true"> </i><p>Add Product</p></a>
      </li>
      <li>
       <a href="<?=base_url('Stock_Actions/all_item_view'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"> </i><p>View Product</p></a>
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
            <h2>New Product</h2>
            <!-- <p class="subtitle">Sales Performance for the Month</p> -->
          </div>
          <div class="content">
            <?php echo validation_errors('<p style="color:red">') ?>
            <?php echo '<label style="color: green">'.$this->session->flashdata("submit_success").'</label>'; ?>
            <form action="<?= base_url('Stock_Actions/new_item_add') ?>" method="POST"> 
              <div class="form-group">
                <label for="category">Item Category</label>
                <select class="form-control" id="category">
                  <option>Select Category</option>
                  <option>mobile</option>
                  <option>computer</option>
                </select>

              <div class="form-group">


              <?php  

                $type = $results['type'];
                $num = $results['code'];

                $code = "";

                if ($type == "mobile") {

                  if ($num>=100) {
                    $code = "PRMB".$num;
                  }
                  elseif ($num>=10) {
                    $code = "PRMB0".$num;
                  }
                  elseif ($num<10) {
                    $code = "PRMB00".$num;
                  }

                }
                elseif ($type == "computer") {

                  if ($num>=100) {
                    $code = "PRCM".$num;
                  }
                  elseif ($num>=10) {
                    $code = "PRCM0".$num;
                  }
                  elseif ($num<10) {
                    $code = "PRCM00".$num;
                  }

                }

                ?>
                            
                <label for="itemcode">Item Code</label>
                <input type="text" class="form-control" name="itemcode" value="<?= $code; ?>" readonly="true">
                <input type="hidden" class="form-control" name="cat" value="<?= $type; ?>" readonly="true">
                <input type="hidden" name="action" value="generate_qrcode">
              </div>


              <div class="form-group">
                <label for="itemname">Name</label>
                <input type="text" class="form-control" name="itemname" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="itemdesc">Description</label>
                <textarea class="form-control" name="itemdesc" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="itemcost">Cost</label>
                <input type="text" class="form-control" name="itemcost" placeholder="0000.00">
              </div>
              <div class="form-group">
                <label for="itemwsprice">Whole Sale Price</label>
                <input type="text" class="form-control" name="itemwsprice" placeholder="0000.00">
              </div>
              <div class="form-group">
                <label for="itemrprice">Retail Price</label>
                <input type="text" class="form-control" name="itemrprice" placeholder="0000.00">
              </div>
              <button type="submit" class="btn btn-warning">Create</button>

            </form>
          </div>
        </div>

      </div>
    	
    </div>
  </div>
</div>
</body>
<script>
      $(document).ready(function(){

      $("#category").change(function(){

              var selectedStore = $(this).children("option:selected").val();
              alert("You are going to search product in " + selectedStore);

              load_data(selectedStore);

          });

      });


       function load_data(data)
       {

          var type = $('#category').val();

          window.location.href = "<?php echo base_url('Stock_Actions/new_item');?>?type="+type;

       }

</script>
</html>
