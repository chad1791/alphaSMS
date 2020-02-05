<?php
    if($this->session->userdata('student_id')){
        //echo $this->session->userdata('admin_id');
      $student_email = $this->session->userdata('email');


        $timezone = new \DateTimeZone('America/Belize');
        $date = new \DateTime('@' . time(), $timezone); 
        $date->setTimezone($timezone);
        $today = $date->format('d M Y');
 
        //getting default events for user...

        $myEvents = array();
 
        if($this->session->userdata('myEvents')){    
            $myEvents = $this->session->userdata('myEvents');         
        } 

        //getting profile data

        $stdProfile = array();

        if($this->session->userdata('stdProfile')){    
            $stdProfile = $this->session->userdata('stdProfile'); 
            //$ad_id = $profile[0]['id'];       
        }

        //getting class assignments

        $myAssignments = array(); 

        if($this->session->userdata('myAssignments')){    
            $myAssignments = $this->session->userdata('myAssignments'); 
            //$ad_id = $profile[0]['id'];       
        }

        //getting class attachments

        $myFiles = array(); 

        if($this->session->userdata('myFiles')){    
            $myFiles = $this->session->userdata('myFiles'); 
            //$ad_id = $profile[0]['id'];       
        }

        //getting my class data

        $myClass = array(); //myUploadedFiles

        if($this->session->userdata('myClass')){    
            $myClass = $this->session->userdata('myClass'); 
            //$ad_id = $profile[0]['id'];       
        }  

        //getting my uploaded files

        /*$myUploadedFiles = array();

        if($this->session->userdata('myUploadedFiles')){    
            $myUploadedFiles = $this->session->userdata('myUploadedFiles'); 
            //$ad_id = $profile[0]['id'];       
        }*/

        //echo '<pre>';
        //print_r($myClass);
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
        redirect('/students/login');
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alpha SMS | Dashboard</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">

    .container {
      position: relative;
      width: 100%;
    }

    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      border-radius:5px;
    }

    .container:hover .card {
      opacity: 0.4;
    }

    .container:hover .middle {
      opacity: 1;
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

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
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
        Dashboard
        <small>Student Portal</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-university"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <input type="hidden" name="base_url" id="base_url" value="<?=base_url(); ?>">
      <input type="hidden" name="student_id" id="student_id" value="<?=$this->session->userdata('student_id'); ?>">

      <div class="row">

        <div class="col-md-7">
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">School Events Timeline</h3><span class="pull-right" style="cursor: pointer;"><button class="btn btn-success"><i class="fa fa-file-text"></i> Print</button></span>
            </div>
            <div class="box-body">

              <ul class="timeline">
                <?php 

                    $bkground = array('bg-red','bg-yellow','bg-blue','bg-maroon','bg-aqua','bg-green','bg-purple','bg-gray');
                    $colorCounter = 0;

                    if(count($myEvents)>0){

                      $currentMonth = $myEvents[0]['start'];

                      //change date to new format...
                      $txtDate = date('d M Y', strtotime($currentMonth));
                      $timeDate = date('H:i:s', strtotime($currentMonth));

                      if($timeDate == '00:00:00'){
                        $timeDate = 'No time provided!';
                      }

                      echo '<li class="time-label">'.
                              '<span class="'.$bkground[$colorCounter].'">'.
                                $txtDate.
                              '</span>'.
                            '</li>';

                      for ($i=0; $i < count($myEvents); $i++) { 
                        
                        if($myEvents[$i]['start'] != $currentMonth){ //knowing when to change month...

                          //change date to new format...
                          $txtDate = date('d M Y', strtotime($myEvents[$i]['start'])); 
                          $timeDate = date('H:i:s', strtotime($currentMonth));

                          if($timeDate == '00:00:00'){
                            $timeDate = 'No time provided!';
                          }

                          echo '<li class="time-label">'.
                                  '<span class="'.$bkground[$colorCounter].'">'.
                                      $txtDate.
                                  '</span>'.
                                '</li>';

                          $currentMonth = $myEvents[$i]['start'];
                        }

                        echo  '<li>'.
                                '<i class="fa fa-calendar '.$bkground[$colorCounter].'"></i>'.
                                '<div class="timeline-item">'.
                                  '<span class="time"><i class="fa fa-clock-o"></i> '.$timeDate.'</span>'.
                                  '<h3 class="timeline-header"><b>'.$myEvents[$i]['title'].'</b></h3>'.
                                  '<div class="timeline-body">';

                                     if($myEvents[$i]['des'] != ''){
                                        echo $myEvents[$i]['des'].'<br/><br/>';
                                     }

                                     if($myEvents[$i]['url'] != ''){
                                        echo 'Link: <a href="'.$myEvents[$i]['url'].'">Click to follow</a>';
                                     }
                                     else{
                                        echo 'Link: None';
                                     }

                                     
                             echo '</div>'.
                                  '<div class="timeline-footer">'.
                                  //'<!--a class="btn btn-warning btn-flat btn-xs">View comment</a-->'.
                                  '</div>'.
                                '</div>'.
                              '</li>';

                        $colorCounter++;

                        if($colorCounter == (count($bkground)-1)){
                          $colorCounter = 0;
                        }
                      }

                    }
                    else{
                      //echo 'No events were found on the database!';

                      echo '<li class="time-label">'.
                              '<span class="bg-red">'.
                                  $today.
                              '</span>'.
                            '</li>'.
                            '<li>'.
                              '<i class="fa fa-frown-o bg-yellow"></i>'.
                              '<div class="timeline-item">'.
                                '<span class="time"></span>'.
                                '<h3 class="timeline-header">No events were found on the database!</h3>'.
                              '</div>'.
                            '</li>';
                    }

                ?>
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>              
              <!-- /input-group -->
            </div>
          </div>
          <!-- /. box -->
        </div>

        <?php //allow student to download file, allow student to upload file, fix allow uploads top.


          ////////////////////////////////////////////////////////////

                function getTheDay($date)
                {
                    $curr_date=strtotime(date("Y-m-d H:i:s"));
                    $the_date=strtotime($date);
                    $diff=floor(($curr_date-$the_date)/(60*60*24));
                    switch($diff)
                    {
                        case 0:
                            return "Today";
                            break;
                        case 1:
                            return "Yesterday";
                            break;
                        default:
                            return $diff." Days ago";
                    }
                }

          ///////////////////////////////////////////////////////////

          $colorsList = array('#273746','#008000','#000080','#FF00FF','#8E44AD','#2980B9','#16A085','#F1C40F','#D35400','#C0392B','#34495E','#FF0000');

          $count = 0;

          if(count($myAssignments)>0){

            echo '<div class="col-md-5">';

            for ($i=0; $i < count($myAssignments); $i++) { 

              //get formatted date for date posted...

              $datePosted = getTheDay($myAssignments[$i]['created_on']);

              $myFilesList = array_keys(array_column($myFiles, 'assignment_id'), $myAssignments[$i]['id']);

              //re-do with jquery .load function along with scroll listener...

              echo '<div class="row col-md-12">'.
                      '<div class="box box-solid">'.
                        '<div class="box-header with-border" style="background-color:'.$colorsList[$count].'; color:white;">'.
                          '<h3 class="box-title">'.$myAssignments[$i]['title'].'</h3>'.'<small><span class="pull-right"><b>Posted '.$datePosted.'</b></span></small>'.
                        '</div>'.
                        '<div class="box-body" style="text-align: justify;">'.
                            $myAssignments[$i]['des'].
                            '<br/>';

                            if($myAssignments[$i]['attachments'] != 0){

                              //do the array_search to get the attachments link...

                              echo '<br/><div class="row"><span style="padding-left:15px;"><small><b>Attachments:</b></small></span><br/><br/>'.
                                   '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';

                              for ($f=0; $f < count($myFilesList); $f++) { 

                                $fileExt = substr($myFiles[$f]['name'], strrpos($myFiles[$f]['name'], '.') + 1);

                                switch ($fileExt) { 
                                  case 'jpg': //for images
                                  case 'png':
                                  case 'jpeg':
                                  case 'jif':
                                     $fileType = 'defaultImage.jpg';
                                     //$fileType = 'defFile.ico';
                                    break;
                                  case 'txt': //for text files
                                     $fileType = 'txtDefault.png';
                                    break; 
                                  case 'pdf': //for pdf files
                                     $fileType = 'pdfDefault.png'; 
                                    break; 
                                  case 'ppt': //for powerpoint files
                                  case 'pptx':
                                     $fileType = 'pptDefault.png';
                                    break; 
                                  case 'doc': //for word documents
                                  case 'docx':
                                     $fileType = 'wordDefault.png';
                                    break; 
                                  case 'xls': //for excel documents
                                  case 'xlsx':
                                     $fileType = 'excelDefault.png';
                                    break;                
                                  case 'sql': //for databases
                                     $fileType = 'sqlDefault.png';
                                    break;
                                  case 'mdb':
                                  case 'accdb':
                                  case 'laccdb':
                                     $fileType = 'accessDefault.png';
                                    break;
                                  case 'dwg': //for autocad files
                                  case 'dxf':
                                     $fileType = 'cadDefault.jpg';
                                    break;
                                  default: //for any other types...
                                     $fileType = 'defFile.ico';
                                    break;
                                }

                                //$fileType = '';

                                echo '<div class="col-md-6 col-xs-4 col-sm-3 col-lg-4" id="upCard">'.
                                      '<div class="box box-solid">'.
                                        '<div class="box-body with-border container" style="height:90px; font-size:10px; background-image:url(\'../custom/system/images/'.$fileType.'\'); background-size: cover; background-repeat:no-repeat; ">'.
                                        '<div class="middle"><a target="_blank" href="../Students/downloadFile?file='.$myFiles[$f]['new_name'].'" class="btn btn-primary" data-fileName="'.$myFiles[$f]['new_name'].'" data-download="downloadFile"><i class="fa fa-download"></i></a></div>'. 
                                          //'<span class="pull-right" style="cursor:pointer; font-size:15px; width:100%; display: block; padding: 0px; background-color:red; margin-top:-10px;"><i class="fa fa-arrow-circle-down"></i></span>'.
                                          //'<div style="margin-left:-5%; position:absolute; line-height:18; float:left;"><small>'.$myFiles[$f]['name'].'</small></div>'.
                                        '</div>'.
                                      '</div>'.                                        
                                     '</div>';

                                if($f == (count($myFilesList)-1)){
                                  echo '<br/><br/>';
                                }
                              }
                              
                              echo '</div></div>';
                            } 


                            //loop for attachments that match this assignment...

                            /*$myUpAttachments = array();

                            foreach ($myUploadedFiles as $key => $value) {

                              if($myAssignments[$i]['id'] == $value['assignment_id']){
                                array_push($myUpAttachments,$value);
                              }
                              
                            }*/

                            //print_r($myUpAttachments);

                            if($myAssignments[$i]['allow_upload'] == 1){

                              //box for student uploaded files...

                              echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'.
                                      '<span style="font-weight:bold; "><small>Files uploaded</small></span><br>'.
                                      '<div id="studentFiles'.$myAssignments[$i]['id'].'" class="col-md-6 col-xs-4 col-sm-3 col-lg-4">';

                                 echo '</div><br/>'.
                                   '</div></div>';

                              echo '<div id="uploadSection" class="row" style="position: relative;"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><span><small><b>Upload Assignment:</b></small></span><input type="file" name="files" id="files" data-ass_id="'.$myAssignments[$i]['id'].'"/></div></div>';
                              echo '<br/><br/>';
                            }



                      echo  '<div class="box-footer with-border" id="footer">'.
                            '<span class="pull-left">Expires in: <i class="fa fa-clock-o"></i> <small><span data-fnx="count_down" id="'.$myAssignments[$i]['expiry_date'].' '.$myAssignments[$i]['time'].'"></span></small></span>'.
                          '</div>'.
                        '</div>'.
                      '</div>'.
                   '</div>';

              $count++;

              if($count == (count($colorsList) - 1)){  
                $count = 0;
              }

            }

            echo '</div>';

          }
          else{

            echo '<div class="col-md-5">'.
                    '<div class="box box-solid">'.
                      '<div class="box-header with-border">'.
                        '<h3 class="box-title">My Assignments</h3>'.
                      '</div>'.
                      '<div class="box-body">'.
                          'No assignments have been posted for your class!'.
                        '<div class="box-footer with-border">'.
                        '</div>'. 
                      '</div>'.
                    '</div>'.
                 '</div>';

          }

        ?>

        <!--div class="col-md-3">
          <!-- /. box -->
          <!--div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Sample Assignment</h3>
            </div>
            <div class="box-body">
              <div class="box-footer with-border"></div>
            </div>
          </div>         
        </div-->


        <!--div class="col-md-3">
          <div class="box box-solid" style="max-height: 500px; height: 500px; overflow-y: scroll;">
            <div class="box-header with-border">
              <h3 class="box-title">My Todo List</h3><span class="pull-right" style="cursor: pointer;"><i class="fa fa-plus"></i></span>
            </div>
            <div class="box-body">

              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                    <td class="mailbox-date"><i class="fa fa-times" style="cursor:pointer;"> <i class="fa fa-pencil" style="cursor:pointer;"></i></i></td>
                    <td class="mailbox-subject">Read a book</td>
                    <td><input type="checkbox"></td>
                  </tr>
                  </tbody>
                </table>
              </div>              
              
            </div>
          </div>         
        </div-->

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
<!-- iCheck -->  
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<!--script type="text/javascript" src="<?php //echo base_url(); ?>comet/prototype.js"></script-->

<script type="text/javascript" src="<?php echo base_url();?>/custom/js/student/dashboard.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/student/uploadAssignment.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/custom/js/student/comet.js"></script>  

</body>
</html>