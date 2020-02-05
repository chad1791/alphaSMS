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

        $courseList = array();

        if($this->session->userdata('courseList')){    
            $courseList = $this->session->userdata('courseList');        
        }        

        //getting classes list 

        $myClassesListSingle = array();

        if($this->session->userdata('myClassesListSingle')){    
            $myClassesListSingle = $this->session->userdata('myClassesListSingle');     
        }

        $classList = array();

        if($this->session->userdata('classList')){    
            $classList = $this->session->userdata('classList');     
        }

        $myAddedAssignments = array();

        if($this->session->userdata('myAddedAssignments')){    
            $myAddedAssignments = $this->session->userdata('myAddedAssignments');     
        }

        //echo '<pre>'; 
        //print_r($myClassesListSingle); 
        //echo '</pre>';

        /*echo '<pre>List of Classes: ';
        print_r($classList);
        echo '</pre>';

        echo '<pre>List of Courses: ';
        print_r($courseList);
        echo '</pre>';

        echo '<pre>List of Courses: ';
        print_r($myAddedAssignments);
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
  <title>Alpha SMS | Assignments</title>
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
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">  
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">

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
                  <a href="profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../Users/logout" class="btn btn-default btn-flat">Sign out</a>
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
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="graphs"><i class="fa fa-line-chart"></i> Progress (Graphs)</a></li>
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
          <a href="students">
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
        <li class="treeview">
          <a href="classes">
            <i class="fa fa-cubes"></i>
            <span>My Classes</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">4</span>
            <span>
          </a>
        </li>
        <li class="active treeview">
          <a href="assignments">
            <i class="fa fa-file-text-o"></i>
            <span>Assignments</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="lesson-plans">
            <i class="fa fa-folder-open"></i>
            <span>Lesson Plans</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="events">
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
            <li><a href="profile"><i class="fa fa-pinterest-p"></i> Profile</a></li>
            <li><a href="change-password"><i class="fa fa-key"></i> Change Password</a></li>
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
        Assignments
        <small>Enter, Update Assignments</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Assignments</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <input type="hidden" id="base" value="<?php echo base_url(); ?>">
      <input type="hidden" id="teacher_id" value="<?php echo $this->session->userdata('teacher_id'); ?>">

      <div class="row">

      <?php if($this->session->flashdata('AssignmentAdded_success')): ?>
        <?php echo '<p class="alert alert-success col-sm-11 col-md-11 col-lg-11" style="margin-left:15px;">'.$this->session->flashdata('AssignmentAdded_success').'</p>' ?>
      <?php endif ;?>

      <?php if($this->session->flashdata('delClass_success')): ?>
        <?php echo '<p class="alert alert-success col-sm-11 col-md-11 col-lg-11" style="margin-left:15px;">'.$this->session->flashdata('delClass_success').'</p>' ?>
      <?php endif ;?>

      <?php if($this->session->flashdata('upClass_success')): ?>
        <?php echo '<p class="alert alert-success col-sm-11 col-md-11 col-lg-11" style="margin-left:15px;">'.$this->session->flashdata('upClass_success').'</p>' ?>
      <?php endif ;?>

      <?php if($this->session->flashdata('delClass_error')): ?>
        <?php echo '<p class="alert alert-danger col-sm-11 col-md-11 col-lg-11" style="margin-left:15px;">'.$this->session->flashdata('delClass_error').'</p>' ?>
      <?php endif ;?> 


        <!-- /.col -->
        <div class="col-md-4">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <!--li class="active"><a href="#activity" data-toggle="tab">Activity</a></li-->
              <!--li><a href="#timeline" data-toggle="tab">Timeline</a></li-->
              <li class="active"><a href="#settings" data-toggle="tab">New Assignment</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="settings">
                <!--form class="form-horizontal"-->
                
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'assignmentsForm');
                  echo form_open('Admins/addClass',$attributes); 

                ?>
                  
                  <div class="form-group">
                    <label for="className" class="col-sm-4 control-label">Class Name</label>
                    <div class="col-sm-8">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->
                      <select class="form-control" name="level" id="className">
                        <?php

                          if(count($myClassesListSingle)>0){

                            for($i = 0; $i < count($myClassesListSingle); $i++){
                              //
                              for ($c=0; $c < count($classList); $c++) { 
                                if($classList[$c]['id'] == $myClassesListSingle[$i]['class_id']){
                                  echo '<option value="'.$classList[$c]['id'].'">'.$classList[$c]['name'].' - '.$classList[$c]['level'].'</option>';
                                  break;
                                }
                              }
                            }
                          }

                        ?>
                      </select> 
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="className" class="col-sm-4 control-label">Course Name</label>

                    <div class="col-sm-8">
                      <select class="form-control" name="courseList" id="courseList"></select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="title" class="col-sm-4 control-label">Assignment Title</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="title" name="title" placeholder="Assignment Title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="desc" class="col-sm-4 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea class="form-control" name="desc" id="desc" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="optionsRadios1" class="col-sm-4 control-label">Expiry Date</label>
                    <div class="col-sm-4">
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios1" id="optionsRadios1" value="0" style="margin-right:3px; margin-right:1px;" data-att="option" data-db_id="" checked="" data-radio="open">Open</label>
                      </div>
                    </div>                      
                    <div class="col-sm-4">
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios1" id="optionsRadios1" value="1" style="margin-right:3px; margin-right:1px;" data-att="option" data-db_id="" data-radio="close">Set
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" data-set_date="set" style="display:none;">
                    <label for="datepicker" class="col-sm-4 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker">
                      </div>                     
                    </div>                  
                  </div> 
                  <div class="form-group" data-set_date="set" style="display:none;">
                    <label for="timepicker1" class="col-sm-4 control-label">Time</label>
                    <div class="col-sm-8">
                      <!-- time Picker -->
                      <div class="bootstrap-timepicker">
                          <div class="input-group">
                            <input type="text" class="form-control timepicker" id="timepicker1">
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                          <!-- /.input group -->                        
                      </div>
                    </div>                  
                  </div>
                  <div class="form-group">
                    <label for="allow_upload" class="col-sm-4 control-label">Permissions</label>
                    <div class="checkbox col-sm-8">
                      <label>
                        <input type="checkbox" checked="" id="allow_upload"> Allow students to upload assignments
                      </label>
                    </div>
                  </div>                   
                  <div class="form-group">
                    <label for="behaviour" class="col-sm-4 control-label">Behaviour</label>
                    <div class="checkbox col-sm-8">
                      <label>
                        <input type="checkbox" checked="" id="behaviour"> Deactivate after expiry date
                      </label>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label for="behaviour" class="col-sm-4 control-label">Attachments</label>
                    <div class="col-sm-8">
                      <label>
                        <input type="file" id="files" name='files' multiple>
                      </label>
                    </div>
                  </div>
                  <!--div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label">Attachments</label>
                    <div class="col-sm-8">
                      <div style="border: 1px dashed grey; height: 100px;">
                        <center><span style="line-height: 7;">Drop files to upload!</span></center>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label">Files</label>
                      <div class="col-sm-8">
                        <div style="border: 1px solid grey; height: 50px;">
                          
                        </div>
                      </div>
                  </div-->
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-success pull-right" id="addAssignment">Add</button>
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

        <!-- /.col -->
        <div class="col-md-8">

          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Assignments</h3>
                            <!-- tools box -->
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
                  <th>Class</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Expiry Date</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php

                    for ($i=0; $i < count($myAddedAssignments) ; $i++) { 

                      $className = '';
                      $courseName = '';
                      $title = '';

                      if(strlen($myAddedAssignments[$i]['title']) > 10){
                        $title = substr($myAddedAssignments[$i]['title'], 0, 10).'...';
                      }
                      else{
                        $title = $myAddedAssignments[$i]['title'];
                      }

                      if($myAddedAssignments[$i]['expiry_date'] == '')
                      {
                        $date = 'Open';
                      }
                      else{
                        $date = $myAddedAssignments[$i]['expiry_date'];
                      }

                      for ($c=0; $c < count($classList); $c++) { 
                        if($classList[$c]['id'] == $myAddedAssignments[$i]['class_id']){
                          $className = $classList[$c]['name']. ' - ' . $classList[$c]['level'];
                          break;
                        }
                      }

                      for ($cL=0; $cL < count($courseList); $cL++) { 
                        if($courseList[$cL]['id'] == $myAddedAssignments[$i]['course_id']){
                          
                          $courseName = $courseList[$cL]['short'];
                          break;

                        }
                      }

                      echo '<tr id="'.$myAddedAssignments[$i]['id'].'">'.
                           '<td>'.$className.'</td>'.
                           '<td>'.$courseName.'</td>'.
                           '<td>'.$title.'</td>'.
                           '<td>'.$date.'</td>'.
                           '<td><button class="btn btn-success" data-fnx="view" data-view_id="'.$myAddedAssignments[$i]['id'].'"><i class="fa fa-eye"></i></button>&nbsp;<button class="btn btn-primary" data-fnx="update" data-up_id="'.$myAddedAssignments[$i]['id'].'"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger" data-fnx="delete" data-rem_id="'.$myAddedAssignments[$i]['id'].'"><i class="fa fa-times"></i></button></td>'.
                           '</tr>'; 
                    }

                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Class</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Expiry Date</th>
                  <th>Actions</th>
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


        <div class="modal" id="viewAdmin">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #00a65a; color:white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id="assTitleView"></span></h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'addAdminForm');
                  echo form_open('Admins/addAdmin',$attributes); 

                ?>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Assignment Dets. </label>

                    <div class="col-xs-12 col-sm-12 col-lg-12">                      
                      <!--label class="control-label" style="font-weight: normal;" id="viewName"></label-->
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-1 control-label"></label>

                    <div class="col-xs-11 col-sm-11 col-lg-11">                      
                      <!--label class="control-label" style="font-weight: normal;" id="viewName"></label-->
                      <span id="assBody" style="font-weight: normal;"></span>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-1 control-label"></label>

                    <div class="col-xs-11 col-sm-11 col-lg-11">                      
                      <!--label class="control-label" style="font-weight: normal;" id="viewName"></label-->
                      <span id="assUploads" style="font-weight: normal;"></span>
                    </div>
                  </div>                   
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Student Uploads </label>

                    <div class="col-xs-12 col-sm-12 col-lg-12" id="studentUploads"></div> 
                  </div> 
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-1 control-label"></label>

                    <div class="col-xs-11 col-sm-11 col-lg-11">                      
                      <!--label class="control-label" style="font-weight: normal;" id="viewName"></label-->
                      <span id="stdUploads" style="font-weight: normal;">No files have been uploaded as yet!</span>
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
                <h4 class="modal-title"><span id="assTitleUpdate"></span></h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'updateAdminForm');
                  echo form_open('Admins/updateClass',$attributes); 

                ?> 

                  <input type="hidden" name="assignmentDbId" id="assignmentDbId"></input> 

                  <div class="form-group">
                    <label for="upClassName" class="col-sm-3 control-label">Class Name</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="upClassName" id="upClassName" style="font-weight: normal;"></select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="upCourseList" class="col-sm-3 control-label">Course Name</label>

                    <div class="col-sm-8">
                      <select class="form-control" name="upCourseList" id="upCourseList" style="font-weight: normal;"></select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="upTitle" class="col-sm-3 control-label">Assignment Title</label> 

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="upTitle" name="upTitle" placeholder="Assignment Title" style="font-weight: normal;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea class="form-control" name="upDesc" id="upDesc" rows="3" style="font-weight: normal;"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="optionsRadios1" class="col-sm-3 control-label">Expiry Date</label>
                    <div class="col-sm-4">
                      <div class="radio">
                        <label>
                          <input type="radio" name="upOptionsRadios1" id="upOptionsRadios1" value="0" style="margin-right:3px; margin-right:1px; font-weight:normal;" data-att="option" data-db_id="" data-radio="open">Open</label>
                      </div>
                    </div>                      
                    <div class="col-sm-4">
                      <div class="radio">
                        <label>
                          <input type="radio" name="upOptionsRadios1" id="upOptionsRadios1" value="1" style="margin-right:3px; margin-right:1px; font-weight:normal;" data-att="option" data-db_id="" data-radio="close">Set
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" data-set_date="set" style="display:none;">
                    <label for="upDatepicker" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="upDatepicker" id="upDatepicker" style="font-weight: normal;">
                      </div>                     
                    </div>                  
                  </div> 
                  <div class="form-group" data-set_date="set" style="display:none;">
                    <label for="upTimepicker1" class="col-sm-3 control-label">Time</label>
                    <div class="col-sm-8">
                      <!-- time Picker -->
                      <div class="bootstrap-timepicker">
                          <div class="input-group">
                            <input type="text" class="form-control timepicker" name="upTimepicker1" id="upTimepicker1" style="font-weight: normal;">
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                          <!-- /.input group -->                        
                      </div>
                    </div>                  
                  </div>
                  <div class="form-group">
                    <label for="upAllow_upload" class="col-sm-3 control-label">Permissions</label>
                    <div class="checkbox col-sm-8">
                      <label>
                        <input type="checkbox" id="upAllow_upload"> Allow students to upload assignments
                      </label>
                    </div>
                  </div>                   
                  <div class="form-group">
                    <label for="upBehaviour" class="col-sm-3 control-label">Behaviour</label>
                    <div class="checkbox col-sm-8">
                      <label>
                        <input type="checkbox" id="upBehaviour"> Deactivate after expiry date
                      </label>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="behaviour" class="col-sm-3 control-label">Files Attached</label>
                    <div class="col-sm-8">
                      <span id="alreadyAttached" style="font-weight: normal;"></span>
                    </div>
                  </div>                   
                  <div class="form-group">
                    <label for="behaviour" class="col-sm-3 control-label">Add Attachments</label>
                    <div class="col-sm-8">
                      <label>
                        <input type="file" id="upFiles" name='upFiles' multiple>
                      </label>
                    </div>
                  </div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" form="updateAdminForm" class="btn btn-primary" id="execUpdate">Update</button>
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

<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> 

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/user/assignments.js"></script>

<script>
  $(function () {

    $("#example1").DataTable({
      "aaSorting": []
    });

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      //format: 'yyyy-mm-dd'
      format: 'M dd, yyyy'
    });

    $('#upDatepicker').datepicker({
      autoclose: true,
      //format: 'yyyy-mm-dd'
      format: 'M dd, yyyy'
    });

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      minuteStep: 1
    });    

  });

</script>

</body>
</html>
