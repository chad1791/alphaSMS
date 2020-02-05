<?php
    if($this->session->userdata('student_id')){

    	//$admin_id = $this->session->userdata('admin_id');
      $student_email = $this->session->userdata('email');
      //echo $admin_email;

        //getting profile data

        $stdProfile = array();

        if($this->session->userdata('stdProfile')){    
            $stdProfile = $this->session->userdata('stdProfile'); 
            //$ad_id = $profile[0]['id'];       
        }

        //getting my class data

        $myClass = array(); //myUploadedFiles

        if($this->session->userdata('myClass')){    
            $myClass = $this->session->userdata('myClass'); 
            //$ad_id = $profile[0]['id'];       
        }

        //print_r($profile);

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
  <title>Alpha SMS | Profile</title>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-university"></i> <span>Home</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="graphs"><i class="fa fa-line-chart"></i> Progress (Graphs)</a></li>
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
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Account Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--li class="active"><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li-->
            <!--li><a href="administrators"><i class="fa fa-users"></i> Administrators</a></li-->
            <li class="active"><a href="profile"><i class="fa fa-pinterest-p"></i> Profile</a></li>
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
        My Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Administrative Tasks</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

	    <?php if($this->session->flashdata('upProfile_success')): ?>
	      <?php echo '<p class="alert alert-success col-sm-11 col-md-11 col-lg-11" style="margin-left:15px;">'.$this->session->flashdata('upProfile_success').'</p>' ?>
	    <?php endif ;?>

        <input type="hidden" name="base_url" id="base_url" value="<?=base_url();?>">
        <input type="hidden" name="student_id" id="student_id" value="<?=$this->session->userdata('student_id'); ?>">

        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <!--img class="profile-user-img img-responsive img-circle" src="<?php //echo base_url(); ?>assets/dist/img/user4-128x128.jpg" alt="Profile picture"-->

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
                " class="profile-user-img img-responsive img-circle" alt="User Image">                           

              <h3 class="profile-username text-center"><?php if(count($stdProfile)>0){ echo $stdProfile[0]['first'].' '.$stdProfile[0]['last']; }else{ echo 'John Deo'; }?></h3>

              <p class="text-muted text-center"><?php if(count($myClass)>0){ echo $myClass[0]['name'].' - '.$myClass[0]['level']; }else{ echo 'Class Name'; }?></p>

              <!--ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul-->

	            <div class="box-body">

 				  <hr>

	              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

	              <p class="text-muted">
	              	<?php if(count($stdProfile)>0){ echo $stdProfile[0]['address']; }else{ echo 'Malibu, California'; }?>
	          	  </p>

	              <hr>

	              <strong><i class="fa fa-file-text-o margin-r-5"></i> About Me</strong>

	              <p id="cardBio">
	              	<?php if(count($stdProfile)>0){ echo $stdProfile[0]['bio']; }else{ echo ''; }?>
	              
	          	  </p>
	            </div>

              <!--a href="#" class="btn btn-primary btn-block"><b>Follow</b></a-->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <!--li class="active"><a href="#activity" data-toggle="tab">Activity</a></li-->
              <!--li><a href="#timeline" data-toggle="tab">Timeline</a></li-->
              <li class="active"><a href="#settings" data-toggle="tab">My Info</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="settings">
                <!--form class="form-horizontal"-->
                
                <?php 

                	$attributes = array('class' => 'form-horizontal');
                	echo form_open('Admins/updateProfile',$attributes); 

                ?>
                  <div class="form-group">

                    <input type="hidden" name="student_id" id="student_id" value="<?=$stdProfile[0]['id']?>">

                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($stdProfile)>0){echo $stdProfile[0]['first'];} ?>" class="form-control" id="inputName" name="first" placeholder="First Name" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Middle Name</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($stdProfile)>0){echo $stdProfile[0]['middle'];} ?>" class="form-control" id="inputName" name="middle" placeholder="Middle Name" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($stdProfile)>0){echo $stdProfile[0]['last'];} ?>" class="form-control" id="inputName" name="last" placeholder="Last Name" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" value="<?php echo $student_email; ?>" class="form-control" id="inputEmail" name="email" placeholder="Email" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Cell</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($stdProfile)>0){echo $stdProfile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php if(count($stdProfile)>0){echo $stdProfile[0]['address'];} ?>" class="form-control" id="inputSkills" name="address" placeholder="Address" readonly>
                    </div>
                  </div>
                  <!--div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Post</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php //if(count($stdProfile)>0){echo $stdProfile[0]['position'];} ?>" class="form-control" id="inputSkills" name="post" placeholder="Post">
                    </div>
                  </div-->
                  <!--div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Education</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="education" placeholder="Education"><?php //if(count($stdProfile)>0){echo htmlspecialchars($stdProfile[0]['education']) ;} ?></textarea>
                    </div>
                  </div-->
                  <div class="form-group">
                    <label for="myBio" class="col-sm-2 control-label">About Me (100)</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="myBio" name="des" placeholder="About Me"><?php if(count($stdProfile)>0){echo htmlspecialchars($stdProfile[0]['bio']);} ?></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success" id="upBtn">Update</button>
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

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/student/profile.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/student/comet.js"></script> 

</body>
</html>
