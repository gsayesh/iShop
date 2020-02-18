<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>LogIn Form</title>
  <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Hind:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">

</head>
<body>

<div id="login-button">
  <img src="https://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png">
  </img>
</div>
<div id="container">
  <h1>Log In</h1>
  <span class="close-btn">
    <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
  </span>
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
    <input type="hidden" name="em" value="<?= $encmac; ?>"> 
    <input type="text" name="username" placeholder="E-mail" value="<?php if (get_cookie('uid')) { echo get_cookie('uid'); } ?>">
    <input type="password" name="password" placeholder="Password" value="<?php if (get_cookie('upass')) { echo get_cookie('upass'); } ?>">
    <div id="remember-container">
      <input type="checkbox" name="remember" <?php if (get_cookie('uid')) { ?> checked="checked" <?php } ?>>
      <span>Remember me</span>
    </div>
    <input type="submit" name="log_btn" value="Login">
    
</form>
<?php echo '<label style="color: red">'.$this->session->flashdata("branch_error").'</label>'; ?>
<?php echo '<label style="color: red">'.$this->session->flashdata("login_error").'</label>'; ?>
<?php echo validation_errors('<p style="color:red">') ?>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="./script.js"></script>

</body>
</html>