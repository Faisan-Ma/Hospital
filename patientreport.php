

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Hospital Management System</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	 <link href="https://fonts.googleapis.com/css?family=Markazi+Text" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

  </head>

<body>



<?php
session_start();
include("x.php");
include("headers.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
			if($qsql = mysqli_query($con,$sql))
			{
				echo "<script>alert('appointment record updated successfully...');</script>";
			}
			else
			{
				echo mysqli_error($con);
			}	
		}
		else
		{
			$sql ="INSERT INTO appointment(patientid,departmentid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
			if($qsql = mysqli_query($con,$sql))
			{
				echo "<script>alert('Appointment record inserted successfully...');</script>";
			}
			else
			{
				echo mysqli_error($con);
			}
		}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Patient Report Panel</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <p>
    
    <!-- jQuery Library -->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) { 

	// Find the toggles and hide their content
	$('.toggle').each(function(){
		$(this).find('.toggle-content').hide();
	});

	// When a toggle is clicked (activated) show their content
	$('.toggle a.toggle-trigger').click(function(){
		var el = $(this), parent = el.closest('.toggle');

		if( el.hasClass('active') )
		{
			parent.find('.toggle-content').slideToggle();
			el.removeClass('active');
		}
		else
		{
			parent.find('.toggle-content').slideToggle();
			el.addClass('active');
		}
		return false;
	});

});  //End
</script>
<!-- Toggle CSS -->
<style type="text/css">

/* Main toggle */
.toggle { 
	font-size: 13px;
	line-height:20px;
	font-family: "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
	background: #ffffff; /* Main background */
	margin-bottom: 10px;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	   -moz-border-radius: 5px;
	        border-radius: 5px;	
}

/* Toggle Link text */
.toggle a.toggle-trigger {
	display:block;
	padding: 10px 20px 15px 20px;
	position:relative;
	text-decoration: none;
	color: #666;
}

/* Toggle Link hover state */
.toggle a.toggle-trigger:hover {
	opacity: .8;
	text-decoration: none;
}

/* Toggle link when clicked */
.toggle a.active {
	text-decoration: none;
	border-bottom: 1px solid #e5e5e5;
	-webkit-box-shadow: 0 8px 6px -6px #ccc;
	   -moz-box-shadow: 0 8px 6px -6px #ccc;
	        box-shadow: 0 8px 6px -6px #ccc;
	color: #000;
}

/* Lets add a "-" before the toggle link */
.toggle a.toggle-trigger:before {
	content: "-";	/* You can add any symbol, font icon, or graphic icon */
	margin-right: 10px;
	font-size: 1.3em;	
}

/* When the toggle is active, change the "-" to a "+" */
.toggle a.active.toggle-trigger:before {
	content: "+";
}

/* The content of the toggle */
.toggle .toggle-content {
	padding: 10px 20px 15px 20px;
	color:#666;
}

</style>
<!-- Toggle #1 -->
<div class="toggle">
	<!-- Toggle Link -->
	<a href="#" title="Title of Toggle" class="toggle-trigger">Patient Profile</a>
	<!-- Toggle Content to display -->
	<div class="toggle-content">
		<p><?php include("patientdetail.php"); ?></p>
	</div><!-- .toggle-content (end) -->
</div><!-- .toggle (end) -->

<!-- Toggle #2 -->
<div class="toggle">
	<!-- Toggle Link -->
	<a href="#" title="Title of Toggle" class="toggle-trigger">Appointment record</a>
	<!-- Toggle Content to display -->
	<div class="toggle-content">
		<p><?php include("appointmentdetail.php"); ?></p>
	</div><!-- .toggle-content (end) -->
</div><!-- .toggle (end) -->






  

    </p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>

