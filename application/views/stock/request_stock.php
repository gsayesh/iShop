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
				<li class="nav-item">
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
				<li class="nav-item active">
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
				<h2>Request from Supplier</h2>
				<!-- <p class="subtitle">Sales Performance for the Month</p> -->
		  	</div>
		  	<div class="content">
		  		<?php echo '<label style="color: green">'.$this->session->flashdata("email_done").'</label>'; ?>
		  		<?php echo '<label style="color: red">'.$this->session->flashdata("email_fail").'</label>'; ?>
		  		<form id="frm-send" action="<?= base_url().'Stock_Actions/stock_request_send'?>" method="POST">
		  			<div class="form-group">
                		<label for="billno">Bill Number</label>
                		<?php //foreach($bill as $billno) { ?>
                		<input type="text" class="form-control" name="billno" value="<?=$bill; ?>" readonly>
                		<?php //} ?>
              		</div>
              		<div class="form-group">
                		<label for="recname">Recipient Name</label>
                		<input type="text" class="form-control" name="recname" placeholder="John Doe" required="true">
              		</div>
              		<div class="form-group">
                		<label for="recmail">Recipient Email</label>
                		<input type="email" class="form-control" name="recmail" placeholder="jhondoe@mail.com" required="true">
              		</div>
              		<div class="form-group">
                		<label for="comname">Company Name</label>
                		<input type="text" class="form-control" name="comname" placeholder="ABC Company" required="true">
              		</div>
              		<div class="form-group">
                		<label for="sdate">Date</label>
                		<input type="datetime-local" class="form-control" name="sdate" required="true">
              		</div>
					<div class="table-responsive">    
						<table class="table" id="example" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th scope="col"></th>
			  						<th scope="col">#</th>
			  						<th scope="col">Item Code</th>
			  						<th scope="col">Item Name</th>
			  						<th scope="col">Cost</th>
			  						<th scope="col">Wholesale Price</th>
			  						<th scope="col">Retail Price</th>
			  						<th scope="col">Low Quantity</th>
			  						<th scope="col">New Quantity</th>
								</tr>
							<thead>

							<?php if($res){?>
							<?php $i=1; foreach($res as $res) : ?>
							<tr>
								<td><input name="itemch[]" value="<?=$res->item_code?>" id="itemch[]" type="checkbox" /></td>
			  					<td><?=$i++ ?></td>
			  					<td><?=$res->item_code?></td>
			  					<td><?=$res->item_name?>
			  						<input type="hidden" name="itemname_<?=$res->item_code?>" id="qtynew" value="<?=$res->item_name?>">
			  					</td>
			  					<td><?=$res->cost?></td>
			  					<td><?=$res->whole_sale_price?></td>
			  					<td><?=$res->retail_price?></td>
			  					<td><?=$res->main?></td>
			  					<td><input type="Number" name="qty_<?=$res->item_code?>" id="qtynew" min="0"></td>
							</tr>
							<?php endforeach; ?>
							<?php }else{echo "<p style='color:red;font-weight: bold;'>Not in Minimum Level to Request</p>";} ?>
						</table>
					</div>
					<!-- <button name="btn_order" id="btn_order" class="btn btn-success">Send</button> -->
					<p><button class="btn btn-success">Send</button></p>
				</form >
		  	</div>
		</div>
		</div>
		</div>
		
	</div>
  </div>
</div>

<!-- partial -->
<script>
$(document).ready(function (){   
   var table = $('#example').DataTable({
      'ajax': 'https://gyrocode.github.io/files/jquery-datatables/arrays_id.json',
      'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="id[]" value="' 
                + $('<div/>').text(data).html() + '">';
         }
      }],
      'order': [1, 'asc']
   });

   // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });
    
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all checkboxes in the table
      table.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element 
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         } 
      });

      // FOR TESTING ONLY
      
      // Output form data to a console
      $('#example-console').text($(form).serialize()); 
      console.log("Form submission", $(form).serialize()); 
       
      // Prevent actual form submission
      e.preventDefault();
   });
});
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
