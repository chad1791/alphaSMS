<?php
    if($this->session->userdata('admin_id')){

    	//$admin_id = $this->session->userdata('admin_id');
      $admin_email = $this->session->userdata('email'); 

        //getting profile data

        $profile = array();

        if($this->session->userdata('profile')){    
            $profile = $this->session->userdata('profile');     
        } 

        //getting individual classes

        $ind_class = array();

        if($this->session->userdata('ind_class')){    
            $ind_class = $this->session->userdata('ind_class');     
        }

        /*echo '<pre>';
        print_r($ind_class);
        echo '</pre>';*/

        $course_to_class = array();

        //department for the class...

        $department = $ind_class[0]['department'];
        $homeRoom   = $ind_class[0]['homeroom'];

        if($this->session->userdata('course_to_class')){    
            $course_to_class = $this->session->userdata('course_to_class');     
        } 

        $teachers = array();

        if($this->session->userdata('teachers')){    
            $teachers = $this->session->userdata('teachers');     
        } 

        //getting students data

        $students = array();

        if($this->session->userdata('students')){    
            $students = $this->session->userdata('students');     
        }

        //getting courses by department data

        $coursesByDept = array();

        if($this->session->userdata('coursesByDept')){    
            $coursesByDept = $this->session->userdata('coursesByDept');     
        }

        //getting courses data

        $courses = array();

        if($this->session->userdata('courses')){    
            $courses = $this->session->userdata('courses');     
        }        

        /*echo '<pre>';
        print_r($teachers); 
        echo '</pre>';*/

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
  <title>Alpha SMS | Class Details</title>
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
  <!-- toastr messages link css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>   

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
                  <a href="../Admins/logout" class="btn btn-default btn-flat">Sign out</a>
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
            <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="../graphs"><i class="fa fa-line-chart"></i> Graphs</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="../teachers">
            <i class="fa fa-black-tie"></i>
            <span>Teachers</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="../students">
            <i class="fa fa-user"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="active treeview">
          <a href="../classes">
            <i class="fa fa-cubes"></i>
            <span>Classes</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="../courses">
            <i class="fa fa-mortar-board"></i>
            <span>Courses</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">4</span>
            </span>
          </a>
        </li>
        <!--li class="treeview">
          <a href="../events">
            <i class="fa fa-calendar"></i>
            <span>Events</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="../messages">
            <i class="fa fa-comments"></i>
            <span>Messages</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li-->
        <li class="treeview">
          <a href="../attendance">
            <i class="fa fa-check-square-o"></i>
            <span>Attendance</span>
            <span class="pull-right-container">
              <!--span class="label label-warning pull-right">4</span-->
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="../lesson-plans">
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
            <li><a href="../administrators"><i class="fa fa-users"></i> Administrators</a></li>
            <li><a href="../profile"><i class="fa fa-pinterest-p"></i> Profile</a></li>
            <li><a href="../settings"><i class="fa fa-gear"></i> Settings</a></li>
            <li><a href="../report-cards"><i class="fa fa-stack-overflow"></i> Report Cards</a></li>
            <li><a href="../change-password"><i class="fa fa-key"></i> Change Password</a></li> 
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php 
          
          if(count($ind_class) > 0){
            echo $ind_class[0]['name']. ' ' .$ind_class[0]['level'] ; 
          }  
          else{
            echo 'Error, Class data not found! Click <a href="../classes">here</a> to go back!';
          }

          ?>

          <small>Manage Class</small> 
          
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Class Settings</li>
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
              <h3 class="box-title">
                <?php
                  if(count($ind_class) > 0){
                    echo $ind_class[0]['name']. ' ' .$ind_class[0]['level'] . ' Course List' ; 
                  }
                  ?>                
              </h3>
                            <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#assignHomeRoom" data-backdrop="static" data-keyboard="false"><i class="fa fa-gear"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#assignCourse" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Course Name</th>
                  <th>Teacher Name</th>
                  <th># of Modules</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                  <?php

                    for ($i=0; $i < count($course_to_class) ; $i++) { 

                      for($t=0; $t < count($teachers); $t++){
                        if($course_to_class[$i]['teacher_id']==$teachers[$t]['id']){
                          $teacherName = $teachers[$t]['first'].' '.$teachers[$t]['last'];
                          break;
                        }
                      }

                      for($c=0; $c < count($courses); $c++){
                        if($course_to_class[$i]['course_id']==$courses[$c]['id']){
                          $courseName = $courses[$c]['name'].' ('.$courses[$c]['short']. ')';
                          break;
                        }
                      }

                      echo '<tr id="'.$course_to_class[$i]['id'].'">'.
                           '<td>'.$courseName.'</td>'.
                           '<td>'.$teacherName.'</td>'.
                           '<td>'.$course_to_class[$i]['modules'].'</td>'.
                           '<td><button class="btn btn-success" data-fnx="view" data-view_id="'.$course_to_class[$i]['id'].'" data-toggle="modal" data-target="#viewAdmin"><i class="fa fa-eye"></i></button>&nbsp;<button class="btn btn-primary" data-fnx="update" data-up_id="'.$course_to_class[$i]['id'].'" data-toggle="modal" data-target="#updateAdmin"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger" data-fnx="delete" data-rem_id="'.$course_to_class[$i]['id'].'"><i class="fa fa-times"></i></button></td>'.
                           '</tr>';
                    }

                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Course Name</th>
                  <th>Teacher Name</th>
                  <th># of Modules</th> 
                  <th>Options</th>
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

        <div class="modal" id="assignCourse">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddCourseToClassClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Assign Course</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <!-- addCourseToClass -->

                  <input type="hidden" name="class" id="class" value="<?php echo $ind_class[0]['id']; ?>">

                  <div class="form-group">
                    <label for="courseList" class="col-sm-3 control-label">Course</label>
                    <div class="col-sm-8">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->
                      <select class="form-control" name="courseList" id="courseList">
                        <?php

                          if($department == 0){

                            if(count($coursesByDept)>0){

                              //$cells = array_values($courses[0]);

                              for($i = 0; $i < count($coursesByDept); $i++){
                                echo '<option value="'.$coursesByDept[$i]['id'].'">'.$coursesByDept[$i]['name']. ' ( ' .$coursesByDept[$i]['short'].' )</option>';
                              }
                            }

                          }
                          else
                          if($department == 1){

                            if(count($courses)>0){

                              //$cells = array_values($courses[0]);

                              for($i = 0; $i < count($courses); $i++){
                                echo '<option value="'.$courses[$i]['id'].'">'.$courses[$i]['name']. ' ( ' .$courses[$i]['short'].' )</option>';
                              }
                            }


                          }



                        ?>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="teacherList" class="col-sm-3 control-label">Teacher</label>
                    <div class="col-sm-8">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->
                      <select class="form-control" name="teacherList" id="teacherList">
                        <?php

                          if(count($teachers)>0){

                            //$cells = array_values($courses[0]);

                            for($i = 0; $i < count($teachers); $i++){
                              echo '<option value="'.$teachers[$i]['id'].'">'.$teachers[$i]['first'].' '.$teachers[$i]['last'].'</option>';
                            }
                          }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="moduleList" class="col-sm-3 control-label"># of Modules</label>
                    <div class="col-sm-8">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->


                      <select class="form-control" name="moduleList" id="moduleList">

                        <?php 

                          if($department == 0){
                            echo '<option value="1">1</option>';
                          }
                          else{

                            for ($m=1; $m <= 15; $m++) { 
                              echo '<option value="'.$m.'">'.$m.'</option>';
                            }

                          }

                        ?>
                        <!--option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option-->
                      </select>
                    </div>
                  </div>                                                                                                   

               </form>
              </div>
              <div class="modal-footer"> 
                <button id="addCourseToClassClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addCourseToClassBtn" type="button" class="btn btn-primary">Add</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal" id="assignHomeRoom">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddCourseToClassClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Assign HomeRoom</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <!-- addCourseToClass -->

                  <input type="hidden" name="class" id="class" value="<?php echo $ind_class[0]['id']; ?>">

                  <div class="form-group">
                    <label for="teacher_id" class="col-sm-3 control-label">Teacher</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="teacher_id" id="teacher_id">
                        <?php

                          if(count($teachers)>0){

                            for($i = 0; $i < count($teachers); $i++){

                              if($homeRoom == $teachers[$i]['id']){
                                echo '<option value="'.$teachers[$i]['id'].'" selected="selected">'.$teachers[$i]['first'].' '.$teachers[$i]['last'].'</option>';
                              }
                              else{

                                if($i == 0){
                                  echo '<option value="0" style="color:gray;">Select Teacher</option>';
                                }

                                echo '<option value="'.$teachers[$i]['id'].'">'.$teachers[$i]['first'].' '.$teachers[$i]['last'].'</option>';
                              }
                              
                            }
                          }

                        ?>
                      </select>
                    </div>
                  </div>                                                                                                  

               </form>
              </div>
              <div class="modal-footer"> 
                <button id="addCourseToClassClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addHomeRoomBtn" type="button" class="btn btn-primary">Assign</button> 
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
                  echo form_open('Admins/addAdmin',$attributes); 

                ?>
                 
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-5 control-label">Course Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewCourse"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-5 control-label">Teacher Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewTeacher"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-5 control-label"># of Modules</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewModules"></label>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Status</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewStatus"></label> 
                    </div>
                  </div>                                   
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
                <h4 class="modal-title">Update Course Info</h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'updateAdminForm');
                  echo form_open('Admins/updateCourseToClass',$attributes); 

                ?> 

                  <input type="hidden" name="courseToClassDbId" id="courseToClassDbId"></input> 
                  <input type="hidden" name="classId" id="classId"></input>
                 
                  <div class="form-group">
                    <label for="upCourseName" class="col-sm-3 control-label">Course Name</label>

                    <div class="col-sm-8">
                      <select class="form-control" name="upCourseName" id="upCourseName"></select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upTeacherName" class="col-sm-3 control-label">Teacher Name</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="upTeacherName" id="upTeacherName"></select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upNumOfModules" class="col-sm-3 control-label"># of Modules</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="upNumOfModules" id="upNumOfModules">

                        <?php 

                          if($department == 0){
                            echo '<option value="1">1</option>';
                          }
                          else{

                            for ($m=1; $m <= 15; $m++) { 
                              echo '<option value="'.$m.'">'.$m.'</option>';
                            }

                          }

                        ?>
                                                
                        <!--option value="1">1</option> 
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option-->                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upStatus" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="upStatus" id="upStatus"></select>
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
<!-- toastr link js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/courseToClass.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/search.js"></script>
</body>
</html>
