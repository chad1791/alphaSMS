 <?php
    if($this->session->userdata('admin_id')){

      //$admin_id = $this->session->userdata('admin_id');
      $admin_email = $this->session->userdata('email');

        //getting profile data

        $profile = array();

        if($this->session->userdata('profile')){    
            $profile = $this->session->userdata('profile');     
        } 

        //getting classes list

        $classes = array();

        if($this->session->userdata('classes')){    
            $classes = $this->session->userdata('classes');     
        } 

        /*echo '<pre>';
        print_r($classes);
        echo '</pre>';*/

        //getting courses list

        $courses = array();

        if($this->session->userdata('courses')){    
            $courses = $this->session->userdata('courses');     
        }  

        //getting levels list

        $levels = array();

        if($this->session->userdata('levels')){    
            $levels = $this->session->userdata('levels');     
        }  

        //print_r($levels[0]);

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
  <title>Alpha SMS | Attendance</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- toastr messages link css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>   
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
                  <small><?php if(count($profile)==0){echo 'someone@email.com';} else{echo $profile[0]['email'];}?></small>
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
        <li class="active treeview">
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
        <li class="treeview">
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
            <li><a href="report-cards"><i class="fa fa-stack-overflow"></i> Report Cards</a></li>
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
        Attendance
        <small>Manage Attendance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <input type="hidden" id="base" value="<?php echo base_url(); ?>">

      <div class="row">

        <!-- /.col -->
        <div class="col-md-12">

          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>Filter Parameters for Attendance</b></h3>
                            <!-- tools box -->
              <div class="pull-right box-tools">
                <!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addCourse" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button-->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height: auto;">

            	<form class="form-horizontal" action="#" >
	                <div class="col-sm-3">
	                	<b>Select Class:</b> 
	                    <select class="form-control" id="className" name="className">
	                      <?php 
	                      	for ($i=0; $i < count($classes); $i++) { 
	                      		echo '<option value="'.$classes[$i]['id'].'">'.$classes[$i]['name'].' - '. $classes[$i]['level'] .'</option>';
	                      	}
	                      ?>
	                    </select>
	                </div>
					<div class="col-sm-3">
	                	<b>Select Course:</b> 
	                    <select class="form-control" id="courseName" name="courseName"></select>
	                </div>	                 
	                <div class="col-sm-2">
	                	<b>From:</b> 
	                    <input type="text" class="form-control pull-right" id="datepicker" autocomplete="off">
	                </div> 
	                <div class="col-sm-2">
	                	<b>To:</b> 
	                    <input type="text" class="form-control pull-right" id="datepicker2" autocomplete="off">
	                </div> 
					<div class="col-sm-1">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b></b>
	                	<button class="btn btn-primary pull-right" name="go" id="go">Go</button>
	                </div>	                	                	                                  	
                </form>             
              <!-- body for the lesson plan submission list -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><span id="classNameParam">Class Name</span></h3>
                            <!-- tools box -->
              <div class="pull-right box-tools">
                <!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addCourse" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button-->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height: 310px;">


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
          
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
        <div class="modal" id="addCourse">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddCourseClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Add Course</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal"> 
                  <!-- addTeacher -->

                  <div class="form-group">
                    <label for="short_name" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Course Short Name"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="course" class="col-sm-3 control-label">Submit By</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="course" name="course" placeholder="Course Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="type" class="col-sm-3 control-label">Time</label>

                    <div class="col-sm-8">
                      <!--input type="text" class="form-control" id="course" name="course" placeholder="Course Name"-->
                      <select class="form-control" id="type" name="type">
                        <option value="0">Support</option>
                        <option value="1">Trade</option>
                      </select>
                    </div>
                  </div>                                                                                                   
               </form>
              </div>
              <div class="modal-footer"> 
                <button id="addCourseClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addCourseBtn" type="button" class="btn btn-primary">Add</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        <div class="modal" id="viewAdmin">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #00a65a; color:white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Course Info</h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'addAdminForm');
                  echo form_open('Admins/addCourse',$attributes); 

                ?>
                 
                  <div class="form-group">
                    <label for="viewShort" class="col-sm-4 control-label">Short Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewShort"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="viewCourse" class="col-sm-4 control-label">Course Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewCourse"></label>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="viewType" class="col-sm-4 control-label">Type</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewType"></label>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="viewStatus" class="col-sm-4 control-label">Status</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewStatus"></label>
                    </div>
                  </div>              
                  <div class="form-group">
                    <label for="viewDescription" class="col-sm-4 control-label">Description</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewDescription"></label>
                    </div>
                  </div> 
                  <!--div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Settings</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewSettings"></label> 
                    </div>
                  </div-->                                   
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

       <div class="modal" id="updateAdmin">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Course Info Form</h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'updateAdminForm');
                  echo form_open('Admins/updateCourse',$attributes); 

                ?> 

                  <input type="hidden" name="courseDbId" id="courseDbId"></input>
                 
                  <div class="form-group">
                    <label for="upShortName" class="col-sm-3 control-label">Short Name</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="upShortName" name="upShortName" placeholder="Short Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upCourseName" class="col-sm-3 control-label">Course Name</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="upCourseName" name="upCourseName" placeholder="Course Name">
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="upType" class="col-sm-3 control-label">Type</label>

                    <div class="col-sm-8">
                      <!--input type="text" class="form-control" id="upCourseName" name="upCourseName" placeholder="Course Name"-->
                      <select class="form-control" id="upType" name="upType">
                        <!--option>Support</option-->
                      </select>
                    </div>
                  </div>                   
                  <div class="form-group">
                    <label for="upStatus" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-8">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->
                      <select class="form-control" name="upStatus" id="upStatus">
                        <!--option value="1">Active</option>
                        <option value="0">Inactive</option-->
                      </select>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="upDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="upDesc" name="upDesc" placeholder="Description"></textarea>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" form="updateAdminForm" class="btn btn-primary">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

 
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
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- toastr link js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/attendance.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/search.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "aaSorting": [],
      "columns": [
        null,
        null,
        null,
        null,
        { "width": "15%" }
      ]      
    });

    $('#datepicker').datepicker({
      autoclose: true,
      format: 'M dd, yyyy',
      immediateUpdates: true,
      todayBtn: true,
      todayHighlight: true
    })
    .datepicker("setDate", "0");    

    $('#datepicker2').datepicker({
      autoclose: true,
      format: 'M dd, yyyy',
      immediateUpdates: true,
      todayBtn: true,
      todayHighlight: true
    })
    .datepicker("setDate", "0");  

    /*$('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });*/
  });
</script>

</body>
</html>
