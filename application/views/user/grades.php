<?php
    if($this->session->userdata('teacher_id')){

    	//$admin_id = $this->session->userdata('admin_id');
      $teacher_email = $this->session->userdata('email');

        //getting profile data

        $profile = array();

        if($this->session->userdata('profile')){    
            $profile = $this->session->userdata('profile');      
        } 

        //counting courses

        $studentsByClassId = array();

        if($this->session->userdata('studentsByClassId')){    
            $studentsByClassId = $this->session->userdata('studentsByClassId');        
        }        

        $courseToClassById = array();

        if($this->session->userdata('courseToClassById')){    
            $courseToClassById = $this->session->userdata('courseToClassById');     
        }

        $classNameById = array();

        if($this->session->userdata('classNameById')){    
            $classNameById = $this->session->userdata('classNameById');        
        }        

        $courseNameById = array();

        if($this->session->userdata('courseNameById')){    
            $courseNameById = $this->session->userdata('courseNameById');     
        }

        $marksCourseAndClass = array();

        if($this->session->userdata('marksCourseAndClass')){    
            $marksCourseAndClass = $this->session->userdata('marksCourseAndClass');     
        }

        //grades for this subject and class...

        /*echo '<pre>';
        print_r($courseToClassById); 
        echo '</pre>';

        echo '<pre> Students list: ';
        print_r($studentsByClassId); 
        echo '</pre>';*/

        /*echo '<pre>';
        print_r($myClassesList); 
        echo '</pre>';

        echo '<pre>List of Classes: ';
        print_r($classList);
        echo '</pre>';

        echo '<pre>List of Courses: ';
        print_r($marksCourseAndClass);
        echo '</pre>';*/

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
        redirect('teachers/login');
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alpha SMS | Grades</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    .user_pic {
      display: inline-block;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      border: 1px solid black;

      object-fit: cover;
    }
  </style>
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
              <img src="<?php if(count($profile) > 0){ if($profile[0]['image'] != ''){ echo base_url().'custom/uploads/teachers/images/'.$profile[0]['image']; }else{ echo base_url().'assets/dist/img/avatar04.png'; } }else{echo base_url().'assets/dist/img/avatar04.png';} ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if(count($profile)==0){echo 'Profile is not set!';} else{echo $profile[0]['first'].' '.$profile[0]['last'];}?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php if(count($profile) > 0){ if($profile[0]['image'] != ''){ echo base_url().'custom/uploads/teachers/images/'.$profile[0]['image']; }else{ echo base_url().'assets/dist/img/avatar04.png'; } }else{echo base_url().'assets/dist/img/avatar04.png';} ?>" class="img-circle" alt="User Image">

                <p>
                  <?php if(count($profile)==0){echo 'ADMINISTRATOR POST';} else{echo $profile[0]['subjects'];}?>
                  <small><?php echo $teacher_email; ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="../../profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../../../Users/logout" class="btn btn-default btn-flat">Sign out</a>
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
          <img src="<?php if(count($profile) > 0){ if($profile[0]['image'] != ''){ echo base_url().'custom/uploads/teachers/images/'.$profile[0]['image']; }else{ echo base_url().'assets/dist/img/avatar04.png'; } }else{echo base_url().'assets/dist/img/avatar04.png';} ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if(count($profile)==0){echo 'Profile is not set!';} else{echo $profile[0]['first'].' '.$profile[0]['last'];}?></p>
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
            <li><a href="../../dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="../../graphs"><i class="fa fa-line-chart"></i> Progress (Graphs)</a></li>
          </ul>
        </li>
        <!--li class="treeview">
          <a href="teachers">
            <i class="fa fa-black-tie"></i>
            <span>Teachers</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            </span>
          </a>
        </li-->
        <li class="treeview">
          <a href="../../students">
            <i class="fa fa-user"></i>
            <span>Student List</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <!--li class="treeview">
          <a href="grades">
            <i class="fa fa-tasks"></i>
            <span>Grades</span>
            <span class="pull-right-container">
              <!--span class="label label-danger pull-right">4</span-->
            <!--/span>
          </a>
        </li-->
        <li class="active treeview">
          <a href="../../classes">
            <i class="fa fa-cubes"></i>
            <span>My Classes</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            <span>
          </a>
        </li>
        <li class="treeview">
          <a href="../../assignments">
            <i class="fa fa-file-text-o"></i>
            <span>Assignments</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="../../lesson-plans">
            <i class="fa fa-folder-open"></i>
            <span>Lesson Plans</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="../../events">
            <i class="fa fa-calendar"></i>
            <span>Events</span>
            <span class="pull-right-container">
              <!--span class="label label-success pull-right">4</span-->
            </span>
          </a>
        </li>
        <!--li class="treeview">
          <a href="messages">
            <i class="fa fa-comments"></i>
            <span>Messages</span>
            <span class="pull-right-container">
              <!--span class="label label-primary pull-right">4</span-->
            <!--/span>
          </a>
        </li-->
        <li class="header">SYSTEM CONFIG</li>
        <li class="active treeview">
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
            <li><a href="../../profile"><i class="fa fa-pinterest-p"></i> Profile</a></li>
            <li><a href="../../change-password"><i class="fa fa-key"></i> Change Password</a></li>
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
        Grades
        <small>Enter, Update Grades</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grades</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <input type="hidden" id="base" value="<?php echo base_url(); ?>">

      <div class="row">

        <!-- /.col -->
        <div class="col-md-12">

          <!-- /.box -->

          <input type="hidden" id="class_id" value="<?php echo $courseToClassById[0]['class_id']; ?>">
          <input type="hidden" id="course_id" value="<?php echo $courseToClassById[0]['course_id']; ?>">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b><?php if(count($classNameById)>0){ echo $classNameById[0]['name'].' '.$classNameById[0]['level']; } ?></b> grades for <b><?php if(count($courseNameById)>0){ echo $courseNameById[0]['name'].'( '.$courseNameById[0]['short'].' )'; } ?></b></h3>
              &nbsp;Status: <span id="saving">saved!</span>              <!-- tools box -->
              <div class="pull-right box-tools">
                <!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addAdmin"><i class="fa fa-plus"></i></button-->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <?php 
                  	if(count($courseToClassById)>0){

                  		$modules = $courseToClassById[0]['modules'];

                  		for ($i=0; $i < $modules; $i++) { 
                  			echo '<th>M'.($i+1).'</th>';
                  		}
                  	}
                  ?>
                </tr>
                </thead>
                <tbody id="tbody">
	                <?php

	                  if(count($studentsByClassId)>0){ 

	                    for ($i=0; $i < count($studentsByClassId) ; $i++) { //drawing students to table

	                      $modules = $courseToClassById[0]['modules'];
	                      $record_exists = false;

	                      echo '<tr id="'.$studentsByClassId[$i]['id'].'">'.
	                           '<td>'.$studentsByClassId[$i]['student_id'].'</td>'.
	                           '<td>'.$studentsByClassId[$i]['first'].' '.$studentsByClassId[$i]['last'].'</td>';

	                      for ($m=1; $m <= $modules; $m++) { 

	                      	$module_exists = false;

	                      	if(count($marksCourseAndClass)>0){
	                      		//if(($m+1) == )
	                      		for($score = 0; $score < count($marksCourseAndClass); $score++){

	                      			if($studentsByClassId[$i]['id'] == $marksCourseAndClass[$score]['student_id']){

		                      			if($m==$marksCourseAndClass[$score]['module']){
		                      				echo '<td>'.'<input id="'.$marksCourseAndClass[$score]['id'].'" value="'.$marksCourseAndClass[$score]['mark'].'" data-fnx="grade" data-student_id="'.$studentsByClassId[$i]['id'].'" data-module="'.($m).'" type="text" style="width:70px; border: none; background-color: transparent; "/>'.'</td>';

		                      					$module_exists = true;
		                      					break;
		                      			}
	                      			}
								}
	                      	}
	                      	else{
	                      		echo '<td>'.'<input id="" data-fnx="grade" data-student_id="'.$studentsByClassId[$i]['id'].'" data-module="'.($m).'" type="text" style="width:70px; border: none; background-color: transparent;"/>'.'</td>';
	                      	}

	                      	if($module_exists == false && count($marksCourseAndClass)!=0){
	                      		echo '<td>'.'<input id="" data-fnx="grade" data-student_id="'.$studentsByClassId[$i]['id'].'" data-module="'.($m).'" type="text" style="width:70px; border: none; background-color: transparent;"/>'.'</td>';
	                      	}
	                      }
	                    }
	                  }

	                ?>
                </tbody>
                <tfoot>
                <tr>                  
                  <th>Id</th>
                  <th>Name</th>
                  <?php 
                  	if(count($courseToClassById)>0){

                  		$modules = $courseToClassById[0]['modules'];

                  		for ($i=0; $i < $modules; $i++) { 
                  			echo '<th>M'.($i+1).'</th>';
                  		}
                  	}
                  ?>
                </tr>
                </tfoot>
              </table>
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

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/user/grades.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "aaSorting": []
    });
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
