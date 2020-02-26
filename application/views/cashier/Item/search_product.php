<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>iShop</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">

<script  src="<?php echo base_url('public/assets/js/script.js'); ?>"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<script>
		$(document).ready(function(){

			load_data();


			$("#store").change(function(){

				var selectedStore = $(this).children("option:selected").val();
				alert("You are going to search product in " + selectedStore);

				load_data();

			});

			$('#item_code').keyup(function(){

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


		function load_data(query)
		{

			$.ajax({

				url:"<?php echo base_url(); ?>Cashier/search_product",
				method:"POST",
				data:{query:query,store:$('select#store').val()},
				success:function(data){
					$('#result').html(data);

				}

			});

		}

	</script>


</head>
<body>

<div id="viewport">

  <div id="sidebar">
    <header>
      <a href="#">iShop</a>
    </header>
    <ul class="nav">
      <li>
        <a href="#">
          <i class="fa fa-tachometer" aria-hidden="true"> </i> Dashboard
        </a>
      </li>
      <li>
        <a href="#"><i class="fa fa-file-text" aria-hidden="true"> </i><p>Bill</p></a>
      </li>
      <li>
       <a href="#"><i class="fa fa-handshake-o" aria-hidden="true"> </i><p>Customers</p></a>
      </li>
      <li>
      <a class="active" href="#"><i class="fa fa-area-chart" aria-hidden="true"> </i><p>Stocks</p></a>
      </li>
      <li>
      <a href="#"><i class="fa fa-users" aria-hidden="true"> </i><p>Creditors</p></a>
      </li>
      <li>
      	<hr>
      <li>
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
				  <h3>Product Search</h3>

				  <input type="text" name="item_code" id="item_code" placeholder="Search Items">

				  <label>Select Stock:</label>

				  <select id="store">
					  <option>My_Shop</option>
					  <option>Main_Store</option>
					  <option>Other_Branch</option>
				  </select>


				  <div id="result"></div>
	          </div>
	        </div>
	      </div>
    	
    </div>
  </div>
</div>

  
</body>
</html>
