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
      <p>Welcome back, <?=$this->session->userdata('username'); ?></p>
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
            <table class="table">
                <tr>
                  <th class="col">#</th>
                  <th class="col">Item Code</th>
                  <th class="col">Item Name</th>
                  <th class="col">Quantity</th>
                  <th class="col">Actions</th>
                </tr>
              <?php $i =1; foreach($result as $res) : ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?=$res->item_code?></td>
                <td><?=$res->item_name?></td>
                <td><input type="text" name="qty"></td>
                <td><input type="submit" class="btn btn-primary"></td>
              </tr>
            <?php endforeach; ?>
          </table>
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
