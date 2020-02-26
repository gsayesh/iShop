<!DOCTYPE html>
<html>
<head>
  <title>IoT Shop - Login</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Numans');

    html,body{
      background-image: url('<?php echo base_url('public/assets/images/bg4.jpg'); ?>');
      background-size: cover;
      background-repeat: no-repeat;
      height: 100%;
      font-family: 'Numans', sans-serif;
    }

    .container{
      height: 100%;
      align-content: center;
    }

    .card{
      height: 370px;
      margin-top: auto;
      margin-bottom: auto;
      width: 400px;
      background-color: rgba(0,0,0,0.7) !important;
    }

    .social_icon span{
      font-size: 60px;
      margin-left: 10px;
      color: #FFC312;
    }

    .social_icon span:hover{
      color: white;
      cursor: pointer;
    }

    .card-header h3{
      color: white;
    }

    .card-footer{
      background-color: rgba(0,0,0,0.6) !important;
    }

    .social_icon{
      position: absolute;
      right: 20px;
      top: -45px;
    }

    .input-group-prepend span{
      width: 50px;
      background-color: #FFC312;
      color: black;
      border:0 !important;
    }

    input:focus{
      outline: 0 0 0 0  !important;
      box-shadow: 0 0 0 0 !important;

    }

    .remember{
      color: white;
    }

    .remember input
    {
      width: 20px;
      height: 20px;
      margin-left: 15px;
      margin-right: 5px;
    }

    .login_btn{
      color: black;
      background-color: #FFC312;
      width: 100px;
    }

    .login_btn:hover{
      color: black;
      background-color: white;
    }

    .links{
      color: white;
    }

    .links a{
      margin-left: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="d-flex justify-content-center h-100">
      <div class="card">
        <div class="card-header">
          <h3>Sign In</h3>
        </div>
        <div class="card-body">
          <form action="<?= base_url('Auth/login') ?>" method="POST">
          <?php  
            // Turn on output buffering  
            ob_start();  
            //Get the ipconfig details using system commond  
            system('ipconfig /all');  
            // Capture the output into a variable  
            $mycomsys=ob_get_contents();  
            // Clean (erase) the output buffer  
            ob_clean();  
            $find_mac = "Physical"; //find the "Physical" & Find the position of Physical text  
            $pmac = strpos($mycomsys, $find_mac);  
            // Get Physical Address  
            $macaddress=substr($mycomsys,($pmac+36),17);
            $encmac= md5($macaddress);     
          ?>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="hidden" name="em" value="<?= $encmac; ?>"> 
              <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if (get_cookie('uid')) { echo get_cookie('uid'); } ?>">
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="row align-items-center remember">
              <input type="checkbox"  name="remember" <?php if (get_cookie('uid')) { ?> checked="checked" <?php } ?>>Remember Me
            </div>
            <div class="form-group">
              <input type="submit" value="Login" class="btn float-right login_btn">
            </div>
          </form>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-center">
            <?php echo '<label style="color: red">'.$this->session->flashdata("branch_error").'</label>'; ?>
            <?php echo '<label style="color: red">'.$this->session->flashdata("login_error").'</label>'; ?>
            <?php echo validation_errors('<p style="color:red">') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

