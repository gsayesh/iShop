<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>IoT-Shop Management Information System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">

</head>
<body>

<body>
  <div class="sidebar">
    <div class="logo">
      <p>IoT Logo</p>
    </div>
    <nav>
      <a  href="#"> <i class="fa fa-tachometer" aria-hidden="true"> </i><p>Overview</p></a>
      <a href="#"><i class="fa fa-file-text" aria-hidden="true"> </i><p>Bill</p></a>
      <a href="#"><i class="fa fa-handshake-o" aria-hidden="true"> </i><p>Customers</p></a>
      <a class="active" href="#"><i class="fa fa-area-chart" aria-hidden="true"> </i><p>Stocks</p></a>
      <a href="#"><i class="fa fa-users" aria-hidden="true"> </i><p>Creditors</p></a>

        <!-- <p>Stock</p></a> -->
        <hr/>
        <a href="#"><i class="fa fa-cogs" aria-hidden="true"> </i><p>Settings</p></a>
        <a href="#"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
                  <!-- User Accounts // Add , remove user in this module -->
        <a href="<?= base_url().'Auth/logout'?>"><i class="fa fa-sign-out" aria-hidden="true"> </i><p>Log Out</p></a>
    </nav>
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

  <div class="main-panel">
    <div class="header">
      <p>Welcome back, Stock Manager Name</p>
    </div>
    <div class="main-panel-content">
      <!-- <div class="summary-container">


      </div> -->
      <div class="container">
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
                <label for="lastitemcode">Last Item Code</label>
                <?php foreach($result as $res) : ?>
                <input type="text" class="form-control" name="itemcode" value="<?= $res->item_code ?>" disabled="disabled">
              <?php endforeach; ?>
              </div>
              <div class="form-group">
                <label for="itemcode">New Item Code</label>
                <input type="text" class="form-control" name="itemcode" placeholder="PR00000">
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
    <div class="footer">&copy; 2020 Group 7 | University of Ruhuna</div>
  </div>
</body>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js'></script>
  <script  src="<?php echo base_url('public/assets/js/script.js'); ?>"></script>
  <script type="text/javascript">
          setInterval(function(){
          var dt = new Date();

          //print the current date   
          var weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
          var months    = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
          var day = weekdays[dt.getDay()];
          var month = months[dt.getMonth()];
          document.getElementById("dt").innerHTML = (("0"+dt.getDate()).slice(-2)) +" "+ month + ", "+ day;

          //print the current time  
          var amOrPm = (dt.getHours() < 12) ? "AM" : "PM";
          var hour = (dt.getHours() <= 12) ? dt.getHours() : dt.getHours() - 12;
          document.getElementById("tm").innerHTML = hour + ':' + ("0"+dt.getMinutes()).slice(-2);
          document.getElementById("apm").innerHTML = amOrPm;
          }, 1000);
  </script>
</body>
</html>
