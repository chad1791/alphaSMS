<?php
    if($this->session->userdata('teacher_id')){

    	//$admin_id = $this->session->userdata('admin_id');
      $teacher_email = $this->session->userdata('email');

      $timezone = new \DateTimeZone('America/Belize'); 
      $date = new \DateTime('@' . time(), $timezone);
      $date->setTimezone($timezone);
      $today = $date->format('Y-m-d H:i:s');
      $today_words = $date->format('F j, Y');
      $today_short = $date->format('Y-m-d');

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

        $attendanceCourseAndClass = array(); 

        if($this->session->userdata('attendanceCourseAndClass')){    
            $attendanceCourseAndClass = $this->session->userdata('attendanceCourseAndClass');     
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
        echo '</pre>';*/

        //echo '<pre>List of Attendance for today: ';
        //print_r($attendanceCourseAndClass);
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
        redirect('teachers/login');
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
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">

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
        Attendance
        <small>Enter, Update Attendance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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

          <input type="hidden" id="class_id" value="<?php echo $courseToClassById[0]['class_id']; ?>">
          <input type="hidden" id="course_id" value="<?php echo $courseToClassById[0]['course_id']; ?>">
          <input type="hidden" id="today" value="<?php echo $today_short; ?>">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b><?php if(count($classNameById)>0){ echo $classNameById[0]['name'].' '.$classNameById[0]['level']; } ?></b> attendance for <b><?php if(count($courseNameById)>0){ echo $courseNameById[0]['name'].'( '.$courseNameById[0]['short'].' )'; } ?></b></h3>
              &nbsp;Status: <span id="saving">saved!</span>              <!-- tools box -->
              <!--div class="pull-right box-tools">
                <div class="input-group date col-md-2 col-lg-2 col-sm-2 col-xs-2 pull-right">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="datepicker">
                </div>
                
              </div-->
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Student Id</th>
                  <th>Name</th>
                  <th><?php echo $today_words; ?></th>
                  <th>Remarks</th>
                </tr>
                </thead>
                <tbody id="tbody">
	                <?php

	                  if(count($studentsByClassId)>0){ 

	                    for ($i=0; $i < count($studentsByClassId) ; $i++) { //drawing students to table

	                      echo '<tr>'.
	                           '<td>'.$studentsByClassId[$i]['student_id'].'</td>'.
	                           '<td>'.$studentsByClassId[$i]['first'].' '.$studentsByClassId[$i]['last'].'</td>';                            

                             if(count($attendanceCourseAndClass)>0){ //check to see if teacher has taken attencance already....

                                $attendance_exists = false;

                                for ($a=0; $a < count($attendanceCourseAndClass); $a++) {
                                  if($attendanceCourseAndClass[$a]['student_id'] == $studentsByClassId[$i]['id']){ //draw cells with id...

                                    $attencance_status = $attendanceCourseAndClass[$a]['attendance'];

                                    //for loop to draw each attendance status....

                                    echo '<td>';
                                    $att_stat_word = 'Present';

                                    for ($s=1; $s <= 5; $s++) { 

                                      switch($s){
                                        case 2:
                                          $att_stat_word = 'Absent';
                                        break;
                                        case 3:
                                          $att_stat_word = 'Late';
                                        break;
                                        case 4:
                                          $att_stat_word = 'Sick';
                                        break;
                                        case 5:
                                          $att_stat_word = 'Dismissed';
                                        break;
                                      }

                                      if($attencance_status == $s){
                                        $checked = 'checked=""';
                                      }
                                      else{
                                        $checked = '';
                                      }

                                      echo '<div class="radio" style="margin-right:10px;">'.
                                              '<label>'.
                                                '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" data-db_id="'.$attendanceCourseAndClass[$a]['id'].'" value="'.$s.'" '. $checked .' style="margin-right:1px;" data-att="option" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                                 $att_stat_word. 
                                              '</label>'.
                                           '</div>';
                                    }

                                    echo '</td>';
                                    echo '<td><input data-att_id="'.$attendanceCourseAndClass[$a]['id'].'" data-fnx="remarks" style="width:99%; padding:0px;" value="'.$attendanceCourseAndClass[$a]['remarks'].'"/></td>';

                                    $attendance_exists = true;
                                    break;
                                  }
                                }

                                if($attendance_exists == false){ //draw cells without id...

                                    echo '<td>'. 
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="1" style="margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Present '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="2" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Absent '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="3" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Late '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="4" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Sick '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="5" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Dismissed '.
                                        '</label>'.
                                      '</div>'.
                                    '</td>'.
                                    '<td></td>';
                                  //'<td><input id="'.$studentsByClassId[$i]['id'].'" data-fnx="remarks" data-attendance_id="" type="text" style="width:99%; padding:0px;" disabled=""/></td>';
                                    //'<td><button class="btn btn-primary"><i class="fa fa-plus"></i></button></td>';
                                }

                             }
                             else{ //if array of attendance is empty, teacher has not taken attendance as yet!

                                    echo '<td>'. 
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="1" style="margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Present '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="2" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Absent '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="3" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Late '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="4" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Sick '.
                                        '</label>'.
                                      '</div>'.
                                      '<div class="radio">'.
                                        '<label>'.
                                          '<input type="radio" name="optionsRadios'. $studentsByClassId[$i]['id'] .'" id="" value="5" style="margin-left:10px; margin-right:1px;" data-att="option" data-db_id="" data-student_id="'.$studentsByClassId[$i]['id'].'">'.
                                          'Dismissed '.
                                        '</label>'.
                                      '</div>'.
                                    '</td>'.
                                    '<td></td>';
                                  //'<td><input id="'.$studentsByClassId[$i]['id'].'" data-fnx="remarks" data-attendance_id="" type="text" style="width:99%; padding:0px;" disabled=""/></td>';
                                    //'<td><button class="btn btn-primary"><i class="fa fa-plus"></i></button></td>';

                             }
	                    }
	                  }

	                ?>
                </tbody>
                <tfoot>
                <tr>                  
                  <th>Student Id</th>
                  <th>Name</th>
                  <th><?php echo $today_words; ?></th>
                  <th>Remarks</th>
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
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/user/attendance.js"></script>

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

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
</script>

</body>
</html>
