<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>IoT-Shop Management Information System</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-1.12.4.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
        <a href="<?=base_url('Common/profile'); ?>"><i class="fa fa-user" aria-hidden="true"> </i><p>Profile</p></a>
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
            <a href="<?= base_url('Stock_Actions/item_stock_add') ?> "class="btn btn-outline-primary">Back to Items</a>
            <hr>
            <input type="hidden" name="user" id="user" value="<?=$this->session->userdata('user_id')?>">
          <div class="table-responsive">
            <table class="table" id="grn_table">
            <tr class="thead-light">
              <th class="col">#</th>
              <th class="col">Item Code</th>
              <th class="col">Item Name</th>
              <th class="col">Description</th>
              <th class="col">Whole Sale Price</th>
              <th class="col">Retail Price</th>
              <th class="col">Quantity</th>
              <th class="col">Actions</th>
            </tr>
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
</body>
</html>
