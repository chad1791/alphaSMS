<?php
    if($this->session->userdata('teacher_id')){
        //echo $this->session->userdata('admin_id');
      $teacher_email = $this->session->userdata('email');

        //getting default events for user...

        $d_events = array();

        if($this->session->userdata('d_events')){    
            $d_events = $this->session->userdata('d_events');         
        } 

        //getting default events for user...

        $myEvents = array();

        if($this->session->userdata('myEvents')){    
            $myEvents = $this->session->userdata('myEvents');        
        } 

        //getting default events for user...

        $sharedEvents = array();

        if($this->session->userdata('sharedEvents')){    
            $sharedEvents = $this->session->userdata('sharedEvents');        
        } 

        $myAddedAssignments = array();

        if($this->session->userdata('myAddedAssignments')){    
            $myAddedAssignments = $this->session->userdata('myAddedAssignments');     
        }

        /*echo '<pre>';
        print_r($sharedEvents);
        echo '</pre>';*/

        //counting students

        $students = array();

        if($this->session->userdata('students')){    
            $students = $this->session->userdata('students');        
        }

        //counting teachers

        $teachers = array();

        if($this->session->userdata('teachers')){    
            $teachers = $this->session->userdata('teachers');        
        }

        //counting classes

        $classes = array();

        if($this->session->userdata('classes')){    
            $classes = $this->session->userdata('classes');        
        }

        //counting courses

        $courses = array();

        if($this->session->userdata('courses')){    
            $courses = $this->session->userdata('courses');        
        }

        //getting profile data

        $profile = array();

        if($this->session->userdata('profile')){    
            $profile = $this->session->userdata('profile'); 
            //$ad_id = $profile[0]['id'];       
        }

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
        redirect('/teachers/login');
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alpha SMS | Teachers Dashboard</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">

.event-card {
  padding: 5px 10px;
  font-weight: bold;
  margin-bottom: 4px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  border-radius: 3px;
  cursor: default;
}
.event-card:hover {
  box-shadow: inset 0 0 90px rgba(0, 0, 0, 0.2);
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
              <span class="hidden-xs"><?php if(count($profile)==0){echo 'Profile is not set!';} else{echo $profile[0]['first']. ' '. $profile[0]['last'];}?></span>
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

  <!-- =============================================== -->

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
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-university"></i> <span>Home</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
              <span class="label label-primary pull-right"><?php echo count($students); ?></span>
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
              <span class="label label-success pull-right"><?php echo count($classes); ?></span>
            <span>
          </a>
        </li>
        <li class="treeview">
          <a href="assignments">
            <i class="fa fa-file-text-o"></i>
            <span>Assignments</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right"><?php echo count($myAddedAssignments); ?></span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="lesson-plans">
            <i class="fa fa-folder-open"></i>
            <span>Lesson Plans</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?php echo count($classes); ?></span>
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
        Dashboard
        <small>Admin Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-university"></i> Home</a></li> 
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo count($students); ?></h3>

              <p><?php if(count($students) == 1){ echo 'Student'; }else{ echo 'Students'; } ?></p> 
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="students" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo count($classes); ?></h3>

              <p><?php if(count($classes) == 1){ echo 'Class'; }else{ echo 'Classes'; } ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="classes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo count($myAddedAssignments); ?></h3>

              <p><?php if(count($myAddedAssignments) == 1){ echo 'Assignment'; }else{ echo 'Assignments'; } ?></p> 
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <a href="assignments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo count($courses); ?></h3>

              <p><?php if(count($courses) == 1){ echo 'Lesson Plan'; }else{ echo 'Lesson Plans'; } ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open"></i>
            </div>
            <a href="lesson-plans" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Event Templates</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <?php 

                  for ($i=0; $i < count($d_events); $i++) { 
                    echo '<div data-dEvent="'.$d_events[$i]['id'].'" class="external-event" style="background-color:'. $d_events[$i]['bground'] .'; border-color:'. $d_events[$i]['border'] .'; color:'. $d_events[$i]['color'] .';">'.$d_events[$i]['title'].'</div>';
                  }

                ?>
                <!--div class="external-event bg-green">Lunch</div>
                <div class="external-event bg-yellow">Go home</div>
                <div class="external-event bg-aqua">Do homework</div>
                <div class="external-event bg-light-blue">Work on UI design</div>
                <div class="external-event bg-red">Sleep tight</div-->
              </div>
              <div class="checkbox">
                <label for="drop-remove">
                  <input type="checkbox" id="drop-remove">
                  remove after drop
                </label>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Create Event</h3>
            </div>
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                </ul>
              </div>
              <!-- /btn-group -->
              <div class="input-group">
                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                <div class="input-group-btn">
                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                </div>
                <!-- /btn-group -->
              </div>
              <!-- /input-group -->
            </div>
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">My Events List</h3>
              <span class="pull-right"><a href="events"><i data-fnx="timeline" class="fa fa-sitemap" style="cursor:pointer;"></i></a></span>
            </div>
            <div class="box-body" style="max-height: 232px; overflow-y: scroll;">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;" id="myEventsList">
                
                <?php 
                  for ($i=0; $i < count($myEvents) ; $i++) { 

                    $timestamp = strtotime($myEvents[$i]['start']);
                    $myDate = date('Y-m-d', $timestamp);

                    $titleShort = substr($myEvents[$i]['title'], 0, 10);

                    echo '<div class="event-card" style="background-color:'.$myEvents[$i]['background'].'; color:'.$myEvents[$i]['color'].'; border:'.$myEvents[$i]['border'].'">'.
                          '<b>'.$titleShort .
                          '<div class="pull-right"><i data-view="gotoEvent" data-evId="'.$myEvents[$i]['id'].'" class="fa fa-eye" style="cursor:pointer;" id="'.$myDate.'"></i> <i id="'.$myEvents[$i]['id'].'" data-set="eventSettings" class="fa fa-gear" style="cursor:pointer;"></i> '.
                          '<i id="'.$myEvents[$i]['id'].'" data-ex="eventExit" data-date="'.$myDate.'" class="fa fa-times" style="cursor:pointer;"></i></div>'.
                         '</div>'; 
                  }

                  //showing shared events...

                  for ($i=0; $i < count($sharedEvents) ; $i++) { 

                    $timestamp = strtotime($sharedEvents[$i]['start']);
                    $myDate = date('Y-m-d', $timestamp);

                    $titleShort = substr($sharedEvents[$i]['title'], 0, 8);

                    echo '<div class="event-card" style="background-color:'.$sharedEvents[$i]['background'].'; color:'.$sharedEvents[$i]['color'].'; border:'.$sharedEvents[$i]['border'].'">'.
                          '<b>(S) '.$titleShort .
                          '<div class="pull-right"><i data-view="gotoEvent" data-evId="'.$sharedEvents[$i]['id'].'" class="fa fa-eye" style="cursor:pointer;" id="'.$myDate.'"></i> <i id="'.$sharedEvents[$i]['id'].'" data-set-not="eventSettings" class="fa fa-gear" style="cursor:not-allowed;"></i> '.
                          '<i id="'.$sharedEvents[$i]['id'].'" data-ex-not="eventExit" data-date="'.$myDate.'" class="fa fa-times" style="cursor:not-allowed;"></i></div>'.
                         '</div>'; 
                  }

                ?>                

              </div>
            </div>
          </div>          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
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

       <div class="modal" id="eventSettings">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id="eventName"></span> - Event Settings</h4>
              </div>
              <div class="modal-body">
                <?php 

                  $attributes = array('class' => 'form-horizontal', 'id'=>'updateAdminForm');
                  echo form_open('Admins/updateClass',$attributes); 

                ?> 

                  <input type="hidden" name="myEventDbId" id="myEventDbId"></input> 
                
                  <div class="form-group">
                    <label for="upEventName" class="col-sm-3 control-label">Event Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upEventName" name="upEventName" placeholder="Event Name" readonly="readonly">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upEventLink" class="col-sm-3 control-label">Link</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="upEventLink" name="upEventLink" placeholder="e.g https://www.google.com/">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upDesc" class="col-sm-3 control-label">Share With</label>

                    <div class="col-sm-9" id="groupShare">
                      <!--input type="text" class="form-control" id="upDesc" name="upDesc" placeholder="Description"-->

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" id="onlyMe" name="onlyMe" data-val="1"> Only Me
                        </label>
                      </div>                      
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" id="admin" name="admin" data-val="2"> Administrators
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" id="office" name="office" data-val="3"> Office Assistant
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" id="instructors" name="instructors" data-val="4"> Teachers
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" id="students" name="students" data-val="5"> Students
                        </label>
                      </div>

                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" form="updateAdminForm" class="btn btn-primary" id="updateEvent">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->




       <div class="modal" id="largeModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span id="eventName"></span> Events Timeline</h4>
              </div>
              <div class="modal-body">


                <ul class="timeline">

                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">
                            10 Feb. 2014
                        </span>
                    </li>
                    <!-- /.timeline-label -->

                    <!-- timeline item -->
                    <li>
                        <!-- timeline icon -->
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                            <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

                            <div class="timeline-body">
                                ...
                                Content goes here
                            </div>

                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs">...</a>
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->


                </ul>

               

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                <!--button type="button" form="updateAdminForm" class="btn btn-primary" id="updateEvent">Update</button-->
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
<script>
  $(function () {

    //show shared events...
    //update my events list display in dashboard...

    var eventList = '';
    var eventListObj = '';
    var sharedEvents = [];
    var timeLine = $('[data-fnx="timeline"]');

    //add click listener to timeline button...

    timeLine
      .on('click',function(){
        //alert('Pop-up for timeline...');
        //$('#largeModal').modal('show');
      })

    var attachListeners = addListenerToEventBtns();

    function addListenerToEventBtns(){

      var eventSettings = $('[data-set="eventSettings"]');
      var eventExit = $('[data-ex="eventExit"]');
      var gotoEvent = $('[data-view="gotoEvent"]');
      var updateEvent = $('#updateEvent');

      //add click listener to update event button...

      updateEvent
        .off()
        .on('click',function(e){

          var eventId = $('#myEventDbId').val();
          var url = $('#upEventLink').val();
          var shareGroup = '';

          console.log('Iterating on checkboxes: ');

          $('#groupShare').find(':checkbox').each(function(){

              if($(this).prop('checked') === true){
                
                var shareId = $(this).data('val');

                if(shareGroup === ''){
                  shareGroup += shareId;
                }
                else{
                  shareGroup = shareGroup + ',' + shareId;
                }
              }
          });

          console.log(shareGroup);

          var jqxhr = $.ajax({
            url: '../Users/updateMyEventUrlShares',  
            dataType:'json',
            type:'post',
            data: {id:eventId, url:url, shareGroup:shareGroup}           
          })          
          .done(function(response) {

            //delete current event that corresponds to the updated event id

            $('#calendar').fullCalendar('removeEvents', eventId); 

            //redraw event to the calendar

            $.each(response.event,function(key,value){

              var allDay = false;

              if(value.allDay === "1"){
                allDay = true;
              }

              if(value.url !== ''){

                $('#calendar').fullCalendar( 'renderEvent', {
                    id: value.id,
                    title: value.title,
                    start: value.start,
                    end: value.end,
                    allDay:allDay,
                    url:value.url,
                    backgroundColor:value.background,
                    borderColor:value.border,
                    textColor:value.color
                }, true ); 

              }
              else{

                $('#calendar').fullCalendar( 'renderEvent', {
                    id: value.id,
                    title: value.title,
                    start: value.start,
                    end: value.end,
                    allDay:allDay,
                    backgroundColor:value.background,
                    borderColor:value.border,
                    textColor:value.color
                }, true ); 

              }
            }) 

            //hide modal after updating everything...

            alert('Event was successfully updated!');

            $('#eventSettings').modal('hide');       

          })
          .fail(function(jqXHR, textStatus) {
            console.log( textStatus );
          })
          
        })

      //add click listener to goto event button...

      gotoEvent
        .off()
        .on('click',function(e){
         
          var date = $(this).attr('id');
          $("#calendar").fullCalendar( 'gotoDate', date );
      });

      //add click listener to event settings button...

      eventSettings
        .off()
        .on('click',function(e){

          var eventId = $(this).attr('id');
          var shareGroup = [];

          //assign event id to hidden textbox in modal

          $('#myEventDbId').val(eventId);

          //share group functionality toggle

          $('#onlyMe')
                .on('click',function(){
                  $('#admin').prop('checked', false);
                  $('#office').prop('checked', false);
                  $('#instructors').prop('checked', false);
                  $('#students').prop('checked', false);              
                })

          $('#admin')
              .on('click',function(){
                $('#onlyMe').prop('checked', false);
              }); 

          $('#office')
              .on('click',function(){
                $('#onlyMe').prop('checked', false);
              });

          $('#instructors')
              .on('click',function(){
                $('#onlyMe').prop('checked', false);
              });

          $('#students')
              .on('click',function(){
                $('#onlyMe').prop('checked', false);
              });

          //call ajax to show event respetive info...

          $.ajax({
            method: "POST",
            url: "../Users/getMyEventById",
            dataType: "json",
            data: { id:eventId }
          })
          .done(function( response ) {
            $.each(response.event,function(key,value){

              shareGroup = value.share_group.split(',');

              console.log('Share group array:');
              console.log(shareGroup);

              $('#eventName').text(value.title);
              $('#upEventName').val(value.title);
              $('#upEventLink').val(value.url);

            })

            //deactivate all checkboxes before assigning new values

              $('#onlyMe').prop('checked', false);
              $('#admin').prop('checked', false);
              $('#office').prop('checked', false);
              $('#instructors').prop('checked', false);
              $('#students').prop('checked', false);

            if(shareGroup.length > 0){
              $.each(shareGroup,function(index,value){
                //console.log('Share group item:');
                //console.log(value);
                switch(value){
                  case '1': {
                    $('#onlyMe').prop('checked', true);
                  }
                  break;
                  case '2': {
                    $('#admin').prop('checked', true);
                  }
                  break;
                  case '3': {
                    $('#office').prop('checked', true);
                  }
                  break;
                  case '4': {
                    $('#instructors').prop('checked', true);
                  }
                  break;
                  case '5': {
                    $('#students').prop('checked', true);
                  }
                  break;
                  default: {
                    console.log('This is the default case...')
                  }
                }
              })
            }

          })       
          
          $('#eventSettings').modal('show');      

        })

      //add click listener to event exit button... 

      eventExit
        .off()
        .on('click',function(){

          var eventId = $(this).attr('id');
          var eventDate = $(this).data('date');
          var eventCard = $(this).parents("div").eq(1);

          if(confirm('Are you sure you want to delete this event from your Calendar?')){

            //navigate to event in calendar

            $("#calendar").fullCalendar( 'gotoDate', eventDate );

            //call ajax to delete the current event from the database

              $.ajax({
                method: "POST",
                url: "Admins/delMyEventById", 
                dataType: "json",
                data: { id: eventId }
              })
              .done(function( response ) {

                console.log(response);

                //wait a few seconds to remove event from calendar.

                setTimeout(function(){
                  
                  $('#calendar').fullCalendar('removeEvents', eventId); 
                  eventCard.fadeOut('slow');
                  
                  alert('Event was successfully removed from your calendar!');

                  console.log('This happens after five(5) seconds...');
                }, 1500);
                    
              })            
          }

        })
    }

    //ajax to get my calendar events...

      $.ajax({
        method: "POST",
        url: "../Users/getAllMyEvents", 
        dataType: "json",
        data: { owner_id:<?php echo $this->session->userdata('teacher_id'); ?> }
      })
      .done(function( response ) {

        var eventList = '[';
        var total = 0;

        if (!$.trim(response)){   
            total = 0;
        }
        else{   
            total = response.event.length;
        }               

        $.each(response.event,function(key,value){

            var allDay = false;

            if(value.allDay === "1"){
              allDay = true;
            }
            
            eventList = eventList + '{';
            eventList = eventList + '"id":"' + value.id + '",';
            eventList = eventList + '"title":"' + value.title + '",';
            eventList = eventList + '"start":"' + value.start + '",';
            eventList = eventList + '"allDay":' + allDay + ',';
            //eventList = eventList + '"start":"2019-08-21",';
            eventList = eventList + '"end":"' + value.end + '",';
            //eventList = eventList + '"end":"2019-08-21",';

            if(value.url !== ''){
              eventList = eventList + '"url":"' + value.url + '",';
            }

            eventList = eventList + '"backgroundColor":"' + value.background + '",';
            eventList = eventList + '"borderColor":"' + value.border;            
            eventList = eventList + '"}';

            if (key !== total - 1) {
              eventList += ',';
            }
        });

        //fetch shared events to draw to the calendar...

        $.ajax({
          method: "POST",
          url: "../Users/getAllSharedEvents",
          dataType: "json",
          data: { owner_id:<?php echo $this->session->userdata('teacher_id'); ?>, group:'4' }
        })
        .done(function(response){

          var len = 0;

          if (!$.trim(response)){   
              len = 0;
          }
          else{   
              len = response.sharedEvents.length;
          }

          $.each(response.sharedEvents,function(key,value){

              var allDay = false;

              if(value.allDay === "1"){
                allDay = true;
              }

              if(eventList !== '[' && key === 0){
                eventList += ',';
              }
              
              eventList = eventList + '{';
              eventList = eventList + '"id":"' + value.id + '",';
              eventList = eventList + '"title":"' + value.title + '",';
              eventList = eventList + '"start":"' + value.start + '",';
              eventList = eventList + '"allDay":' + allDay + ',';
              //eventList = eventList + '"start":"2019-08-21",';
              eventList = eventList + '"end":"' + value.end + '",';
              //eventList = eventList + '"end":"2019-08-21",';

              if(value.url !== ''){
                eventList = eventList + '"url":"' + value.url + '",';
              }

              eventList = eventList + '"backgroundColor":"' + value.background + '",';
              eventList = eventList + '"borderColor":"' + value.border;            
              eventList = eventList + '"}';

              if (key !== len - 1) {
                eventList += ',';
              }

              sharedEvents.push(value.id);

          });

          eventList += ']'; 

          eventListObj = JSON.parse(eventList);
          console.log('Events Text: ');

          console.log(eventListObj);

          console.log('Shared events array: ');
          console.log(sharedEvents);

        })
        .done(function(){

          /* initialize the calendar
           -----------------------------------------------------------------*/
          //Date for the calendar events (dummy data)
          var date = new Date();
          var d = date.getDate(),
              m = date.getMonth(),
              y = date.getFullYear();
          $('#calendar').fullCalendar({
            header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
              today: 'today',
              month: 'month',
              week: 'week',
              day: 'day',
              //listYear: 'List View'
            },
            //defaultView: 'listYear',
            //Random default events
            events: eventListObj,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

              // retrieve the dropped element's stored Event Object
              var originalEventObject = $(this).data('eventObject');

              // we need to copy it, so that multiple events don't have a reference to the same object
              var copiedEventObject = $.extend({}, originalEventObject);

              // save the database id of the default event...

              var d_event_id = $(this).data('devent');

              // assign it the date that was reported
              copiedEventObject.start = date;
              copiedEventObject.allDay = allDay;
              copiedEventObject.backgroundColor = $(this).css("background-color");
              copiedEventObject.borderColor = $(this).css("border-color");            

              //call ajax to add the event to myEvents table...

              var jqxhr = $.ajax({
                url: '../Users/addMyEvent',  
                dataType:'json',
                type:'post',
                data: {owner_id:<?php echo $this->session->userdata('teacher_id'); ?>, d_event_id:d_event_id, owner_type:'teachers_log', title:copiedEventObject.title, start:moment(copiedEventObject.start).format('YYYY-MM-DD HH:mm:00'), end:moment(copiedEventObject.start).format('YYYY-MM-DD HH:mm:00'), color:'#fff', background:copiedEventObject.backgroundColor, border:copiedEventObject.borderColor}          
              })          
              .done(function(response) {

                //output response from the server...

                console.log(response);

                //add the database id of the event that was just added to the database...

                copiedEventObject.id = response;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)

                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true); 

                //push event to my events list panel...

                var shortTitle = copiedEventObject.title.slice(0,11);

                //alert(copiedEventObject.backgroundColor);
                //alert(copiedEventObject.borderColor);

                $('#myEventsList')
                      .prepend('<div class="event-card" style="background-color:' + copiedEventObject.backgroundColor + '; color:#fff; border:' + copiedEventObject.borderColor + ';"><b>' + shortTitle + '</b><small data-title_date="'+ response +'">&nbsp;[' + moment(copiedEventObject.start).format('YYYY-MM-DD') + ']</small><div class="pull-right"><i data-view="gotoEvent" class="fa fa-eye" style="cursor:pointer;" id="' + moment(copiedEventObject.start).format('YYYY-MM-DD') + '"></i> <i id="' + response + '" data-set="eventSettings" class="fa fa-gear" style="cursor:pointer;"></i> <i id="' + response + '" data-ex="eventExit" data-date="' + moment(copiedEventObject.start).format('YYYY-MM-DD') + '" class="fa fa-times" style="cursor:pointer;"></i></div></div>');

                addListenerToEventBtns();

              })
              .fail(function(jqXHR, textStatus) {
                  //console.log( textStatus );
              })   

              // is the "remove after drop" checkbox checked?
              if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();

                //call ajax to delete d_event from database...

                  $.ajax({
                    method: "POST",
                    url: "../Users/delDEventById", 
                    //dataType: "json",
                    data: { id: d_event_id }
                  })
                  .done(function( response ) {

                    //window.location.replace('dashboard'); 
                    
                  })
              }

            },
            eventDrop: function(event, delta, revertFunc) {

              //alert(event.title + " was dropped on " + event.start.format());

              if (!confirm("Are you sure you want to change " + event.title + " to new date: " + event.start.format('YYYY-MM-DD HH:mm:00') + "?")) {
                revertFunc();
              }
              else{

                console.log(event);
                var d_event_id = event.id;

                //call ajax to update event's dates...

                var startTime = event.start.format('YYYY-MM-DD HH:mm:00');
                var endTime = event.start.format('YYYY-MM-DD HH:mm:00');
                var allDayEvent = false;

                if(event.allDay === true){
                  allDayEvent = 1;
                }

                if(event.end !== null){
                  endTime = event.end.format('YYYY-MM-DD HH:mm:00');
                }

                var jqxhr = $.ajax({
                  url: '../Users/updateMyEvent',  
                  //dataType:'json',
                  type:'post',
                  data: {id:d_event_id, allDay:allDayEvent, start:startTime, end:endTime}           
                })          
                .done(function(response) {
                  console.log('update successful!');

                  var shortNewDate = event.start.format('YYYY-MM-DD');

                  $('[data-title_date="' + d_event_id + '"]').empty();
                  $('[data-title_date="' + d_event_id + '"]').html('&nbsp;[' + shortNewDate + ']');

                  //event.id=""

                  $('[data-evId="' + d_event_id + '"]').attr('id', shortNewDate);

                })
                .fail(function(jqXHR, textStatus) {
                    console.log( textStatus );
                })
              }

            },
            eventResize: function(event, delta, revertFunc) {
                
              if (!confirm("Are you sure you want to resize event: " + event.title + "?")) {
                revertFunc();
              }
              else{

                console.log(event);
                var d_event_id = event.id;

                //call ajax to update event's dates...

                var startTime = event.start.format('YYYY-MM-DD HH:mm:00');
                var endTime = event.start.format('YYYY-MM-DD HH:mm:00');
                var allDayEvent = false;

                if(event.allDay === true){
                  allDayEvent = 1;
                }

                if(event.end !== null){
                  endTime = event.end.format('YYYY-MM-DD HH:mm:00');
                }

                var jqxhr = $.ajax({
                  url: '../Users/updateMyEvent',  
                  //dataType:'json',
                  type:'post',
                  data: {id:d_event_id, allDay:allDayEvent, start:startTime, end:endTime}           
                })          
                .done(function(response) {
                  console.log('update successful!');
                })
                .fail(function(jqXHR, textStatus) {
                    console.log( textStatus );
                })
              }
            },
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url, "_blank");
                    return false;
                }
            },
            eventRender: function(event, element) {  

                //remove drop functionality to shared events...

                $.each(sharedEvents,function(key,value){
                  if(event.id === value){
                    event.editable = false;
                  }
                })

            }

          });

        });
      });

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    /* function to repopulate the default events list */

    function fetchDefaultEvents(){

        //fetch events from db and reload them to the events list...

        $.ajax({
          method: "POST",
          url: "../Users/getAllDefaultEvents",
          dataType: "json",
          data: { owner_id:<?php echo $this->session->userdata('teacher_id'); ?> }
        })
        .done(function( response ) {
          console.log('Default Events from db: ');
          console.log(response);

          //foreach loop to append default event to list...

          $.each(response.d_event,function(key,value){
              
              $('#external-events').prepend('<div data-dEvent="' + value.id + '" class="external-event" style="background-color:' + value.bground + '; border-color:' + value.border + '; color:'+ value.color + ';">' + value.title + '</div>');

          });

          ini_events($('#external-events div.external-event'));

        })
    }

    ini_events($('#external-events div.external-event'));

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      //$('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //call ajax to save event to database...

      var jqxhr = $.ajax({
        url: '../Users/addDefaultEvent',  
        //dataType:'json',
        type:'post',
        data: {owner_id:<?php echo $this->session->userdata('teacher_id'); ?>, table_name:'teachers_log', title:val, color:'#fff', bground:currColor, border:currColor}           
      })          
      .done(function(response) {

        //clear default events list....

        $('#external-events').empty();

        //repopulate events list with events from the database...

        fetchDefaultEvents();

      })
      .fail(function(jqXHR, textStatus) {
          console.log( textStatus );
      })

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
</body>
</html>