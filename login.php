<?php

    session_start();

    include "config/koneksi.php";

    if(isset($_SESSION['login_usr'])){
      header("location:".$base_url."/");
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Suara RT</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        body{
            background-color: #131313;
        }

    	img{
    		-webkit-filter: blur(2px);
    		filter: blur(2px);
            transform: scale(1.1);
            opacity: 0.6;
    	}

    	.alert-div{
    		max-width: 330px;
		    margin: 0 auto 0;
		    background: #fff;
		    border-radius: 5px;
		    -webkit-border-radius: 5px;
    	}

    	.form-login{
    		margin-top: 0;
    	}

    	.container{
    		padding-top: 100px;
    	}
    </style>
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">

	  			<?php if(isset($_SESSION['notice'])){ ?>
		  			<div class="alert-div">
			  			<div class="alert alert-danger alert-dismissable">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						  <strong><?php echo $_SESSION['notice'];?></strong> <?php echo $_SESSION['notice_msg'];?>
						</div>
		  			</div>
	  			<?php 
	  			        session_unset('notice');
	  			        session_unset('notice_msg');
	  			    } 
	  			?>
	  			

				<form class="form-login" action="login_process.php" method="post">
					<h2 class="form-login-heading">sign in now</h2>
					<div class="login-wrap">
					    <input type="email" class="form-control" placeholder="email" autofocus name="email">
					    <br>
					    <input type="password" class="form-control" placeholder="Password" name="password">
					    <br>
					    <input type="hidden" name="token" value="swrrt">
					    <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>


					</div>


				</form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/rt_bg.jpg", {speed: 500});
    </script>


  </body>
</html>
