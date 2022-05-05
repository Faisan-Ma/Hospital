<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('appointment record deleted successfully..');</script>";
	}
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">View Treatment Records</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <form method="post" action="">
      <table width="692" border="3" style="color:black">
	  <thead>
          <tr>
            <th width="71">Treatment Type</th>
            <th width="52"></th>
            <th width="78">Doctor</th>
            <th width="82">Treatment Description</th>
            <th width="43">Treatment Date</th>
            <th width="43">Treatment Time</th>
     
          </tr>
</thead>
<tbody>

          <?php
		$sql ="SELECT * FROM treatment_records where status='Active'";
		if(isset($_SESSION[patientid]))
		{
			$sql = $sql . " AND patientid='$_SESSION[patientid]'"; 
		}
		if(isset($_SESSION[doctorid]))
		{
			$sql = $sql . " AND doctorid='$_SESSION[doctorid]'";
		}
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($con,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($con,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			$rstreatment = mysqli_fetch_array($qsqltreatment);
			
        echo "<tr>
          <td>&nbsp;$rstreatment[treatmenttype]</td>
		  <td>&nbsp;$rspat[patientname]</td>
		  <td>&nbsp;$rsdoc[doctorname]</td>
	      <td>&nbsp;$rs[treatment_description]</td>
		  <td>&nbsp;$rs[treatment_date]</td>
		  <td>&nbsp;$rs[treatment_time]</td>";  
	
       echo " </tr>";
		}
		?>
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
<?php
include("footers.php");
?>