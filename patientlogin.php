
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oeradeniya Dentals Patient Login</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	 <link href="https://fonts.googleapis.com/css?family=Markazi+Text" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

  </head>

<body>

<section id="top" class="clearfix">
 <div class="container">
  <div class="row">
   <div class="top clearfix">
    <div class="col-sm-6 top_left clearfix">
	 <div class="top_left_inner">
	  <h5>Peradeniya Dentals Hospital</h5>
	 </div>
	</div>
	<div class="col-sm-6 top_right clearfix">
	 <div class="top_right_inner">
	  <ul>
	   <li><i class="fa fa-map-marker"></i>Location: 494,Hospital Road,Jaffna</li>
	   <li><i class="fa fa-phone"></i>24/7 Emergency  <a href="#"> 021-2227655</a></li>
	  </ul>
	 </div>
	</div>
   </div>
  </div>
 </div>
</section>

<section id="header"  class="cd-secondary-nav">
	<nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><span class="liner_1">Peradeniya</span><span class="liner_2">Dentals</span></a>
            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="" href="index.php">HOME</a>
                    </li>
                     
                    <li>
                        <a class="" href="about.php">ABOUT US</a>
                    </li>
					
					<li>
                        <a class="" href="patientappointment.php">APPOINMENT</a>
                    </li>
                    <li>
                        <a class="active_tag" href="patientlogin.php">LOGIN</a>
                    </li>
                    <li>
                        <a class="hvr-reveal" href="patient.php">REGISTRATION</a>
                    </li>
					
                </ul>
			
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</section>





<?php
session_start();
include("x.php");
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
			$sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
			$qsql=mysqli_query($con,$sql);
			
			$sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]','$_POST[appreason]')";
			if($qsql = mysqli_query($con,$sql))
			{
				
				include("insertbillingrecord.php");	
				echo "<script>alert('Appointment record inserted successfully...');</script>";
				echo "<script>window.location='patientreport.php?patientid=$_POST[select4]';</script>";
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
      <li class="first"></li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

   <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
    <input type="hidden" name="select2" value="Offline" > 
    <table width="490" border="3">                
        <tr>
          <td width="150">Patient</td>
          <td width="320">
          <?php
		  if(isset($_GET[patid]))
			{
				$sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				$rspatient=mysqli_fetch_array($qsqlpatient);
				echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
				echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
			}
			else
			{
		  ?>
                  <select name="select4" id="select4">
                    <option value="">Select</option>
                    <?php
                    $sqlpatient= "SELECT * FROM patient WHERE status='Active'";
                    $qsqlpatient = mysqli_query($con,$sqlpatient);
                    while($rspatient=mysqli_fetch_array($qsqlpatient))
                    {
                        if($rspatient[patientid] == $rsedit[patientid])
                        {
                        echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                        }
                        else
                        {
                            echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                        }
                        
                    }
                  ?>
                  </select>
          <?php
			}
		?>
          </td>
        </tr>
      
        <tr>
          <td>Department</td>
          <td><select name="select5" id="select5">
           <option value="">Select</option>
            <?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$qsqldepartment = mysqli_query($con,$sqldepartment);
			while($rsdepartment=mysqli_fetch_array($qsqldepartment))
			{
				if($rsdepartment[departmentid] == $rsedit[departmentid])
				{
	echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
				}
				else
				{
  echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
				}
				
			}
		  ?>
          </select></td>
       
        </tr>
        <tr>
          <td>Appointment Date</td>
          <td><input type="date" name="appointmentdate" id="appointmentdate" value="<?php echo $rsedit[appointmentdate]; ?>" /></td>
        </tr>
        <tr>
          <td>Appointment Time</td>
          <td><input type="time" name="time" id="time" value="<?php echo $rsedit[appointmenttime]; ?>" /></td>
        </tr>
        <?php
		if(isset($_SESSION[doctorid]))
		{
			echo "<input type='hidden' name='select6' value='$_SESSION[doctorid]' >";
		}
		else
		{
		?>
        <tr>
          <td>Doctor</td>
          <td>
          <select name="select6" id="select6">
            <option value="">Select</option>
            <?php
          	$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			while($rsdoctor = mysqli_fetch_array($qsqldoctor))
			{
				if($rsdoctor[doctorid] == $rsedit[doctorid])
				{
				echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
				}
				else
				{
				echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
				}
			}
		  ?>
          </select></td>
         
        </tr>
        <?php
		}
		?>
         <tr>
          <td>Appointment reason</td>
          <td><textarea name="appreason" id="appreason" style="width:300px;height:100px;"><?php echo $rsedit[app_reason]; ?></textarea></td>
         
        </tr>		        
        <tr>
          <td>Status</td>
          <td><select name="select" id="select">
         
          <option value="">Select</option>
          <?php
		  $arr = array("Active","Inactive");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[status])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
           </select></td>
        </tr>	
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<section id="footer_main" class="clearfix">
	 <div class="col-sm-12 space_all">
	  <div class="footer_main_1">
	  <h4> <a href="adminlogin.php">Admin Login Panel</a> | <a href="doctorlogin.php">Doctor Login Panel</a></h4>
	    <p>© 2021 Peradeniya Dentals. All Rights Reserved. Design by<a href=https://peradeniyadent.com/"> Y2S2G1</a> </p>
	  </div>
	 </div>
</section>


<script type="application/javascript">

function validateform()
{
	if(document.frmappnt.select4.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmappnt.select4.focus();
		return false;
	}
	
	else if(document.frmappnt.select3.value == "")
	{
		alert("Room type should not be empty..");
		document.frmappnt.select3.focus();
		return false;
	}
	else if(document.frmappnt.select5.value == "")
	{
		alert("Department name should not be empty..");
		document.frmappnt.select5.focus();
		return false;
	}
	else if(document.frmappnt.appointmentdate.value == "")
	{
		alert("Appointment date should not be empty..");
		document.frmappnt.appointmentdate.focus();
		return false;
	}
	else if(document.frmappnt.time.value == "")
	{
		alert("Appointment time should not be empty..");
		document.frmappnt.time.focus();
		return false;
	}
	else if(document.frmappnt.select6.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmappnt.select6.focus();
		return false;
	}
	else if(document.frmappnt.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmappnt.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
