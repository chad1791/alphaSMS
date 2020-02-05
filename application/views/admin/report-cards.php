<?php
    if($this->session->userdata('admin_id')){

    	//$admin_id = $this->session->userdata('admin_id');
      $admin_email = $this->session->userdata('email');

        //getting profile data

        $profile = array();

        if($this->session->userdata('profile')){    
            $profile = $this->session->userdata('profile');     
        }

        $settings = array();

        if($this->session->userdata('settings')){    
            $settings = $this->session->userdata('settings');     
        }

        $schooling = array();

        if($this->session->userdata('schooling')){    
            $schooling = $this->session->userdata('schooling');     
        }  

        $grading = array();

        if($this->session->userdata('grading')){    
            $grading = $this->session->userdata('grading');     
        }   

        //print_r($grading);

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
        redirect('/');
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alpha SMS | Report Card Settings</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
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
              <span class="label label-warning"><?php echo count($notifications); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo count($notifications); if(count($notifications) == 1){echo ' Notification';}else{echo ' Notifications';} ?></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <!--li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li-->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php if(count($profile) > 0){ if($profile[0]['image'] != ''){ echo base_url().'custom/uploads/admin/images/'.$profile[0]['image']; }else{ echo base_url().'assets/dist/img/avatar04.png'; } }else{echo base_url().'assets/dist/img/avatar04.png';} ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if(count($profile)==0){echo 'Profile is not set!';} else{echo $profile[0]['name'].' '.$profile[0]['last'];}?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php if(count($profile) > 0){ if($profile[0]['image'] != ''){ echo base_url().'custom/uploads/admin/images/'.$profile[0]['image']; }else{ echo base_url().'assets/dist/img/avatar04.png'; } }else{echo base_url().'assets/dist/img/avatar04.png';} ?>" class="img-circle" alt="User Image">

                <p>
                  <?php if(count($profile)==0){echo 'ADMINISTRATOR POST';} else{echo $profile[0]['position'];}?>
                  <small><?php echo $admin_email; ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="Admins/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php if(count($profile) > 0){ if($profile[0]['image'] != ''){ echo base_url().'custom/uploads/admin/images/'.$profile[0]['image']; }else{ echo base_url().'assets/dist/img/avatar04.png'; } }else{echo base_url().'assets/dist/img/avatar04.png';} ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if(count($profile)==0){echo 'Profile is not set!';} else{echo $profile[0]['name'].' '.$profile[0]['last'];}?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form method="POST" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="query" id="query" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-university"></i> <span>Home</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="graphs"><i class="fa fa-line-chart"></i> Graphs</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="teachers">
            <i class="fa fa-black-tie"></i>
            <span>Teachers</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="students">
            <i class="fa fa-user"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="classes">
            <i class="fa fa-cubes"></i>
            <span>Classes</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="courses">
            <i class="fa fa-mortar-board"></i>
            <span>Courses</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">4</span>
            </span>
          </a>
        </li>
        <!--li class="treeview">
          <a href="events">
            <i class="fa fa-calendar"></i>
            <span>Events</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="messages">
            <i class="fa fa-comments"></i>
            <span>Messages</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li-->
        <li class="treeview">
          <a href="attendance">
            <i class="fa fa-check-square-o"></i>
            <span>Attendance</span>
            <span class="pull-right-container">
              <!--span class="label label-warning pull-right">4</span-->
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="lesson-plans">
            <i class="fa fa-folder-open"></i>
            <span>Lesson Plans</span>
            <span class="pull-right-container"> 
              <!--span class="label label-danger pull-right">4</span-->
            </span>
          </a>
        </li>
        <li class="header">SYSTEM SETTINGS</li>
        <!--li class="active treeview"-->
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Administrative Tasks</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--li class="active"><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li-->
            <li><a href="administrators"><i class="fa fa-users"></i> Administrators</a></li>
            <li><a href="profile"><i class="fa fa-pinterest-p"></i> Profile</a></li>
            <li><a href="settings"><i class="fa fa-gear"></i> Settings</a></li>
            <li class="active"><a href="report-cards"><i class="fa fa-stack-overflow"></i> Report Cards</a></li>
            <li><a href="change-password"><i class="fa fa-key"></i> Change Password</a></li> 
            <!--li><a href="school-terms"><i class="fa fa-file-text"></i> School Terms</a></li-->
          </ul>
        </li>
        <!--li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li-->
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
        Report Card Settings <small>Work on this section later...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">Administrative Tasks</a></li>
        <li class="active">Report Card Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

      <input type="hidden" name="baseUrl" id="baseUrl" value="<?php echo base_url(); ?>">
      <input type="hidden" id="base" value="<?php echo base_url(); ?>">
      <input type="hidden" name="prevImage" id="prevImage" value="<?php if(count($settings)>0){ echo $settings[0]['image']; } ?>">

	    <?php if($this->session->flashdata('upProfile_success')): ?>
	      <?php echo '<p class="alert alert-success col-sm-10 col-md-10 col-lg-10" style="margin-left:15px;">'.$this->session->flashdata('upProfile_success').'</p>' ?>
	    <?php endif ;?>

        <!-- /.col -->
        <div class="col-md-10">
          <div class="nav-tabs-custom"> 
            <ul class="nav nav-tabs">
              <!--li class="active"><a href="#activity" data-toggle="tab">Activity</a></li-->
              <!--li><a href="#timeline" data-toggle="tab">Timeline</a></li-->
              <li class="active"><a href="#settings" data-toggle="tab">Report Card Info</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="settings">
                <form class="form-horizontal" method="POST" action="#">
                
                <?php 

                	//$attributes = array('class' => 'form-horizontal', 'onsubmit'=>'document.getElementById(\'schooling\').disabled = false; document.getElementById(\'grading\').disabled = false;');

                  //$attributes = array('class' => 'form-horizontal');                	

                ?>

                  <input type="hidden" name="setting_id" id="setting_id" value="<?php if(count($settings)>0){ echo $settings[0]['id']; } ?>">
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">School Name</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($settings)>0){echo $settings[0]['name'];} ?>" class="form-control" id="name" name="name" placeholder="School Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($settings)>0){echo $settings[0]['address'];} ?>" class="form-control" id="address" name="address" placeholder="Address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Phone No</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($settings)>0){echo $settings[0]['phone'];} ?>" class="form-control" id="phone" name="phone" placeholder="Phone No">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cell" class="col-sm-2 control-label">Cell No</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($settings)>0){echo $settings[0]['phone'];} ?>" class="form-control" id="cell" name="cell" placeholder="Cell No">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" value="<?php if(count($settings)>0){echo $settings[0]['email'];} ?>" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="schooling" class="col-sm-2 control-label">Schooling System</label>
                    <div class="col-sm-10">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->
                      <select class="form-control" name="schooling" id="schooling" <?php if(count($settings)>0){echo 'disabled="disabled"';} ?>>
                        <?php
                          if(count($schooling)>0){
                            for ($i=0; $i < count($schooling); $i++) { 
                              if($schooling[$i]['id'] == $settings[0]['schooling']){
                                echo '<option value="'.$schooling[$i]['id'].'" selected>'.$schooling[$i]['name'].'</option>';
                              }
                              else{
                                echo '<option value="'.$schooling[$i]['id'].'">'.$schooling[$i]['name'].'</option>'; 
                              }                              
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="grading" class="col-sm-2 control-label">Grading System</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="grading" id="grading" <?php if(count($settings)>0){echo 'disabled="disabled"';} ?>>
                        <?php

                          if(count($grading)>0){
                            for ($i=0; $i < count($grading); $i++) { 
                              if($grading[$i]['id'] == $settings[0]['grading']){
                                echo '<option value="'.$grading[$i]['id'].'" selected>'.$grading[$i]['name'].'</option>';
                              }
                              else{
                                echo '<option value="'.$grading[$i]['id'].'">'.$grading[$i]['name'].'</option>';
                              }                              
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="datepicker1" class="col-sm-2 control-label">School Year</label>

                    <div class="col-sm-5">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="<?php if(count($settings)>0){echo $settings[0]['start'];} ?>" name="start" class="form-control pull-right" id="datepicker1">
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="<?php if(count($settings)>0){echo $settings[0]['end'];} ?>" name="end" class="form-control pull-right" id="datepicker2">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="shortYear" class="col-sm-2 control-label">School Year (Short)</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php if(count($settings)>0){echo $settings[0]['short'];} ?>" name="shortYear" class="form-control" id="shortYear" disabled="disabled">                     
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="terms" class="col-sm-2 control-label">Terms & Conditions</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="terms" name="terms" placeholder="Terms & Conditions"><?php if(count($settings)>0){echo $settings[0]['terms'];} ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="files" class="col-sm-2 control-label">School Logo</label>
                      <div class="col-md-10">
                      <?php

                        if(count($settings) > 0){

                          if($settings[0]['image'] == ''){
                            echo '<input type="file" name="files" id="files">';
                          }
                          else{
                            echo '<img src="'.base_url().'custom/uploads/admin/images/'.$settings[0]['image'].'" alt="school logo" style="width:100px; height:100px; />"';

                            echo '<br/><br/><br/>';
                            echo 'Change Image: <input type="file" name="files" id="files">';
                          }
                        }
                        else{
                          echo '<input type="file" name="files" id="files">';
                        }

                      ?>
                      </div>                      
                  </div>

                  <!--div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">About Me (100)</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="des" placeholder="About Me"><?php //if(count($profile)>0){echo $profile[0]['description'];} ?></textarea>
                    </div>
                  </div-->
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <?php
                        if(count($settings)>0){
                          echo '<button type="submit" class="btn btn-success pull-right" id="addUpdateSettings">Update</button>';
                        }
                        else{
                          echo '<button type="submit" class="btn btn-success pull-right" id="addUpdateSettings">Add</button>';
                        }
                      ?>                      
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/settings.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/search.js"></script>

<script type="text/javascript">
  
  //Date picker
  $('#datepicker1').datepicker({ 
    autoclose: true
  });

  //Date picker
  $('#datepicker2').datepicker({
    autoclose: true
  });

</script>
</body>
</html>
