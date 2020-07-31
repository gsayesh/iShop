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


<script>
      $(function(){

      load_data();

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

      function load_data(query)
      {

        $.ajax({

        url:"<?php echo base_url(); ?>Cashier/search_product_srn",
        method:"POST",
        data:{query:query},
        success:function(data){
          $('#result').html(data);

        }

        });

      }



    });

    </script>


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
                <li class="nav-item ">
                    <a class="nav-link" href="<?= base_url('Cashier/first_load_bill'); ?>"><i class="fa fa-file-text"></i>Bill</a>
                </li>
                <li class="nav-item active">
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
                <h2>RETURN SALES</h2>
                <!-- <p class="subtitle">Sales Performance for the Month</p> -->
              </div>
              <div class="content">
                

                <!-- Function UI Eliment -->

                 <div class="row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="item_code" placeholder="Type Item Code Here.." class="form-control">
                    </div>
                  </div>
                  
                  
                  <hr>

                  <div id="result"></div>

                  <hr>

                  <div>
                    <center>    
                    <h3>Return Sales</h3>
                    </center>
                    <br>

                    <div class="row">

                    <form action="<?= base_url(); ?>cashier/add_srn" method="post">

                    <div class="form-group">
                      
                        <label class="label label-default">Bill Number </label>
                        <input type="text" name="bill_no" placeholder="Bill Number" required class="form-control">
                        <input type="hidden" name="user" id="user" value="user test">
                        <input type="hidden" name="branch" id="branch" value="branch1">
                        <label class="label label-default">Reason </label>
                        <input type="text" name="reason" placeholder="Reason" required class="form-control">                      

                      
                        <label class="label label-default">SRN Number </label>
                        <?php 
                          foreach ($new_srn_no as $number) :
                        ?>

                        <input type="text" name="srn_no"  id="srn_no" readonly="true" value="<?= $number; ?>" class="form-control">

                        <?php endforeach; ?>
                      
                      </div>
                    </div>

                    <div class="table-responsive" id="printData_id">
                    
                            <input type="hidden" value="aaa" name="data">
                        <table class="table table-bordered table-striped" id="grn_table">
                          <tr>
                          <th>#</th>
                          <th>Product Code</th>
                          <th>Name</th>
                          <th>Quentity</th>
                          <th>Option</th>
                          </tr>

                          <?php 
                          $counter=1;
                          $num=1;

                          foreach ($data as $row) :
                          ?>

                          <tr>
                          <td><?= $counter++; ?></td>
                          <td><?= $row->item_code; ?></td>
                          <td><?= $row->name; ?></td>
                          <td><input type="Number" name="qty_<?= $row->item_code; ?>" id="quantity1" min="0" required="true" ></td>
                          <td><a href="remove_from_temp_srn_table/<?= $row->id ?>" class="btn btn-danger">REMOVE</a></td>
                          </tr>

                          <?php endforeach; ?>

                        </table>

                        <div class="row">
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-1">
                          <input type="submit" name="add_data" id="" class="btn btn-success" value="submit">
                        </div>
                          </form>

                      </div>

                    </div>



              </div>
            </div>
          </div>
        
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script  src="<?php echo base_url('public/assets/js/nav-script.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('public/assets/scripts/scripts.js'); ?>"></script>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>
<script  src="<?php echo base_url('public/assets/js/chat.js'); ?>"></script>
</body>
</html>
