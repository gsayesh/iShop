<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>IoT-Shop Management Information System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="<?= base_url('assest/css/style.css'); ?>">

</head>
<body>

<body>
  <div class="sidebar">
    <div class="logo">
      <p>IoT Logo</p>
    </div>
    <nav>
      <a class="active" href="#"> <i class="fa fa-tachometer" aria-hidden="true"> </i><p>Overview</p></a>
      <a href="#"><i class="fa fa-file-text" aria-hidden="true"> </i><p>Bill</p></a>
      <a href="#"><i class="fa fa-handshake-o" aria-hidden="true"> </i><p>Customers</p></a>
      <a href="#"><i class="fa fa-area-chart" aria-hidden="true"> </i><p>Stocks</p></a>
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
      <p>Welcome back, Admin Name - Here are the reports...</p>
    </div>
    <div class="main-panel-content">
      <!-- <div class="summary-container">


      </div> -->
      <div class="container">
        <div class="card" id="sales-summary">
          <div class="title">
            <h2>Item search</h2>
            <p class="subtitle">Select and search</p>
          </div>
          <div class="content">

          </div>
        </div>
      </div>

      <!-- Users -->
  <div class="container">
    <div class="row">
      <div class="panel cashStock col-md-3">
        <a href="<?= base_url('Cashier/first_load_search_product'); ?>"><span class="fa fa-search" aria-hidden="true"></span>Search</a>
      </div>
      <div class="panel cashStock col-md-3">
        <a href="<?= base_url('Cashier/first_load_insert_product'); ?>"><span class="fa fa-file-code-o" aria-hidden="true"> </span>Item GRN</a>
      </div>
      <div class="panel cashStock col-md-3">
        <a href=""><span class="fa fa-file-code-o" aria-hidden="true"></span>Item PRN</a>
      </div>
      <div class="panel cashStock col-md-3">
        <a href=""><span class="fa fa-microchip" aria-hidden="true"></span>Item request</a>
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
