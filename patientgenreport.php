<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Hospital Management</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	 <link href="https://fonts.googleapis.com/css?family=Markazi+Text" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />

  </head>
<?php
session_start();
include("dbconnection.php");

?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">View Patient records</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

<section class="container">



	<table class="order-table" style="color:black">
       <thead style="color:black"> 
        <tr >
          <th width="15%" height="36"><div align="center">Patient Name</div></th>
          <th width="20%"><div align="center">Admission details</div></th>
          <th width="28%"><div align="center">Address</div></th>    
          <th width="20%"><div align="center">Patient Profile</div></th>
          
        </tr>
        </thead>
    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print report </button>

    <div class ="container">
      <p align ="center">
</p>
</div>

      <tbody>
   <?php
		$sql ="SELECT * FROM patient";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>$rs[patientname]<br>
		  <strong>Login ID :</strong> $rs[loginid] </td>
          <td>
		  <strong>Date</strong>: &nbsp;$rs[admissiondate]<br>
		 <strong>Time</strong>: &nbsp;$rs[admissiontime]</td>
		   <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
Mob No. - $rs[mobileno]</td>
			    <td><strong>Blood group</strong> - $rs[bloodgroup]<br>
<strong>Gender</strong> - &nbsp;$rs[gender]<br>
<strong>DOB</strong> - &nbsp;$rs[dob]</td>
 </tr>";
		}
		?>
      