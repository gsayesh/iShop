<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Iot-Shop</title>
	<script src="<?php echo base_url('public/assets/js/terminal.js'); ?>"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/login.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/terminal.css'); ?>">
</head>
<body>
	<div id="container">
		<span id="LoginPageHeader" class="typeing"></span>
		<output></output>    
		<div id="input-line" class="input-line">
			<!-- <div class="prompt"></div> -->
			<div><input class="cmdline" autofocus /></div>
		</div>
	</div>
	<!-- Includes the custom object "Terminal" to set it up later -->
	<!-- locally, of this repo -->
	<!-- Actual initialization of the terminal -->
	<script>
		$(function() {
        // configuration data
        var config = {
          prompt: "[user@web-terminal]$ ", // user will be replaced by guest
          commands: {
            // specify what should happen on a cmd and return string to write to terminal
            help: (argString) => {
            	return('<div class="ls-files">' + Object.keys(config.commands).join('<br>') + '</div>');
            },
            echo: (argString) => {
            	return argString;
            },
            user: (argString) => {
              // example login feature. NOT SECURE!
              if (argString == "") {
              	return("Please login using user &#60;username&#62;");
              }
              var args = argString.split(" ");
              term.login(args[0]/*user*/);
          },
          p: (argString) => {
              // example login feature. NOT SECURE!
              if (argString == "") {
              	return("Please login using password &#60;password&#62;");
              }
              var args = argString.split(" ");
              term.password(args[0]/*user*/);
          },
          logout: (argString) => {
          	term.logout();
          },
            // required as of the current setup, otherwise TypeErr is thrown
            default: () => {
            	return("Not a command. Enter 'help' for more information.")
            }
        }
    };
        // Initialize a new terminal object
        // new Terminal(cmdLineContainer, outputContainer, config)
        var term = new Terminal('#input-line .cmdline', '#container output', config);
        term.init();
    });
</script>
</body>

</html>
