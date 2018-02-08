<?php

    session_start();

    include "config/koneksi.php";

    if(!isset($_SESSION['login_usr'])){
      header("location:login.php");
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
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="assets/css/select2.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/css/select.jqueryui.min.css">    
    <link rel="stylesheet" type="text/css" href="assets/css/jquery-confirm.min.css">    


    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.min.css">    

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="assets/js/jquery.js"></script>
    <!-- <script src="assets/js/jquery-1.8.3.min.js"></script> -->
    <script src="assets/js/jquery-1.12.4.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>



    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <script type="text/javascript" src="assets/js/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/datatables/dataTables.select.min.js"></script>


    <script type="text/javascript" src="assets/js/select2.full.min.js"></script>
    <script type="text/javascript" src="assets/js/placeholders.min.js"></script>
    <script type="text/javascript" src="assets/js/placeholders.jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-confirm.min.js"></script>
    <script src="assets/js/bootstrap-switch.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .required{
        color: #F00;
      }

      .select2-container{
        width: 100% !important;
      }
    </style>

  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo $base_url;?>" class="logo"><b> Suara RT</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <?php include "side_menu.php";?>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          
          <?php

            if(isset($_GET['pg'])){

              switch ($_GET['pg']) {
                case "dhs":
                  include "komplek_manage.php";
                  break;
                
                case "dct":
                  include "kota_manage.php";
                  break;

                case "dgp":
                  include "group_housing_manage.php";
                  break;
                  
                case "dtc":
                  include "thread_category_manage.php";
                  break;
                  
                case "dusr":
                  include "user_manage.php";
                  break;

                case "thm":
                  include "thread_manage_ajax.php";
                  break;

                case 'ndr':
                  include "nomor_darurat_manage.php";
                  break;

                case 'dic':
                  include "icon_manage.php";
                  break;

                case 'dth':
                  include "thread_detail.php";
                  break;

                default:

                  break;
              }
            }

            


          ?>

        </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              Suara RT &copy; 2017
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
      $(".datepicker").datepicker({
        format:"dd-mm-yyyy",
      });
    </script>
    

  </body>
</html>
