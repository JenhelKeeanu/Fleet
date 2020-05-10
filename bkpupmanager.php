<?php
session_start();
$addVcounter = 0;
if(isset($_SESSION['security']))
{
	if($_SESSION['security']!=1)
	{
		echo "<script>window.location.href='index.php';</script>";	
	} 
}
elseif(!isset($_SESSION['security'])) echo "<script>window.location.href='index.php';</script>";
if(isset($_POST['backV']))
{
	unset($_POST['addV']);
	$addVcounter = 0;
}
elseif(isset($_POST['saveVehicle']))
{
	include "data.php";
	$Q=mysqli_query($con,"SELECT * FROM vehicle_database where Vehicle_Plate='". $_POST['savePlate'] ."'");
	$N=mysqli_num_rows($Q);
	if($N>0)
	{
		echo "<script>alert('Plate Number is already taken!');</script>";
		$addVcounter = 1;	
	} 
	else
	{
		$Q=mysqli_query($con,"INSERT INTO vehicle_database 
		(Vehicle_Brand,
		Vehicle_Model,
		Vehicle_Plate,
		Status,
		PMS_Start,
		PMS_End) VALUES 
		('". $_POST['saveBrand'] ."',
		'". $_POST['saveModel'] ."',
		'". $_POST['savePlate'] ."',
		'". $_POST['saveStatus'] ."',
		'". $_POST['PMSStart'] ."',
		'". $_POST['PMSEnd'] ."')");
		echo "<script>alert('New vehicle has been added to the database!');window.location.href='manager.php?vehicle=1';</script>";
		$addVcounter = 0;
		mysqli_close();
	}
}
elseif(isset($_POST['logout']))
{
	$_SESSION['security']=0;
	echo "<script>alert('Account successfully logged-out!');window.location.href='index.php';</script>";
}
elseif(isset($_POST['viewHome']))
{
	echo "<script>window.location.href='manager.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	body{
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;
	}

	.topnav{
		/*overflow: hidden;*/
		background-color: #333;
		position: relative;
		display: block;
	}
	.topnav a{
		/*float: left;*/
		color: #f2f2f2;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 17px;
	}
	.topnav a:hover{
		background-color: #ddd;
		color: black;
	}
	.topnav a.active{
		background-color: #4caf50;
		color: white;
	}
	.dropbtn{
		background-color: #333;
		color: white;
		padding: 16px;
		font-size: 16px;
		border: none;
	}
	.dropdown{
		position: relative;
		display: inline-block;
	}
	.dropbtn1{
		background-color: #333;
		color: white;
		padding: 16px;
		font-size: 16px;
		border: none;
	}
	.dropdown-content{
		display: none;
		position: absolute;
		background-color: #f1f1f1;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px
		rgba(0,0,0,0.2);
		z-index: 1;
	}
	.dropdown-content a{
		color: black;
		padding-top: 12px 16px;
		text-decoration: none;
		display: block;
	}
	.dropdown-content a:hover{
		background-color: #ddd;
	}
	.dropdown:hover .dropdown-content{
		display: block;
	}
	.dropbtn:hover{
		background-color: #3e8e41;
	}
	.tableVehicle{
		border-collapse: collapse;
		/*width: 60%;*/
	}
	/*.tableVehicle th,td{
		padding: 8px;
	}*/
	tr:nth-child(even){
		background-color: #f2f2f2;
	}
	tr:nth-child(odd){
		background-color: #c0c0c0;
	}
	.button5 {
  		background-color: white;
  		color: black;
  		border: 2px solid #555555;
  		border-radius: 	4px;
  		font-size: 16px;
	}
	.button5:hover {
  		background-color: #555555;
  		color: white;
	}
	.table1{
		width: 30%;
	}
</style>
<body bgcolor="#d3d3d3">
<form action="#" method="POST">
<div class="topnav">
	<div class="dropdown">
		<button class="dropbtn">View Database</button>
		<div class="dropdown-content">
			<a href="manager.php?vehicle=1">Vehicle</a>
			<a href="manager.php?vrr=1">VRR</a>
			<a href="manager.php?users=1">Users</a>
		</div>
	</div>
	<button class="dropbtn" name="viewTools">Tools</button>
	<button class="dropbtn" name="viewAffiliates">Affiliates</button>
	<button class="dropbtn" name="viewAccount">Account</button>
	<button class="dropbtn" name="viewHome">Home</button>
	
	<button class="dropbtn" name="logout" style="float: right;">Log-out</button>
</div>
</form>
<center>	
<div style="padding-top: 50px;">
	<?php
	include 'data.php';
	$reservedquery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='Reserved'");
	$reservedtotal=mysqli_num_rows($reservedquery);
	$reservequery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='For Rent'");
	$reservetotal=mysqli_num_rows($reservequery);
	$repairquery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='For Repair'");
	$repairtotal=mysqli_num_rows($repairquery);
	$vehiclequery=mysqli_query($con,"SELECT * FROM vehicle_database");
	$vehicletotal=mysqli_num_rows($vehiclequery);
	$usersquery=mysqli_query($con,"SELECT * FROM users_database");
	$userstotal=mysqli_num_rows($usersquery);
	if(!isset($_GET['vehicle']) and !isset($_GET['vrr']) and !isset($_GET['users']))
	{
		echo '
		<table width="60%" border="0" style="border-collapse: collapse;" cellpadding="5">
		<tr>
			<td bgcolor="white" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; border-right: 2px solid black;">
				<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
					<tr>
						<td bgcolor="white"><b>Total Number of Cars for Reservation:</b> '.$reservetotal.'</td>
					</tr>
					<tr>
						<td bgcolor="white"><b>Total Number of VRR Tickets:</b> </td>
					</tr>
					<tr>
						<td bgcolor="white"><b>Total Number of Cars Reserved:</b> '.$reservedtotal.'</td>
					</tr>
					<tr>
						<td bgcolor="white"><b>Total Number of Cars Under Repair:</b> '.$repairtotal.'</td>
					</tr>
				</table>
			</td>
			<td bgcolor="white" style="border-right: 2px solid black;">
				<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
					<tr>
						<td bgcolor="white"><b>Total Number of User Accounts:</b> '.$userstotal.'</td>
					</tr>
					<tr>
					<td bgcolor="white"><b>Total Number of Affiliates:</b> </td>
					</tr>
					<tr>
						<td bgcolor="white"><b>Total Number of Owned Vehicles:</b> '.$vehicletotal.'</td>
					</tr>
				</table>
			</td>
			<td bgcolor="white" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
				<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
					<tr>
						<td bgcolor="white"><b>Account Type:</b> <br>'.$_SESSION['Accounttype'].'</td>
					</tr>
					<tr>
						<td bgcolor="white"><b>Full Name:</b> <br>'.$_SESSION['Fullname'].'</td>
					</tr>
					<tr>
						<td bgcolor="white"><b>Contact Number:</b> <br>'.$_SESSION['Contact'].'</td>
					</tr>
					<tr>
						<td bgcolor="white"><b>E-mail:</b> <br>'.$_SESSION['Email'].'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
		';
	}
	?>
	<!-- 
					
					
			
						
			
					
					
					
			 -->
	<?php
	if(isset($_GET['vehicle']) and !isset($_POST['addV']) and $addVcounter!=1)
	{
		echo "
		<form action='#' method='POST'>
		<table style='width: 60%;' border='0'>
		<tr>
		<td width='32%' align='left' bgcolor='#d3d3d3'>Search By: 
		<select id='searchby' name='searchby' style='min-width: 150px;' onchange='functsearch()'>
		<option>-Select-</option>
		<option value='PlateNo' ";
		if(isset($_GET['vehicle'])) if($_GET['vehicle']=="PlateNo") echo "selected";
		echo ">Plate No.</option>
		<option value='VehicleBrand' ";
		if(isset($_GET['vehicle'])) if($_GET['vehicle']=="VehicleBrand") echo "selected";
		echo ">Vehicle Brand</option>
		<option value='VehicleModel' ";
		if(isset($_GET['vehicle'])) if($_GET['vehicle']=="VehicleModel") echo "selected";
		echo ">Vehicle Model</option>
		<option value='Status' ";
		if(isset($_GET['vehicle'])) if($_GET['vehicle']=="Status") echo "selected";
		echo ">Status</option>
		</select>
		<input type='text' id='searchid' hidden>
		</td>
		";
		if($_GET['vehicle']=="VehicleBrand") echo "
		<td width='20%' bgcolor='#d3d3d3'>
		<input type='text' name='searchBrand' placeholder='Vehicle brand...'>
		</td>
		<td bgcolor='#d3d3d3'>
		<input type='submit' name='searchRecord' class='button button5' value='Search'>
		</td>";

		elseif($_GET['vehicle']=="PlateNo") echo "
		<td width='20%' bgcolor='#d3d3d3'>
		<input type='text' name='searchPlate' placeholder='Plate Number...'>
		</td>
		<td bgcolor='#d3d3d3'>
		<input type='submit' name='searchRecord' class='button button5' value='Search'>
		</td>";

		elseif($_GET['vehicle']=="VehicleModel") echo "
		<td width='20%' bgcolor='#d3d3d3'>
		<input type='text' name='searchModel' placeholder='Vehicle Model...'>
		</td>
		<td bgcolor='#d3d3d3'>
		<input type='submit' name='searchRecord' class='button button5' value='Search'>
		</td>";
		elseif($_GET['vehicle']=="Status") echo "
		<td width='20%' bgcolor='#d3d3d3'>
		<select name='searchStatus'>
		<option>For Rent</option>
		<option>For Repair</option>
		<option>Reserved</option>
		</select>
		</td>
		<td bgcolor='#d3d3d3'>
		<input type='submit' name='searchRecord' class='button button5' value='Search'>
		</td>";

		echo "
		<td align='right' bgcolor='#d3d3d3'>
		<input type='submit' name='addV' class='button button5' value='Add Vehicle'>
		</td>
		</tr>
		</table>";
		if(isset($_POST['searchRecord']))
		{
			if(isset($_POST['searchPlate']))
			{
				echo "
				<table width='60%' class='tableVehicle'>
					<tr>
						<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
							border-top-left-radius: 15px;
							border-top-right-radius: 15px;'><h2>Vehicle Database<h2></td>
					</tr>
					<tr style='background-color: #778899;'>
						<td align='center'><b>Plate No.</b></td>
						<td align='center'><b>Vehicle Brand</b></td>
						<td align='center'><b>Vehicle Model</b></td>
						<td align='center'><b>Status</b></td>
						<td align='center'><b>PMS</b></td>
						<td align='center'>--</td>
					</tr>
				";
				include "data.php";
				$q=mysqli_query($con,"SELECT * FROM vehicle_database where Vehicle_Plate LIKE '". $_POST['searchPlate'] ."%'");
				while($r=mysqli_fetch_array($q))
				{
					echo "
					<tr>
						<td align='center'>{$r['Vehicle_Plate']}</td>
						<td align='center'>{$r['Vehicle_Brand']}</td>
						<td align='center'>{$r['Vehicle_Model']}</td>
						<td align='center'>{$r['Status']}</td>
						<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
						<td align='center'><a href=''><i class='fa fa-edit' style='font-size:20px'></i></a> | <a href=''><i class='fa fa-trash' style='font-size:20px'></i></a></td>
					</tr>
					";
				}
				echo "
				</table>
				</form>
				";
			}
			if(isset($_POST['searchBrand']))
			{
				echo "
				<table width='60%' class='tableVehicle'>
					<tr>
						<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
							border-top-left-radius: 15px;
							border-top-right-radius: 15px;'><h2>Vehicle Database<h2></td>
					</tr>
					<tr style='background-color: #778899;'>
						<td align='center'><b>Plate No.</b></td>
						<td align='center'><b>Vehicle Brand</b></td>
						<td align='center'><b>Vehicle Model</b></td>
						<td align='center'><b>Status</b></td>
						<td align='center'><b>PMS</b></td>
						<td align='center'>--</td>
					</tr>
				";
				include "data.php";
				$q=mysqli_query($con,"SELECT * FROM vehicle_database where Vehicle_Brand LIKE '". $_POST['searchBrand'] ."%'");
				while($r=mysqli_fetch_array($q))
				{
					echo "
					<tr>
						<td align='center'>{$r['Vehicle_Plate']}</td>
						<td align='center'>{$r['Vehicle_Brand']}</td>
						<td align='center'>{$r['Vehicle_Model']}</td>
						<td align='center'>{$r['Status']}</td>
						<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
						<td align='center'><a href=''><i class='fa fa-edit' style='font-size:20px'></i></a> | <a href=''><i class='fa fa-trash' style='font-size:20px'></i></a></td>
					</tr>
					";
				}
				echo "
				</table>
				</form>
				";
			}
			if(isset($_POST['searchModel']))
			{
				echo "
				<table width='60%' class='tableVehicle'>
					<tr>
						<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
							border-top-left-radius: 15px;
							border-top-right-radius: 15px;'><h2>Vehicle Database<h2></td>
					</tr>
					<tr style='background-color: #778899;'>
						<td align='center'><b>Plate No.</b></td>
						<td align='center'><b>Vehicle Brand</b></td>
						<td align='center'><b>Vehicle Model</b></td>
						<td align='center'><b>Status</b></td>
						<td align='center'><b>PMS</b></td>
						<td align='center'>--</td>
					</tr>
				";
				include "data.php";
				$q=mysqli_query($con,"SELECT * FROM vehicle_database where Vehicle_Model LIKE '". $_POST['searchBrand'] ."%'");
				while($r=mysqli_fetch_array($q))
				{
					echo "
					<tr>
						<td align='center'>{$r['Vehicle_Plate']}</td>
						<td align='center'>{$r['Vehicle_Brand']}</td>
						<td align='center'>{$r['Vehicle_Model']}</td>
						<td align='center'>{$r['Status']}</td>
						<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
						<td align='center'><a href=''><i class='fa fa-edit' style='font-size:20px'></i></a> | <a href=''><i class='fa fa-trash' style='font-size:20px'></i></a></td>
					</tr>
					";
				}
				echo "
				</table>
				</form>
				";
			}
			if(isset($_POST['searchStatus']))
			{
				echo "
				<table width='60%' class='tableVehicle'>
					<tr>
						<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
							border-top-left-radius: 15px;
							border-top-right-radius: 15px;'><h2>Vehicle Database<h2></td>
					</tr>
					<tr style='background-color: #778899;'>
						<td align='center'><b>Plate No.</b></td>
						<td align='center'><b>Vehicle Brand</b></td>
						<td align='center'><b>Vehicle Model</b></td>
						<td align='center'><b>Status</b></td>
						<td align='center'><b>PMS</b></td>
						<td align='center'>--</td>
					</tr>
				";
				include "data.php";
				$q=mysqli_query($con,"SELECT * FROM vehicle_database where Status='". $_POST['searchStatus'] ."'");
				while($r=mysqli_fetch_array($q))
				{
					echo "
					<tr>
						<td align='center'>{$r['Vehicle_Plate']}</td>
						<td align='center'>{$r['Vehicle_Brand']}</td>
						<td align='center'>{$r['Vehicle_Model']}</td>
						<td align='center'>{$r['Status']}</td>
						<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
						<td align='center'><a href=''><i class='fa fa-edit' style='font-size:20px'></i></a> | <a href=''><i class='fa fa-trash' style='font-size:20px'></i></a></td>
					</tr>
					";
				}
				echo "
				</table>
				</form>
				";
			}
		}

		//end of line
		// <td><input type='text' placeholder='Search Plate Number..' size='25'></td>
		// </tr>
		// </table>
		
	}
	elseif(isset($_POST['addV']) or $addVcounter==1)
	{
		echo "
		<form action='#' method='POST'>
		<table cellspacing='10' width='30%' border='0' bgcolor='white' style='margin: 60px; border-radius: 20px;'>
		<tr>
		<td bgcolor='white'>Plate No.:</td>
		<td bgcolor='white'><input type='text' name='savePlate' size='30%'></td>
		</tr>
		<tr>
		<td bgcolor='white'>Vehicle Brand:</td>
		<td bgcolor='white'><input type='text' name='saveBrand' size='30%'></td>
		</tr>
		<tr>
		<td bgcolor='white'>Vehicle Model:</td>
		<td bgcolor='white'><input type='text' name='saveModel' size='30%'></td>
		</tr>
		<tr>
		<td bgcolor='white'>Status:</td>
		<td bgcolor='white'>
		<select style='font-size: 15px;' name='saveStatus'>
		<option>For Rent</option>
		<option>For Repair</option>
		<option>Reserved</option>
		</select>
		</td>
		</tr>
		<tr>
		<td colspan='2' bgcolor='white'><b>Maintenance Period</b></td>
		</tr>
		<tr>
		<td bgcolor='white'><font style='font-size: 12px;'>Start Date:</font><br><input type='date' name='PMSStart'></td>
		<td bgcolor='white'><font style='font-size: 12px;'>End Date:</font><br><input type='date' name='PMSEnd'></td>
		</tr>
		<tr>
		<td bgcolor='white'><input type='submit' name='saveVehicle' class='button button5' value='Save'></td>
		<td align='right' bgcolor='white'><input type='submit' name='backV' class='button button5' value='Back'></td>
		</tr>
		</table>
		</form>";
	}
	?>
</div>
</center>
<script>
	function functsearch(){
		var s = document.getElementById("searchby").value;
		window.location.href = "manager.php?vehicle="+s;
	}
</script>   
</script>		
</body>
</html>