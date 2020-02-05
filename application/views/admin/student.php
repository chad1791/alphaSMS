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

       //getting my class list

        $myClass = array();

        if($this->session->userdata('ind_class')){    
            $ind_class = $this->session->userdata('ind_class');     
        }         

        //getting teachers data

        $teachers = array();

        if($this->session->userdata('teachers')){    
            $teachers = $this->session->userdata('teachers');     
        }
 
        //getting small_settings data

        $small_settings = array(); 

        if($this->session->userdata('small_settings')){    
            $small_settings = $this->session->userdata('small_settings');     
        }       

        //echo '<pre>';
        //print_r($ind_class);
        //echo '</pre>';

        $grades = array();

        if($this->session->userdata('grades')){    
            $grades = $this->session->userdata('grades');     
        }

    		//student info:

    		$std_profile = $std_profile['stdProfile'][0];  

        //student behaviour

        $demerits    = $behaviour['demerits'];
        $jugs        = $behaviour['jugs'];
        $suspensions = $behaviour['suspensions'];
        $expulsions  = $behaviour['expulsions'];

        //echo '<pre>';
        //print_r($std_profile);
        //echo '</pre>';

        /////////////////////////////////////////////////////////

        for ($c=0; $c < count($classes); $c++) { 
          if($std_profile['class_id'] == $classes[$c]['id']){
            $className = $classes[$c]['name'].' - '.$classes[$c]['level'];
          }
        } 

        if($std_profile['gender'] == 'Male'){

          if($std_profile['image'] != ''){
            $imageName = base_url().'assets/images/students/'.$std_profile['image']; 
          }
          else{
            $imageName = base_url().'custom/uploads/default/images/male.jpg';
          } 
        }
        else{

          if($std_profile['image'] != ''){
            $imageName = base_url().'assets/images/students/'.$std_profile['image']; 
          }
          else{
            $imageName = base_url().'custom/uploads/default/images/female.jpg';
          } 
        }

      

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
  <title>Alpha SMS | Student Profile</title>
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
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">   
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css"> 

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
        <li class="active treeview">
          <a href="../students">
            <i class="fa fa-user"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <input type="hidden" id="base" value="<?php echo base_url(); ?>"> 
      <input type="hidden" id="department" value="<?php echo $ind_class[0]['department']; ?>">
      <input type="hidden" id="class_id" value="<?php echo $std_profile['class_id']; ?>">
      <input type="hidden" id="student_id" value="<?php echo $std_profile['id']; ?>">
      <input type="hidden" id="admin_id" value="<?php echo $this->session->userdata('admin_id'); ?>">

      <div class="row">
        <div class="col-md-3">

          <input type="hidden" name="Special" id="Special" value="Special">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?=$imageName;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $std_profile['first']. ' ' . $std_profile['middle'] .' ' . $std_profile['last'] ?></h3>

              <p class="text-muted text-center"><?php echo $className; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right"><?php echo $std_profile['cell']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $std_profile['email']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Acc. Status</b> <a class="pull-right"><?php if($std_profile['status']==1){ echo 'Active'; }else{ echo 'Inactive'; } ?></a>
                </li>

              </ul>

              <!--a href="#" class="btn btn-primary btn-block"><b>Follow</b></a-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Other Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-home margin-r-5"></i> Parents</strong>

              <p class="text-muted">
                <?php echo $std_profile['father']. ', '. $std_profile['mother']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

              <p class="text-muted"><?php echo $std_profile['address']; ?></p>

              <hr>

              <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Emergency Contact</strong>

              <p class="text-muted"><?php echo $std_profile['emergency']; ?></p>

              <!--p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p-->

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Student Notes here...</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='graphs'){ echo 'class="active"'; }}else{ echo 'class="active"'; } ?>><a href="#graphs" data-toggle="tab" id="graphs_tab" data-db_id="<?php if(count($small_settings)>0){ echo $small_settings[0]['id']; }else{echo ''; } ?>">Graphs</a></li>
              <!--li><a href="#settings" data-toggle="tab">Fees</a></li-->
              <li <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='grades'){ echo 'class="active"'; }} ?>><a href="#grades" data-toggle="tab" id="grades_tab" data-db_id="<?php if(count($small_settings)>0){ echo $small_settings[0]['id']; }else{echo ''; } ?>">Grades</a></li>
              <li <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='attendance'){ echo 'class="active"'; }} ?>><a href="#attendance" data-toggle="tab" id="attendance_tab" data-db_id="<?php if(count($small_settings)>0){ echo $small_settings[0]['id']; }else{echo ''; } ?>">Attendance</a></li>
              <li <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='behaviour'){ echo 'class="active"'; }} ?>><a href="#behaviour" data-toggle="tab" id="behaviour_tab" data-db_id="<?php if(count($small_settings)>0){ echo $small_settings[0]['id']; }else{echo ''; } ?>">Behaviour</a></li>
              <!--li><a href="#settings" data-toggle="tab">Appointments</a></li-->
              <li <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='general'){ echo 'class="active"'; }} ?>><a href="#general" data-toggle="tab" id="general_tab" data-db_id="<?php if(count($small_settings)>0){ echo $small_settings[0]['id']; }else{echo ''; } ?>">General</a></li>
            </ul>
            <div class="tab-content">
              <!-- tab for Graphs -->
              <div <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='graphs'){ echo 'class="active tab-pane"'; }else{echo 'class="tab-pane"'; }}else{ echo 'class="active tab-pane"'; } ?> id="graphs" style="">   

                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <h4>Bar Graphs showing grades per course</h4>
                    </div>        
                  </div>
                  
                  <div class="row" id="graphsCont"></div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <h4>Pie Charts showing Attendance per course</h4>
                    </div>        
                  </div>

                  <div class="row" id="piesCont"></div>     
               
              </div>
              <!-- /.tab-pane -->

              <div <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='grades'){ echo 'class="active tab-pane"'; }else{echo 'class="tab-pane"'; }} ?> id="grades" style="">
                <br/>

                <div class="row" id="gradesCont">
                  <!--div class="">
                    
                  </div-->
                </div>

              </div>
              <!-- /.tab-pane -->

              <div <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='attendance'){ echo 'class="active tab-pane"'; }else{echo 'class="tab-pane"'; }} ?> id="attendance" style="">
                <br/>

                <div class="row" id="attendanceCont">
                  
                </div>

              </div>
              <!-- /.tab-pane -->
              <!-- tab for General Settings -->
              <div <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='behaviour'){ echo 'class="active tab-pane"'; }else{echo 'class="tab-pane"'; }} ?> id="behaviour" style="height: auto;">   

               <div class="row">
                 <div class="col-sm-12 col-md-12 col-lg-12">

                    <!-- /.box -->
                    <br/>

                    <div class="box box-success">
                      <div class="box-header">
                        <h3 class="box-title">List of Demerits</h3>
                                      <!-- tools box -->
                        <div class="pull-right box-tools">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addDemerit" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button> 
                          <!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importCsv" data-backdrop="static" data-keyboard="false"><i class="fa fa-cloud-upload"></i>  (.xlsx)</button-->
                        </div>
                        <!-- /. tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <!--th>Id</th-->
                            <th>Date</th>
                            <th>From Teacher</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php


                            if(count($demerits)>0){

                              for ($i=0; $i < count($demerits) ; $i++) { 

                                for ($row=0; $row < count($teachers); $row++) { 
                                  if($teachers[$row]['id'] == $demerits[$i]['teacher_id']){
                                    $teacher = $teachers[$row]['first'].' '.$teachers[$row]['last'];
                                    break;
                                  }
                                  else{
                                    $teacher = 'No teacher selected!';
                                  }
                                }

                                //$txtDate = date('d M Y', strtotime($demerits[$i]['date']));

                                echo '<tr data-Dem_id="'.$demerits[$i]['id'].'">'.
                                     //'<td>'.$demerits[$i]['id'].'</td>'. 
                                     '<td>'.$demerits[$i]['date'].'</td>'.
                                     '<td>'.$teacher.'</td>'.
                                     '<td>'.$demerits[$i]['des'].'</td>'.  
                                     //'<td>'.$active.'</td>'.
                                     '<td><button class="btn btn-primary" data-fnx="update" data-up_id="'.$demerits[$i]['id'].'" data-toggle="modal" data-target="#updateDemerit"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger" data-fnx="delete" data-rem_id="'.$demerits[$i]['id'].'"><i class="fa fa-times"></i></button></td>'.
                                     '</tr>';  
                              }
                            }

                            ?>
                          </tbody>
                          <tfoot>
                          <tr>
                            <!--th>Id</th-->
                            <th>Date</th>
                            <th>From Teacher</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- /.box -->

                    <div class="box box-success">
                      <div class="box-header">
                        <h3 class="box-title">List of Jugs</h3>
                                      <!-- tools box -->
                        <div class="pull-right box-tools">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addJug" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button> 
                          <!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importCsv" data-backdrop="static" data-keyboard="false"><i class="fa fa-cloud-upload"></i>  (.xlsx)</button-->
                        </div>
                        <!-- /. tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <!--th>Id</th-->
                            <th>Date</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php


                            if(count($jugs)>0){

                              for ($i=0; $i < count($jugs) ; $i++) { 

                                //$txtDate = date('d M Y', strtotime($jugs[$i]['date']));

                                if($jugs[$i]['status']){
                                  $status = 'Completed';
                                }
                                else{
                                  $status = 'Pending';
                                }

                                echo '<tr data-Jug_id="'.$jugs[$i]['id'].'">'. 
                                     '<td>'.$jugs[$i]['date'].'</td>'.
                                     '<td>'.$status.'</td>'.
                                     '<td>'.$jugs[$i]['des'].'</td>'.  
                                     //'<td>'.$active.'</td>'.
                                     '<td><button class="btn btn-primary" data-fnx="upJug" data-up_id="'.$jugs[$i]['id'].'" data-toggle="modal" data-target="#updateJug"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger" data-fnx="delJug" data-rem_id="'.$jugs[$i]['id'].'"><i class="fa fa-times"></i></button></td>'.
                                     '</tr>';  
                              }
                            }

                            ?>
                          </tbody>
                          <tfoot>
                          <tr>
                            <!--th>Id</th-->
                            <th>Date</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- /.box -->

                    <div class="box box-success">
                      <div class="box-header">
                        <h3 class="box-title">List of Suspensions</h3>
                                      <!-- tools box -->
                        <div class="pull-right box-tools">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addSuspension" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button> 
                          <!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importCsv" data-backdrop="static" data-keyboard="false"><i class="fa fa-cloud-upload"></i>  (.xlsx)</button-->
                        </div>
                        <!-- /. tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="example3" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <!--th>Id</th-->
                            <th>From</th>
                            <th>To</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php


                            if(count($suspensions)>0){

                              for ($i=0; $i < count($suspensions) ; $i++) { 

                                //$txtDate = date('d M Y', strtotime($jugs[$i]['date']));

                                echo '<tr data-Sus_id="'.$suspensions[$i]['id'].'">'. 
                                     '<td>'.$suspensions[$i]['start'].'</td>'.
                                     '<td>'.$suspensions[$i]['end'].'</td>'.
                                     '<td>'.$suspensions[$i]['des'].'</td>'.  
                                     //'<td>'.$active.'</td>'.
                                     '<td><button class="btn btn-primary" data-fnx="upSuspension" data-up_id="'.$suspensions[$i]['id'].'" data-toggle="modal" data-target="#updateSuspension"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger" data-fnx="delSuspension" data-rem_id="'.$suspensions[$i]['id'].'"><i class="fa fa-times"></i></button></td>'.
                                     '</tr>';  
                              }
                            }

                            ?>
                          </tbody>
                          <tfoot>
                          <tr>
                            <!--th>Id</th-->
                            <th>From</th>
                            <th>To</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box --> 

                    <!-- /.box -->

                    <div class="box box-success">
                      <div class="box-header">
                        <h3 class="box-title">List of Expulsions</h3>
                                      <!-- tools box -->
                        <div class="pull-right box-tools">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addExpulsion" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button> 
                          <!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importCsv" data-backdrop="static" data-keyboard="false"><i class="fa fa-cloud-upload"></i>  (.xlsx)</button-->
                        </div>
                        <!-- /. tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="example4" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <!--th>Id</th-->
                            <th>Date</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php


                            if(count($expulsions)>0){

                              for ($i=0; $i < count($expulsions) ; $i++) { 

                                //$txtDate = date('d M Y', strtotime($jugs[$i]['date']));

                                echo '<tr data-Exp_id="'.$expulsions[$i]['id'].'">'. 
                                     '<td>'.$expulsions[$i]['date'].'</td>'.
                                     '<td>'.$expulsions[$i]['des'].'</td>'.  
                                     //'<td>'.$active.'</td>'.
                                     '<td><button class="btn btn-primary" data-fnx="upExpulsion" data-up_id="'.$expulsions[$i]['id'].'" data-toggle="modal" data-target="#updateExpulsion"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger" data-fnx="delExpulsion" data-rem_id="'.$expulsions[$i]['id'].'"><i class="fa fa-times"></i></button></td>'.
                                     '</tr>';  
                              }
                            }

                            ?>
                          </tbody>
                          <tfoot>
                          <tr>
                            <!--th>Id</th-->
                            <th>Date</th>
                            <th>Description</th>
                            <th>Options</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->                                         

                 </div>
               </div>
               
              </div>
              <!-- /.tab-pane -->                
              <!-- tab for General Settings -->
              <div <?php if(count($small_settings)>0){ if($small_settings[0]['name']=='lastTab' && $small_settings[0]['value']=='general'){ echo 'class="active tab-pane"'; }else{echo 'class="tab-pane"'; }} ?> id="general" style="height: 356px;">    

               <div class="row">
                 <div class="col-sm-12 col-md-12 col-lg-12">
                   <form class="form-horizontal">

                      <center><h2>General Settings for Student Account</h2></center><br/>

                     <div class="form-group">
                       <label for="accStatus" class="col-sm-6 col-md-6 col-lg-6 control-label">Acc Is Active</label>  
                       <div class="checkbox col-sm-6">
                         <label>
                            <input type="checkbox" <?php if(count($std_profile)>0){ if($std_profile['status'] == 1){ echo 'checked=""'; } }  ?> id="accStatus">
                         </label>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="canLogin" class="col-sm-6 col-md-6 col-lg-6 control-label">Can Login</label>  
                       <div class="checkbox col-sm-6">
                         <label>
                            <input type="checkbox" <?php if(count($std_profile)>0){ if($std_profile['can_login'] == 1){ echo 'checked=""'; } }  ?> id="canLogin">
                         </label>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="canViewGrades" class="col-sm-6 col-md-6 col-lg-6 control-label">View Grades</label>
                       <div class="checkbox col-sm-6">
                         <label>
                            <input type="checkbox" <?php if(count($std_profile)>0){ if($std_profile['can_view_grades'] == 1){ echo 'checked=""'; } }  ?> id="canViewGrades">
                         </label>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="canViewAttendance" class="col-sm-6 col-md-6 col-lg-6 control-label">View Attendance</label>
                       <div class="checkbox col-sm-6">
                         <label>
                            <input type="checkbox" <?php if(count($std_profile)>0){ if($std_profile['can_view_attendance'] == 1){ echo 'checked=""'; } }  ?> id="canViewAttendance">
                         </label>
                       </div>
                     </div>

                   </form>
                 </div>
               </div>
               
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

        <div class="modal" id="addDemerit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Add Demerit</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <!-- addTeacher -->

                  <div class="form-group">
                    <label for="teacher_id" class="col-sm-3 control-label">Teacher Name</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="teacher_id" id="teacher_id">
                        <?php

                          if(count($teachers)>0){  

                            //$cells = array_values($levels[0]);

                            for($i = 0; $i < count($teachers); $i++){
                              echo '<option value="'.$teachers[$i]['id'].'">'.$teachers[$i]['first'].' '.$teachers[$i]['last'].'</option>';
                            }
                          }

                        ?>
                      </select> 
                    </div>
                  </div>
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker2" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>                                    
                  <div class="form-group">
                    <label for="desc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="desc" name="desc" placeholder="Description"></textarea>
                    </div>
                  </div>                                                                     

               </form>
              </div>
              <div class="modal-footer">
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addDemeritBtn" type="button" class="btn btn-primary">Add</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal" id="updateDemerit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Update Demerit Record</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <!-- addTeacher -->

                  <input type="hidden" name="demeritDbId" id="demeritDbId">

                  <div class="form-group">
                    <label for="upTeacherId" class="col-sm-3 control-label">Teacher Name</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="upTeacherId" id="upTeacherId">
                        <?php

                          if(count($teachers)>0){  

                            //$cells = array_values($levels[0]);

                            for($i = 0; $i < count($teachers); $i++){
                              echo '<option value="'.$teachers[$i]['id'].'">'.$teachers[$i]['first'].' '.$teachers[$i]['last'].'</option>';
                            }
                          }

                        ?>
                      </select> 
                    </div>
                  </div> 
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker2" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker2" autocomplete="off">
                      </div>                     
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
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="updateDemeritBtn" type="button" class="btn btn-primary">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->   

        <div class="modal" id="addJug">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Add Jug</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicke3" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker3" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>                                  
                  <div class="form-group">
                    <label for="jugDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="jugDesc" name="jugDesc" placeholder="Description"></textarea>
                    </div>
                  </div>                                                                     

               </form>
              </div>
              <div class="modal-footer">
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addJugBtn" type="button" class="btn btn-primary">Add</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->   

        <div class="modal" id="updateJug">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Update Jug Record</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <input type="hidden" name="jugDbId" id="jugDbId">
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker4" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker4" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div> 
                  <div class="form-group">
                    <label for="upJugStatus" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="upJugStatus" id="upJugStatus">
                        <option value="0">Pending</option>
                        <option value="1">Completed</option>
                      </select> 
                    </div>
                  </div>                                                   
                  <div class="form-group">
                    <label for="upJugDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="upJugDesc" name="upJugDesc" placeholder="Description"></textarea>
                    </div>
                  </div>                                                                     

               </form>
              </div>
              <div class="modal-footer">
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="updateJugBtn" type="button" class="btn btn-primary">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->  

        <div class="modal" id="addSuspension">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Add Suspension</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker5" class="col-sm-3 control-label">From</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker5" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker6" class="col-sm-3 control-label">To</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker6" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>                                                    
                  <div class="form-group">
                    <label for="susDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="susDesc" name="susDesc" placeholder="Description"></textarea>
                    </div>
                  </div>                                                                     

               </form>
              </div>
              <div class="modal-footer">
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addSuspensionBtn" type="button" class="btn btn-primary">Add</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal --> 

        <div class="modal" id="updateSuspension">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Update Suspension Record</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <input type="hidden" name="suspensionDbId" id="suspensionDbId">
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker7" class="col-sm-3 control-label">From</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker7" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker8" class="col-sm-3 control-label">To</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker8" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>                                                                     
                  <div class="form-group">
                    <label for="upSuspensionDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="upSuspensionDesc" name="upSuspensionDesc" placeholder="Description"></textarea>
                    </div>
                  </div>                                                                     

               </form>
              </div>
              <div class="modal-footer">
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="updateSuspensionBtn" type="button" class="btn btn-primary">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->  

        <div class="modal" id="addExpulsion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Add Expulsion</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker9" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker9" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>                                                   
                  <div class="form-group">
                    <label for="expDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="expDesc" name="expDesc" placeholder="Description"></textarea>
                    </div>
                  </div>                                                                     

               </form>
              </div>
              <div class="modal-footer">
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="addExpulsionBtn" type="button" class="btn btn-primary">Add</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal --> 

        <div class="modal" id="updateExpulsion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #3c8dbc; color:white;">
                <button id="xAddDemeritClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;">Update Expulsion Record</h4>
              </div>
              <div class="modal-body">
               <form class="form-horizontal">
                  <input type="hidden" name="expulsionDbId" id="expulsionDbId">
                  <div class="form-group" data-set_date="set" style="">
                    <label for="datepicker10" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-8">                      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker10" autocomplete="off">
                      </div>                     
                    </div>                  
                  </div>                                                                     
                  <div class="form-group">
                    <label for="upExpulsionDesc" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                      <textarea type="text" rows="4" class="form-control" id="upExpulsionDesc" name="upExpulsionDesc" placeholder="Description"></textarea>
                    </div>
                  </div>                                                                     

               </form>
              </div>
              <div class="modal-footer">
                <button id="addDemeritClose" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="updateExpulsionBtn" type="button" class="btn btn-primary">Update</button>
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
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- toastr link js -->
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/search.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/admin/student.js"></script>

<script>
  $(function () {

    $("#example1").DataTable({
      "aaSorting": []
    });

    $("#example2").DataTable({
      "aaSorting": []
    });

    $("#example3").DataTable({
      "aaSorting": []
    }); 

    $("#example4").DataTable({
      "aaSorting": []
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
      //format: 'yyyy-mm-dd'
      format: 'M dd, yyyy'
    });           

    $('#datepicker3').datepicker({
      autoclose: true,
      format: 'M dd, yyyy',
      immediateUpdates: true,
      todayBtn: true,
      todayHighlight: true
    })
    .datepicker("setDate", "0"); 

    $('#datepicker4').datepicker({
      autoclose: true,
      //format: 'yyyy-mm-dd'
      format: 'M dd, yyyy'
    }); 

    $('#datepicker5').datepicker({
      autoclose: true,
      format: 'M dd, yyyy',
      immediateUpdates: true,
      todayBtn: true,
      todayHighlight: true
    })
    .datepicker("setDate", "0"); 

    $('#datepicker6').datepicker({
      autoclose: true,
      format: 'M dd, yyyy',
      immediateUpdates: true,
      todayBtn: true,
      todayHighlight: true
    })
    .datepicker("setDate", "0");     

    $('#datepicker7').datepicker({
      autoclose: true,
      //format: 'yyyy-mm-dd'
      format: 'M dd, yyyy'
    });

    $('#datepicker8').datepicker({
      autoclose: true,
      //format: 'yyyy-mm-dd'
      format: 'M dd, yyyy'
    });

    $('#datepicker9').datepicker({
      autoclose: true,
      format: 'M dd, yyyy',
      immediateUpdates: true,
      todayBtn: true,
      todayHighlight: true
    })
    .datepicker("setDate", "0");  

    $('#datepicker10').datepicker({
      autoclose: true,
      //format: 'yyyy-mm-dd'
      format: 'M dd, yyyy'
    });                          

  });
</script>

</body>
</html>
