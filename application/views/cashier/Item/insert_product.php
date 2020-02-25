<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>IoT-Shop Management Information System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?= base_url('assest/css/style.css'); ?>">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />

  <script src="https://code.jquery.com/jquery-1.12.4.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>


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

       url:"<?php echo base_url(); ?>Cashier/search_product_insert",
       method:"POST",
       data:{query:query},
       success:function(data){
        $('#result').html(data);

       }

      });

     }


     $('#add_data').click(function(){

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
            'qty' : $(tr).find('#quentity1').val()

            };

            table_data.push(sub);

          }
        }); 


        var basic_data = {
          'bill_no' : $('#bill_no').val(),
          'grn_no' : $('#grn_no').val(),
          'branch' : $('#branch').val(),
          'user' : $('#user').val()
        };


        if ($('#bill_no').val() == "" || table_data.length == 0) {
              
          swal({
           title: "Fill Bill Number and Add Item To GRN.",
           text: "",
           type: "warning",
           confirmButtonText : 'Ok',
           closeOnConfirm : true
          });

        }
        else{

        swal({

          title : 'Do You Want Add Items To Stock?',
          text : 'click ok to continue.',
          showLoaderOnConfirm : true,
          showCancelButton : true,
          confirmButtonText : 'Yes',
          closeOnConfirm : false },
          function(){

              var data = { 'data_table' : table_data , 'basic_data' : basic_data };

              $.ajax({

                data : data,
                type : 'POST',
                url : '<?php echo base_url('Cashier/grn_item'); ?>',
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

            <center>
            <h3>Insert Product</h3>
            </center>

            <div class="row">
              <div class="col-md-9">
              </div>
              <div class="col-md-2">
                <input type="text" id="item_code" placeholder="Search Items">
              </div>
            </div>
            
            
            <hr>

            <div id="result"></div>

            <hr>

            <div>
              <center>    
              <h3>GRN Item</h3>
              </center>
              <br>

              <div class="row">
                <div class="col-md-9">
                  <label>Bill Number </label>
                  <input type="text" name="bill_no" id="bill_no" required="true">
                  <input type="hidden" name="user" id="user" value="user test">
                  <input type="hidden" name="branch" id="branch" value="branch1">
                </div>
                <div class="col-md-3">
                  <label>GRN Number </label>
                  <?php 
                    foreach ($new_grn_no as $number) :
                  ?>

                  <input type="text" name="grn_no"  id="grn_no" readonly="true" value="<?= $number; ?>">

                  <?php endforeach; ?>
                </div>
              </div>

              <div class="table-responsive" id="printData_id">
                
                   <table class="table table-bordered table-striped" id="grn_table">
                    <tr>
                     <th>#</th>
                     <th>Product Code</th>
                     <th>Name</th>
                     <th>Description</th>
                     <th>Whole Sale Price</th>
                     <th>Retail Price</th>
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
                     <td><?= $row->item_name; ?></td>
                     <td><?= $row->item_description; ?></td>
                     <td><?= $row->whole_sale_price; ?></td>
                     <td><?= $row->retail_price; ?></td>
                     <td><input type="Number" name="qty" id="quentity1" min="0" required="true" ></td>
                     <td><a href="remove_from_gnr_table/<?= $row->id ?>" class="btn btn-danger">REMOVE</a></td>
                    </tr>

                    <?php endforeach; ?>

                   </table>

                   <div class="row">
                  <div class="col-md-10">
                  </div>
                  <div class="col-md-1">
                    <button name="add_data" id="add_data" class="btn btn-success">SUBMIT</button>
                  </div>
                </div>

              </div>

            </div>

            <div id="grn_table"></div>
            
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
