<!DOCTYPE html>
<html lang="en" >
<head>
    <?php $userSes = $this->session->userdata('username'); ?>
    <?php $userTyp = $this->session->userdata('usertype'); ?>
  <meta charset="UTF-8">
  <title>IoT-Shop</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/nav-style.css'); ?>">

<!-- 
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'> -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">

<script  src="<?php echo base_url('public/assets/js/script.js'); ?>"></script>

<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('public/assets/scripts/jquery-3.2.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('public/assets/scripts/firebase-4.2.0.js'); ?>"></script>
  <script src="<?php echo base_url('public/assets/scripts/firebase-initialize.js'); ?>"></script>


  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/chat.css'); ?>">

<!-- Start QR Section Scripts -->

<link rel="stylesheet" href="<?= base_url('public/assets/QR/styles.css'); ?>">

<script src="https://www.googletagservices.com/activeview/js/current/osd.js?cb=%2Fr20100101"></script>

<script src="https://partner.googleadservices.com/gampad/cookie.js?domain=webqr.com&amp;callback=_gfp_s_&amp;client=ca-pub-8418802408648518"></script>

<script src="https://pagead2.googlesyndication.com/pagead/js/r20200428/r20190131/show_ads_impl_fy2019.js" id="google_shimpl"></script>

<script src="https://apis.google.com/_/scs/apps-static/_/js/k=oz.gapi.en_GB.TVMmU0ureXg.O/m=auth/exm=plusone/rt=j/sv=1/d=1/ed=1/am=wQE/rs=AGLTcCNEZ47O4XPxvOHlE2OsKBWeCQxiEw/cb=gapi.loaded_1" async=""></script>

<script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script>

<script src="https://apis.google.com/_/scs/apps-static/_/js/k=oz.gapi.en_GB.TVMmU0ureXg.O/m=plusone/rt=j/sv=1/d=1/ed=1/am=wQE/rs=AGLTcCNEZ47O4XPxvOHlE2OsKBWeCQxiEw/cb=gapi.loaded_0" async=""></script>

<script type="text/javascript" src="<?= base_url('public/assets/QR/llqrcode.js'); ?>"></script>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js" gapi_processed="true"></script>

<script type="text/javascript" src="<?= base_url('public/assets/QR/webqr.js'); ?>"></script>

<script src="<?= base_url('public/assest/QR/s.js'); ?>"></script>

<link rel="preload" href="https://adservice.google.co.in/adsid/integrator.js?domain=webqr.com" as="script">

<script type="text/javascript" src="https://adservice.google.co.in/adsid/integrator.js?domain=webqr.com"></script>

<link rel="preload" href="https://adservice.google.com/adsid/integrator.js?domain=webqr.com" as="script">

<script type="text/javascript" src="https://adservice.google.com/adsid/integrator.js?domain=webqr.com"></script>

<!-- End QR Section Scripts -->

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
                <li class="nav-item ">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_search_product'); ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_bill'); ?>"><i class="fa fa-file-text"></i>Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_srn'); ?>"><i class="fa fa-backward"></i>SRN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_insert_product'); ?>"><i class="fa fa-cart-plus"></i>GRN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_request'); ?>"><i class="fa fa-anchor"></i>Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_customer'); ?>"><i class="fa fa-user"></i>Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_debitor'); ?>"><i class="fa fa-users"></i>Debitor</a>
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
                <a href="<?=base_url('Common/profile_cas'); ?>"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
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
          <!-- <li>
            <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
            </a>
          </li> -->

        </ul>
      </div>
    </nav>
    <div class="container-fluid">

        <div class="main-panel">

        <div class="main-panel-content">


            <div class="card" id="sales-summary">
              <div class="title">
              <h2>CREATE BILL</h2>
              <!-- <p class="subtitle">Sales Performance for the Month</p> --> 
              </div>
              <div class="content">

                <!-- Billing function area -->

                

                         
                <center>
                <h5>ADD ITEM TO BILL</h5>
                </center>   
                <hr>

                <div class="modal-body row">
                
                  <div class="col-md-4">

                  <h6>By Item Code</h6><br><br>

                  <form action="<?= base_url('Cashier/add_to_tempBill'); ?>" method="post">

                  <div class="form-group">

                    <input type="text" name="item_code" id="item_code" placeholder="Items Code" class="form-control">

                  </div>

                  <div class="form-group">

                    <input type="number" name="qty" id="qty" placeholder="Quantity" class="form-control">
                  
                  </div>

                  <div class="form-group">

                    <button name="add_manual" class="btn btn-primary btn-lg">ADD</button>

                  </div>

                  </form>
                    
                  </div>

                  <div class="col-md-4">
                  
                  <h6>By QR Code</h6><br>

                  <form action="<?= base_url('Cashier/add_to_tempBill'); ?>" method="post">

                  <div class="form-group">

                    <div id="result2" >- scanning -</div>

                  </div>

                  <div class="form-group">

                    <input type="number" name="qty" id="qty" placeholder="Quantity" class="form-control">
                  
                  </div>

                  <div class="form-group">

                    <button name="add_manual" class="btn btn-primary btn-lg">ADD</button>

                  </div>

                  </form>

                  </div>

                  <div class="col-md-4">

                  <div id="main">
                  <div id="header">
                  <div style="position:relative;top:+20px;left:0px;"><div id="___plusone_0" style="position: absolute; width: 450px; left: -10000px;">
                    <iframe ng-non-bindable="" frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position:absolute;top:-10000px;width:450px;margin:0px;border-style:none" tabindex="0" vspace="0" width="100%" id="I0_1588578853090" name="I0_1588578853090" src="https://apis.google.com/u/0/se/0/_/+1/fastbutton?usegapi=1&amp;size=medium&amp;origin=https%3A%2F%2Fwebqr.com&amp;url=https%3A%2F%2Fwebqr.com%2F&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.en_GB.TVMmU0ureXg.O%2Fam%3DwQE%2Fd%3D1%2Fct%3Dzgms%2Frs%3DAGLTcCNEZ47O4XPxvOHlE2OsKBWeCQxiEw%2Fm%3D__features__#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh&amp;id=I0_1588578853090&amp;_gfid=I0_1588578853090&amp;parent=https%3A%2F%2Fwebqr.com&amp;pfname=&amp;rpctoken=37317089" data-gapiattached="true"></iframe>
                  </div><g:plusone size="medium" data-gapiscan="true" data-onload="true" data-gapistub="true"></g:plusone></div>

                  </div>
                  <div id="mainbody" style="display: inline;">
                  <table class="tsel" border="0" width="100%">
                  <tbody><tr>
                  <td valign="top" align="center" width="50%">
                  <table class="tsel" border="0">
                  <tbody><tr>
                  <td><span class="selector" id="webcamimg"  onclick="setwebcam()" align="left" style="opacity: 1;"></span></td>
                  <td><span class="selector" id="qrimg" onclick="setimg()" align="right" style="opacity: 0.2;"></span></td></tr>
                  <tr><td colspan="2" align="center">
                  <div id="outdiv"><video id="v" autoplay=""></video></div></td></tr>
                  </tbody></table>
                  </td>
                  </tr>

                  <tr><td colspan="3" align="center">
                  <div id="result" hidden>- scanning -</div>
                  
                  </td></tr>
                  </tbody>
                  </table>

                  </div>&nbsp;

                  </div>
                  <canvas id="qr-canvas" width="320" height="180" style="width: 320px; height: 180px;"></canvas>

                  </div>
                </div>

                <hr>

                <div>
                  <center>    
                  <h3>BILL ITEM</h3>
                  </center>
                  <br>

                  

                  <form action="<?=base_url('Cashier/create_bill'); ?>" method="post">
                  <div class="row">

                    <div class="col-md-4">

                      <div class="form-group">
                        <label class="label label-default">Bill Type </label> 
                        <select id="bill_type" name="bill_type" class="form-control">
                          <option>Cash</option>
                          <option>Credit</option>
                        </select>
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">
                        <label class="label label-default">Customer ID </label>
                        <input type="text" name="customer" placeholder="111111111v" required="true" class="form-control">

                          <input type="hidden" name="user" id="user" value="user test">
                          <input type="hidden" name="branch" id="branch" value="branch1">
                      </div>

                    </div>
                    
                   
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="label label-default">Bill Number </label>
                        <?php 
                          foreach ($new_bill_no as $number) :
                        ?>

                        <input type="text" name="bill_no"  id="bill_no" readonly="true" value="<?php echo $number; ?>" class="form-control">

                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="table-responsive" id="printData_id">
                    
                      <table class="table table-bordered table-striped" id="grn_table">
                        <tr>
                        <th>#</th>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Option</th>
                        </tr>

                        <?php 
                        $counter=1;
                        $num=1;
                        $totalAmount=0.00;

                        foreach ($data as $row) :
                          $totalAmount += $row->total;
                        ?>

                        <tr>
                        <td><?= $counter++; ?></td>
                        <td><?= $row->item_code; ?></td>
                        <td><?= $row->name; ?></td>
                        <td><?= $row->description; ?></td>
                        <td><?= $row->price; ?></td>
                        <td><?= $row->qty; ?></td>
                        <td><?= $row->total; ?></td>
                        <td><a href="remove_from_temp_bill/<?= $row->id ?>" class="btn btn-danger">REMOVE</a></td>
                        </tr>

                        <?php endforeach; ?>

                      </table>

                      <div class="row">

                      <div class="col-md-8">
                      </div>

                      <div class="col-md-3">
                        <label>Total Amount : </label>
                        <input type="text" name="totalAmount" value="<?php echo $totalAmount; ?>" readonly><br><br>
                        <input type="submit"  value="Pay Bill" class="btn btn-success btn-lg">
                      </div>
                    
                  </form>

                    </div>

                  </div>

                </div>

                <div id="grn_table"></div>


              </div>
            </div>
          </div>
        
    </div>
  </div>
</div>
<!-- partial -->

<script type="text/javascript">load();</script>
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script  src="<?php echo base_url('public/assets/js/nav-script.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('public/assets/scripts/scripts.js'); ?>"></script>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>
<script  src="<?php echo base_url('public/assets/js/chat.js'); ?>"></script>
</body>
</html>
