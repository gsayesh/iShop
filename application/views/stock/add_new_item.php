<!DOCTYPE html>
<html lang="en" >
<head>
	<?php $userSes = $this->session->userdata('username'); ?>
	<?php $userTyp = $this->session->userdata('usertype'); ?>
  <meta charset="UTF-8">
  <title>IoT-Shop</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>  
<!-- 
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'> -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/nav-style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/chat.css'); ?>">
	<script  src="<?php echo base_url('public/assets/js/script.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/assets/scripts/jquery-3.2.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/scripts/firebase-4.2.0.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/scripts/firebase-initialize.js'); ?>"></script>

</head>
<body style="background: url('images/bg.png') no-repeat center center fixed; background-size: cover;">


<nav class="navbar navbar-expand-lg navbar-mainbg">
		<a class="navbar-brand navbar-logo" href="#">IoT-Shop</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<i class="fas fa-bars text-white"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<div class="hori-selector"><div class="left"></div><div class="right"></div></div>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/dashboard'); ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="<?=base_url('Stock_Actions/new_item'); ?>"><i class="fa fa-cube"></i>Add Product</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/all_item_view'); ?>"><i class="   fa fa-list-alt"></i>View Products</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/item_stock_add'); ?>"><i class="fa fa-cart-plus"></i>Add Stocks</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/all_stock_view'); ?>"><i class="fa fa-cubes"></i>View Stocks</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/stock_request'); ?>"><i class="   fa fa-cart-arrow-down"></i>Request</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/orders_pending'); ?>"><i class="fa fa-stack-exchange"></i>Orders</a>
				</li>
			</ul>
		</div>
	</nav>


<div id="viewport">

	<div id="sidebar">
		<p></p>
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


		<input placeholder="Enter username.." type="hidden" name="joinRoomUserNameField" id="joinRoomUserNameField" value=" <?php echo $userTyp.' '.$userSes; ?>"></input>
		<input placeholder="Enter room name.." type="hidden" name="joinRoomNameField" id="joinRoomNameField" value="IoTSHOPChat"></input>


		<div id="messageContainer" class="chat">
			<div class="chat-title">
				<!-- <h2 id="roomName"></h2> -->
				<center><h2>Group Chat</h2></center>

			</div>
			<div class="messages">
			<input type="hidden" id="username" value=" <?php echo $userTyp.' '.$userSes; ?>"></input>
			<input type="hidden" id="roomName" value="IoTSHOPChat"></input>


				<p id="username" style="display:none;"></p>
				<div class="messages-content"><table id="displayTable"></table></div>
			</div>
			<div class="action-box">
				<textarea class="action-box-input" type="text" placeholder="Type message..." name="textField" id="textField" onkeydown="sendMessage(this)"></textarea>
				<button id="sendButton" class="action-box-submit" type="submit"><i class="fa fa-paper-plane"></i></button>
			</div>
		</div>

		<ul class="nav">

			<li>
				<a href="<?=base_url('Common/profile_stk'); ?>"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
			</li>
			<li>
				<a href="<?= base_url().'Auth/logout'?>"><i class="fa fa-sign-out" aria-hidden="true"> </i><p>Log Out</p></a>
			</li>
		</ul>

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
	<div class="container-fluid my-scroll" >

		<div class="main-panel" >

		<div class="main-panel-content ">

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
					</div>
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

						}elseif ($type == "computer") {

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
</div>

<!-- partial -->
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
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>
<script  src="<?php echo base_url('public/assets/js/nav-script.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/assets/scripts/scripts.js'); ?>"></script>
<script  src="<?php echo base_url('public/assets/js/chat.js'); ?>"></script>
</body>
</html>
