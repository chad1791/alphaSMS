<?php
    if($this->session->userdata('student_id')){
        //echo $this->session->userdata('admin_id');
      $student_email = $this->session->userdata('email');


        $timezone = new \DateTimeZone('America/Belize');
        $date = new \DateTime('@' . time(), $timezone);
        $date->setTimezone($timezone);
        $today = $date->format('d M Y');
 
        //getting default events for user...

        $myEvents = array();
 
        if($this->session->userdata('myEvents')){    
            $myEvents = $this->session->userdata('myEvents');         
        } 

        //getting profile data

        $stdProfile = array();

        if($this->session->userdata('stdProfile')){    
            $stdProfile = $this->session->userdata('stdProfile'); 
            //$ad_id = $profile[0]['id'];       
        }

        $canViewGrades = $stdProfile[0]['can_view_grades']; 
        $canViewAttendance = $stdProfile[0]['can_view_attendance'];   

        //getting my class data

        $department = '';

        $myClass = array();

        if($this->session->userdata('myClass')){    
            $myClass = $this->session->userdata('myClass'); 
            $department = $myClass[0]['department'];
            //$ad_id = $profile[0]['id'];        
        }        

        //getting class assignments

        $myAssignments = array(); 

        if($this->session->userdata('myAssignments')){    
            $myAssignments = $this->session->userdata('myAssignments'); 
            //$ad_id = $profile[0]['id'];       
        }

        //getting class attachments

        $myFiles = array(); 

        if($this->session->userdata('myFiles')){    
            $myFiles = $this->session->userdata('myFiles'); 
            //$ad_id = $profile[0]['id'];       
        }

        //getting my class data

        $myClass = array(); //myUploadedFiles

        if($this->session->userdata('myClass')){    
            $myClass = $this->session->userdata('myClass'); 
            //$ad_id = $profile[0]['id'];       
        }

        //getting my uploaded files

        /*$myUploadedFiles = array();

        if($this->session->userdata('myUploadedFiles')){    
            $myUploadedFiles = $this->session->userdata('myUploadedFiles'); 
            //$ad_id = $profile[0]['id'];       
        }*/

        //echo '<pre>';
        //print_r($stdProfile);
        //echo '</pre>';

        /////////////////////////////////////////////////////////

        //counting messages

        $messages = array();

        if($this->session->userdata('messages')){    
            $messages = $this->session->userdata('messages');        
        }

        //counting notifications

        $notifications = array();

        if($this->session->userdata('notifications')){    
            $notifications = $this->session->userdata('notifications');        
        }


    }
    else{
        redirect('/students/login');
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alpha SMS | Graphs</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">

  <!-- AmCharts scripts -->
  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/pie.js"></script>
  <script src="https://www.amcharts.com/lib/3/serial.js"></script>
  <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
  <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">

    .container {
      position: relative;
      width: 100%;
    }

    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      border-radius:5px;
    }

    .container:hover .card {
      opacity: 0.4;
    }

    .container:hover .middle {
      opacity: 1;
    }
    
  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>SM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Alpha </b>SMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo count($messages); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo count($messages); if(count($messages) == 1){echo ' Message';}else{echo ' Messages';} ?></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <!--li>< start message>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php //echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li-->
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="bellIcon"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><span id="noteMsg"></span></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <!--ul class="menu">
                  <li><ul id="newNoteBody"></ul></li>
                  <li><ul id="oldNoteBody"></ul></li>
                </ul-->

                <div class="" style="max-height: 300px; overflow-y: hidden;">
                  <ul id="newNoteBody" class="menu" style="height: auto;"></ul>
                  <ul id="oldNoteBody" class="menu" style="height: auto;"></ul>
                </div>
                <!--ul class="menu" id="oldNoteBody"></ul-->
              </li>
              <li class="footer"><a href="notifications">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   <img src="

                  <?php 

                    if(count($stdProfile) > 0){ 
                      if($stdProfile[0]['image'] != ''){ 
                        echo base_url().'custom/uploads/students/images/'.$stdProfile[0]['image']; 
                      }
                      else{

                        if($stdProfile[0]['gender'] == 'Male'){
                          echo base_url().'custom/uploads/default/images/male.jpg';
                        }
                        else { 
                          echo base_url().'custom/uploads/default/images/female.jpg';  
                        }  
                      }
                    }

                  ?>
                " class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if(count($stdProfile)==0){echo 'Profile is not set!';} else{echo $stdProfile[0]['first']. ' '. $stdProfile[0]['last'];}?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="

                  <?php 

                    if(count($stdProfile) > 0){ 
                      if($stdProfile[0]['image'] != ''){ 
                        echo base_url().'custom/uploads/students/images/'.$stdProfile[0]['image']; 
                      }
                      else{

                        if($stdProfile[0]['gender'] == 'Male'){
                          echo base_url().'custom/uploads/default/images/male.jpg';
                        }
                        else { 
                          echo base_url().'custom/uploads/default/images/female.jpg';  
                        }  
                      }
                    }

                  ?>
                " class="img-circle" alt="User Image">

                <p>
                  <?php if(count($stdProfile)==0){echo 'Profile is not set!';} else{echo $stdProfile[0]['first']. ' '. $stdProfile[0]['last'];} ?>
                  <small><?php echo $student_email; ?></small>
                  <small><?php if(count($myClass)>0){echo $myClass[0]['name'].' - '.$myClass[0]['level'];} else{ echo 'No Class Assigned!'; } ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../Students/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
                <img src="

                  <?php 

                    if(count($stdProfile) > 0){ 
                      if($stdProfile[0]['image'] != ''){ 
                        echo base_url().'custom/uploads/students/images/'.$stdProfile[0]['image']; 
                      }
                      else{

                        if($stdProfile[0]['gender'] == 'Male'){
                          echo base_url().'custom/uploads/default/images/male.jpg';
                        }
                        else { 
                          echo base_url().'custom/uploads/default/images/female.jpg';  
                        }  
                      }
                    }

                  ?>
                " class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if(count($stdProfile)==0){echo 'Profile is not set!';} else{echo $stdProfile[0]['first'].' '.$stdProfile[0]['last'];}?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-university"></i> <span>Home</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="graphs"><i class="fa fa-line-chart"></i> Progress (Graphs)</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="grades">
            <i class="fa fa-user"></i>
            <span>My Grades</span>
            <span class="pull-right-container">
              <!--span class="label label-primary pull-right">4</span-->
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="attendance">
            <i class="fa fa-check-square"></i>
            <span>My Attendance</span>
            <!--span class="pull-right-container"-->
              <!--span class="label label-success pull-right">4</span-->
            <!--/span-->
          </a>
        </li>
        <li class="header">SYSTEM CONFIG</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Account Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--li class="active"><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li-->
            <!--li><a href="administrators"><i class="fa fa-users"></i> Administrators</a></li-->
            <li><a href="profile"><i class="fa fa-pinterest-p"></i> Profile</a></li>
            <li><a href="change-password"><i class="fa fa-key"></i> Change password</a></li>
            <!--li><a href="report-cards"><i class="fa fa-stack-overflow"></i> Report Cards</a></li-->
            <!--li><a href="graphs"><i class="fa fa-line-chart"></i> Schooling System</a></li-->
            <!--li><a href="school-terms"><i class="fa fa-file-text"></i> School Terms</a></li-->
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Progress
        <small>Graphs</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-university"></i> Home</a></li>
        <li class="active">Progress</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <input type="hidden" name="department" id="department" value="<?=$department;?>">

      <input type="hidden" name="base_url" id="base_url" value="<?=base_url(); ?>">
      <input type="hidden" name="student_id" id="student_id" value="<?=$this->session->userdata('student_id'); ?>">
      <input type="hidden" name="class_id" id="class_id" value="<?php if(count($stdProfile)>0){ echo $stdProfile[0]['class_id']; } ?>">

      <input type="hidden" name="canViewGrades" id="canViewGrades" value="<?=$canViewGrades; ?>">
      <input type="hidden" name="canViewAttendance" id="canViewAttendance" value="<?=$canViewAttendance; ?>">

      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h4>Bar Graphs showing grades per course</h4>
        </div>        
      </div>
      
      <div class="row" id="graphs"></div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h4>Pie Charts showing Attendance per course</h4>
        </div>        
      </div>

      <div class="row" id="pies"></div>      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- Page specific script -->
<!-- iCheck -->  
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/student/graphs.js"></script>
<!--script type="text/javascript" src="<?php //echo base_url();?>/custom/js/student/uploadAssignment.js"></script-->
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/student/comet.js"></script> 

</body>
</html>