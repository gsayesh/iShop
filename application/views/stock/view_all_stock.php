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
        <a href="<?=base_url('Stock_Actions/new_item'); ?>"><i class="fa fa-file-text" aria-hidden="true"> </i><p>Add Product</p></a>
      </li>
      <li>
       <a href="<?=base_url('Stock_Actions/all_item_view'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"> </i><p>View Product</p></a>
      </li>
      <li>
      <a href="<?=base_url('Stock_Actions/item_stock_add'); ?>"><i class="fa fa-area-chart" aria-hidden="true"> </i><p>Add Stocks</p></a>
      <li>
      <a class="active" href="<?=base_url('Stock_Actions/all_stock_view'); ?>"><i class="fa fa-users" aria-hidden="true"> </i><p>View Stocks</p></a>
      </li>
      <li>
      	<hr>
      <li>
      <li>
        <a href="#"><i class="fa fa-cogs" aria-hidden="true"> </i><p>Orders</p></a>
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
            <h2>All Stock</h2>
            <!-- <p class="subtitle">Sales Performance for the Month</p> -->
          </div>
          <div class="content" id="cntent">
            <div class="form-group">
              <label for="branchstk">Branch</label>
              <select class="form-control" id="branch_drop">
                <option value="main">Main Stock</option>
                <option value="branch_1">Branch 1</option>
                <option value="branch_2">Branch 2</option>
              </select>
            </div>
            <input class="form-control" type="text" name="stock_txt" id="stock_txt" placeholder="Search" >
            <div id="result"></div>
          </div>
        </div>

	    </div>
    	
    </div>
  </div>
</div>

  
</body>
<script>
  $(document).ready(function(){

   load_data();

   function load_data(query)
   {
      $.ajax({
        url:"<?php echo base_url('Stock_Actions/stock_search'); ?>",
        method:"POST",
        data:{query:query,branch:$('#branch_drop').val()},
        success:function(data){
          $('#result').html(data);
        }
      })
    }

    $('#branch_drop').on('change', function() {
        load_data();
    });

    $('#stock_txt').keyup(function(){
      var search = $(this).val();
      if(search != '')
      {
        load_data(search);
      }
      else
      {
        load_data();
      }
    });

  });


</script>
</html>
