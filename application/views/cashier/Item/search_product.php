<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>IoT-Shop Management Information System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?= base_url('assest/css/style.css'); ?>">

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

<body>
  <div class="sidebar">
    <div class="logo">
      <p>IoT Logo</p>
    </div>
    <nav>
      <a class="#" href="#"> <i class="fa fa-tachometer" aria-hidden="true"> </i><p>Overview</p></a>
      <a href="#"><i class="fa fa-file-text" aria-hidden="true"> </i><p>Bill</p></a>
      <a href="#"><i class="fa fa-handshake-o" aria-hidden="true"> </i><p>Customers</p></a>
      <a href="#" class="active"><i class="fa fa-area-chart" aria-hidden="true"> </i><p>Stocks</p></a>
      <a href="#"><i class="fa fa-users" aria-hidden="true"> </i><p>Creditors</p></a>

        <!-- <p>Stock</p></a> -->
        <hr/>
        <a href="#"><i class="fa fa-cogs" aria-hidden="true"> </i><p>Settings</p></a>
        <a href="#"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
                  <!-- User Accounts // Add , remove user in this module -->
        <a href="#"><i class="fa fa-sign-out" aria-hidden="true"> </i><p>Log Out</p></a>
    </nav>
    <div class="side-info">
      <div class="date">
        <p>10 Feb, Monday</p>
      </div>
      <div class="time-container">
        <div class="time">
          <p>8:00</p>
          <p>pm</p>
        </div>
      </div>
    </div>
  </div>

  <div class="main-panel">
    <div class="header">
      <p>Welcome back, Cashier Name - Here are the reports...</p>
    </div>
    <div class="main-panel-content">
      <!-- <div class="summary-container">


      </div> -->
      <div class="container">
        <div class="card" id="sales-summary">
          <div class="title">
<!--             <h2>Search in shop</h2>
            <p class="subtitle"> </p>
            <input type="text" class="text_box_control" name="" value="skdjvjsdl">
            <input type="submit" name="" value="Search" style="button glass green-a"> -->
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
    <div class="footer">&copy; 2020 Group 7 | University of Ruhuna</div>
  </div>
</body>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js'></script><script  src="./script.js"></script>

</body>
</html>
