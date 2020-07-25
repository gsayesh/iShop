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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
	
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
				<li class="nav-">
					<a class="nav-link" href="<?=base_url('Stock_Actions/new_item'); ?>"><i class="fa fa-cube"></i>Add Product</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/all_item_view'); ?>"><i class="   fa fa-list-alt"></i>View Products</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="<?=base_url('Stock_Actions/item_stock_add'); ?>"><i class="fa fa-cart-plus"></i>Add Stocks</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/all_stock_view'); ?>"><i class="fa fa-cubes"></i>View Stocks</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('Stock_Actions/stock_request'); ?>><i class="   fa fa-cart-arrow-down"></i>Request</a>
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
					<h2>Update Main Stock</h2>
					<!-- <p class="subtitle">Sales Performance for the Month</p> -->
		  		</div>
		  		<div class="content">
					<input class="form-control" type="text" name="supbillno" id="supbillno" placeholder="Supplier Bill No" ><br>
					<?php foreach($res as $grn) : ?>
					<input class="form-control" type="text" name="mybillno" id="mybillno" value="<?=$grn;?>" disabled>
					<?php endforeach; ?>
					<?php echo '<label style="color: green">'.$this->session->flashdata("update_success").'</label>'; ?>
					<?php echo '<label style="color: green">'.$this->session->flashdata("remove_success").'</label>'; ?><br>
					<a href="<?= base_url('Stock_Actions/item_stock_add') ?> "class="btn btn-primary">Back to Items</a>
					<hr>
					<input type="hidden" name="user" id="user" value="<?=$this->session->userdata('user_id')?>">
		  			<div class="table-responsive">
						<table class="table" id="grn_table">
							<thead>
								<tr>
			  						<th scope="col">#</th>
			  						<th scope="col">Item Code</th>
			  						<th scope="col">Item Name</th>
			  						<th scope="col">Description</th>
			  						<th scope="col">Whole Sale Price</th>
			  						<th scope="col">Retail Price</th>
			  						<th scope="col">Quantity</th>
			  						<th scope="col">Actions</th>
								</tr>
							<thead>
							<?php $i=1; foreach($result as $res) : ?>
							<tr>
			  					<td><?=$i++ ?></td>
			  					<td><?=$res->item_code?></td>
			  					<td><?=$res->item_name?></td>
			  					<td><?=$res->item_description?></td>
			  					<td><?=$res->whole_sale_price?></td>
			  					<td><?=$res->retail_price?></td>
			  					<td><input type="Number" name="qty" id="qtynew" min="0" required="true" ></td>
			  					<td>
			  						<a href="<?= base_url('Stock_Actions/temp_main_del/'.$res->item_code)?>"><i class="fa fa-times" style="color:red;font-size:150%" aria-hidden="true"></i></a>
			  					</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
					<button name="btn_data" id="btn_data" class="btn btn-success">Add All</button>
		  		</div>
			</div>

		</div>
		</div>
	</div>
		
	</div>
  </div>
</div>

<!-- partial -->
<script>
    $(function(){

     $('#btn_data').click(function(){
      var table_data = [];
      
      //get all data in the grn table
      $('#grn_table tr').each(function(row,tr){


        if ($(tr).find('td:eq(1)').text() == "") {
        }
        else{
          
          var sub = {

            'code' : $(tr).find('td:eq(1)').text(),
            'name' : $(tr).find('td:eq(2)').text(),
            'description' : $(tr).find('td:eq(3)').text(),
            'whole_sale' : $(tr).find('td:eq(4)').text(),
            'retail' : $(tr).find('td:eq(5)').text(),
            'qty' : $(tr).find('#qtynew').val()

          };

          table_data.push(sub);

        }
      }); 

      var basic_data = {
        'sbill_no' : $('#supbillno').val(),
        'mybill_no' : $('#mybillno').val(),
        'user' : $('#user').val()
      };

      /*alert($('#qtynew').val());*/
      if($('#supbillno').val() == "" || table_data.length == 0) {
        alert('Fill Supplier Bill Number and Add Items.');
      }
      else{
        $(function(){

          var data = { 'temp_table' : table_data , 'basic_data' : basic_data };
          $.ajax({

            data : data,
            type : 'POST',
            url : '<?php echo base_url('Stock_Actions/update_main_stock'); ?>',
            crossOrigin : false,
            dataType : 'json',
            success : function(result){

              if (result.status == "success") {

                swal({
                  title: "Successfully saved.",
                  text: "",
                  type: "success" },
                  function() {
                    setTimeout( function() { location.reload(); }, 0001);
                  });


              }
              else{
                swal('Error saving...','','warning');
              }

            }

          });  
        }); 
      }
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
