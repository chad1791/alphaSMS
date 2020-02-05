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

        //getting teachers data

        $students = array();

        if($this->session->userdata('students')){    
            $students = $this->session->userdata('students');     
        }

        /*echo '<pre>';
        print_r($students);
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
        redirect('/');
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alpha SMS | Students</title>
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
        <li class="active treeview">
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
        Students
        <small>Manage Students</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
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
              <h3 class="box-title">Student List</h3>
                            <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addStudent" data-backdrop="static" data-keyboard="false"><i class="fa fa-user-plus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importCsv" data-backdrop="static" data-keyboard="false"><i class="fa fa-cloud-upload"></i>  (.xlsx)</button>
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
                  <th>Cell</th>
                  <th>Class</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                  <?php

                  if(count($students)>0){

                    for ($i=0; $i < count($students) ; $i++) { 

                      if($students[$i]['status'] == 1){
                        $active = 'Active';
                      }
                      else{
                        $active = 'Inactive';
                      }

                      for ($row=0; $row < count($classes); $row++) { 
                        if($classes[$row]['id'] == $students[$i]['class_id']){
                          $class = $classes[$row]['name'].' - '.$classes[$row]['level'];
                          break;
                        }
                        else{
                          $class = 'No class selected!';
                        }
                      }

                      echo '<tr id="'.$students[$i]['id'].'">'.
                           '<td>'.$students[$i]['student_id'].'</td>'. 
                           '<td>'.$students[$i]['first'].' '.$students[$i]['last'].'</td>'.
                           '<td>'.$students[$i]['cell'].'</td>'.
                           '<td>'.$class.'</td>'.  
                           '<td>'.$active.'</td>'.
                           '<td><button class="btn btn-success" data-fnx="view" data-view_id="'.$students[$i]['id'].'"><i class="fa fa-eye"></i></button>&nbsp;<button class="btn btn-primary" data-fnx="update" data-up_id="'.$students[$i]['id'].'" data-toggle="modal" data-target="#updateAdmin"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger" data-fnx="delete" data-rem_id="'.$students[$i]['id'].'"><i class="fa fa-times"></i></button></td>'.
                           '</tr>';
                    }
                  }

                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Cell</th>
                  <th>Class</th>
                  <th>Status</th>
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

        <div class="modal" id="importCsv">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #00c0ef; color:white;">
                <button id="xImportClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Import Students from Excel (.xlsx) file</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">

                  <br/>

                  <div class="form-group">
                    <label for="imCsv" class="col-xs-4 col-sm-3 col-md-3 col-lg-3 control-label">Select File</label>

                    <div class="col-sm-7">
                      <input type="file" class="form-control" id="imCsv" name="imCsv">
                    </div>
                  </div> 

                  <!--div class="form-group">
                    <label for="files" class="col-xs-4 col-sm-3 col-md-3 col-lg-3 control-label">Excel format</label>
                    <div class="col-md-1"></div>
                    <div class="col-sm-7">
                      Click <a href="">here</a> to download Excel format
                    </div>
                  </div-->                                   

               </form>
              </div>
              <div class="modal-footer">
                <button id="importClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="importCsvBtn" type="button" class="btn btn-primary">Import</button>
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
                <h4 class="modal-title" id="viewStudentTitle" style="font-weight: bold;"></h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'addAdminForm');
                  echo form_open('Admins/addAdmin',$attributes); 

                ?>

                  <center><div id="studentImage"></div></center><br/>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Student Id</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewId"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Social Security No</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewSs"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">First Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewName"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Middle Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewMiddle"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Last Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewLast"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Cell No</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewCell"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Email</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewEmail"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Address</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewAddress"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Gender</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewGender"></label>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Class</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewClass"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Status</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewStatus"></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Father's Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewFather"></label>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Mother's Name</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewMother"></label>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Emergency No</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewEmergency"></label>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="inputEmail" class="col-xs-5 col-sm-5 control-label">Advanced</label>

                    <div class="col-sm-7">
                      <label class="control-label" style="font-weight: normal;" id="viewAdvanced"></label>
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

       <div class="modal bd-example-modal-lg" id="addStudent">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Student Account</h4>
              </div>
              <div class="modal-body col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <?php 

                  //$attributes = array('class' => 'form-horizontal', 'id'=>'addStudentForm');
                  //echo form_open('Admins/addStudent',$attributes); 

                ?>

                <form class="form-horizontal">

                  <div class="form-group">
                    <label for="student_id" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Student Id</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Student Id">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ss" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Social Security</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="ss" name="ss" placeholder="Social Security">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="first" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">First Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="first" name="first" placeholder="First Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Middle Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="middle" name="middle" placeholder="Middle Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="last" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Last Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="last" name="last" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cell" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Cell No</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="cell" name="cell" placeholder="Cell No">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="address" name="address" placeholder="Address"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gender" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Gender</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="gender" id="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="class_id" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Class</label>
                    <div class="col-sm-9">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->
                      <select class="form-control" name="class_id" id="class_id">
                        <?php 

                          if(count($classes)>0){
                            for ($i=0; $i < count($classes); $i++) { 
                              echo '<option value="'.$classes[$i]['id'].'">'.$classes[$i]['name'].' - '.$classes[$i]['level'].'</option>';
                            }
                          }

                        ?>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="status" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Status</label>
                    <div class="col-sm-9">
                      <!--input type="text" value="<?php //if(count($profile)>0){echo $profile[0]['cell'];} ?>" class="form-control" id="inputName" name="cell" placeholder="Cell"-->
                      <select class="form-control" name="status" id="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="father" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Father's Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="father" name="father" placeholder="Father's Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mother" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Mother's Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mother" name="mother" placeholder="Mother's Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="emergency" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Emergency No</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="emergency" name="emergency" placeholder="Emergency No">
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="files" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 control-label">Student Image</label>

                    <div class="col-sm-9">
                      <input type="file" class="form-control" id="files" name="files">
                    </div>
                  </div>                                  
                </form>

              </div>
              <div class="modal-footer">
                <button id="btnClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addStdBtn" type="button" class="btn btn-primary">Add</button>
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
                <h4 class="modal-title">Update Student Account Form</h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'updateStudentForm');
                  echo form_open('Admins/updateStudent',$attributes);  

                ?>
                  <input type="hidden" name="studentDbId" id="studentDbId"></input>

                  <div class="form-group">
                    <label for="upStudentId" class="col-sm-3 control-label">Student Id</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upStudentId" name="upStudentId" placeholder="Student Id">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upSS" class="col-sm-3 control-label">Social Security</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upSS" name="upSS" placeholder="Social Security">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upFirst" class="col-sm-3 control-label">First Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upFirst" name="upFirst" placeholder="First Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upMiddle" class="col-sm-3 control-label">Middle Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upMiddle" name="upMiddle" placeholder="Middle Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upLast" class="col-sm-3 control-label">Last Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upLast" name="upLast" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upCell" class="col-sm-3 control-label">Cell No</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upCell" name="upCell" placeholder="Cell No">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upEmail" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="upEmail" name="upEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upAddress" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upAddress" name="upAddress" placeholder="Address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upGender" class="col-sm-3 control-label">Gender</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="upGender" id="upGender"></select> 
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="upClassId" class="col-sm-3 control-label">Class</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="upClassId" id="upClassId"></select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="upStatus" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="upStatus" id="upStatus"></select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="upFather" class="col-sm-3 control-label">Father's Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upFather" name="upFather" placeholder="Father's Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upMother" class="col-sm-3 control-label">Mother's Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upMother" name="upMother" placeholder="Mother's Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upEmergency" class="col-sm-3 control-label">Emergency No</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upEmergency" name="upEmergency" placeholder="Emergency No">
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="upEmergency" class="col-sm-3 control-label">Current Image</label>

                    <div class="col-sm-9" id="showImage"></div>
                  </div>                   
                  <div class="form-group">
                    <label for="upImage" class="col-sm-3 control-label">Change Image</label>

                    <div class="col-sm-9">
                      <input type="file" class="form-control" id="upImage" name="upImage">
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" form="updateStudentForm" class="btn btn-primary">Update</button>
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

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/students.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/search.js"></script>

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
