<?php
session_start();
if(isset($_POST['logout']))
{
	$_SESSION['security']=0;
	echo "<script>alert('Account successfully logged-out!');window.location.href='index.php';</script>";
}
elseif(isset($_POST['logout']))
{
	$_SESSION['security']=0;
	echo "<script>alert('Account successfully logged-out!');window.location.href='index.php';</script>";
}
elseif(isset($_POST['viewHome']))
{
	$_SESSION['updateCounter'] = 0;
	echo "<script>window.location.href='qualityControl.php';</script>";
}
elseif(isset($_POST['newVRR']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	$updateVRRrecord = mysqli_query($con,"UPDATE vrr_database SET
	VRR_Type = '". $_POST['newType'] ."',
	Plate_No = '". $_POST['newPlate'] ."',
	Car_Brand = '". $_POST['newBrand'] ."',
	Car_Type = '". $_POST['newModel'] ."',
	ODO = '". $_POST['newODO'] ."',
	VRR_Concern = '". $_POST['newConcern'] ."' WHERE VRR_ID = '". $_SESSION['vrrNo'] ."'");
	$newVRRnote = mysqli_query($con,"INSERT INTO vrrnotes_database
	(VRR_ID,
	Note_Type,
	User_Note,
	Note_date,
	Note_Time) VALUES 
	('". $_SESSION['vrrNo'] ."',
	'Ticket Updated',
	'By: ". $_SESSION['Fullname'] ."',
	'". $dateToday ."',
	'". $timeToday ."')");
	echo "
	<script>
		alert('VRR ticket successfully Updated.');
		window.location.href='qualityControl.php?vrrDetails={$_SESSION['vrrNo']}';
	</script>";
}
elseif(isset($_POST['updateAccount']))
{
	include "data.php";
	$updateArecord = mysqli_query($con,"SELECT * FROM users_database WHERE Username = '". $_POST['updateUsername'] ."'");
	$nUpdate = mysqli_num_rows($updateArecord);
	if($nUpdate>0)
	{
		while($rdetails = mysqli_fetch_array($updateArecord))
		{
			$_SESSION['detailsID'] = $rdetails['User_ID'];
			$detailsID = $rdetails['User_ID'];
			$detailsFirst = $rdetails['First_Name'];
			$detailsMiddle = $rdetails['Middle_Name'];
			$detailsLast = $rdetails['Last_Name'];
			$detailsContact = $rdetails['Contact_No'];
			$detailsBirth = $rdetails['Birthday'];
			$detailsEmail = $rdetails['Email'];
			$detailsType = $rdetails['Account_Type'];
			$detailsAddress = $rdetails['Address'];
			$detailsUsername = $rdetails['Username'];
			$detailsPassword = $rdetails['Password'];
		}
		if($detailsUsername == $_POST['updateUsername'])
		{
			$updated = mysqli_query($con,"UPDATE users_database SET 
			Username = '". $_POST['updateUsername'] ."',
			Password = '". $_POST['updatePassword'] ."',
			First_Name = '". $_POST['updateFirst'] ."',
			Middle_Name = '". $_POST['updateMiddle'] ."',
			Last_Name = '". $_POST['updateLast'] ."',
			Contact_No = '". $_POST['updateContact'] ."',
			Birthday = '". $_POST['updateBirth'] ."',
			Account_Type = '". $_POST['updateType'] ."',
			Email = '". $_POST['updateEmail'] ."',
			Address = '". $_POST['updateAddress'] ."' WHERE User_ID = '". $_SESSION['detailsID'] ."'");
			echo "<script>alert('Account details successfully updated.{$detailsID}');</script>";
			$_SESSION['updateCounter'] = 1;
		}
		else
		{
			$_SESSION['updateCounter'] = 1;
			echo "<script>alert('Username already taken!');</script>";
		}
	}
	else
	{
		$updated = mysqli_query($con,"UPDATE users_database SET 
		Username = '". $_POST['updateUsername'] ."',
		Password = '". $_POST['updatePassword'] ."',
		First_Name = '". $_POST['updateFirst'] ."',
		Middle_Name = '". $_POST['updateMiddle'] ."',
		Last_Name = '". $_POST['updateLast'] ."',
		Contact_No = '". $_POST['updateContact'] ."',
		Birthday = '". $_POST['updateBirth'] ."',
		Account_Type = '". $_POST['updateType'] ."',
		Email = '". $_POST['updateEmail'] ."',
		Address = '". $_POST['updateAddress'] ."' WHERE User_ID = '". $_SESSION['detailsID'] ."'");
		echo "<script>alert('Account details successfully updated.');</script>";
		$_SESSION['updateCounter'] = 1;
	}
}
elseif(isset($_POST['btnticketSolved']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	if($_SESSION['vrrStatus']=="Repair Checking"||$_SESSION['vrrStatus']=="Repair Ongoing")
	{
		$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
		User_Account = 'Dispatcher',
		Status='VRR Closed' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
		$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
		(VRR_ID,
		Note_Type,
		Notes,
		User_Note,
		Change_User,
		Note_date,
		Note_Time) VALUES 
		('". $_SESSION['vrrNo'] ."',
		'Change Account',
		'". $_POST['userNotes'] ."',
		'By: ". $_SESSION['Fullname'] ."',	
		'Manager',
		'". $dateToday ."',
		'". $timeToday ."')");
		$statusData = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID = '". $_SESSION['vrrNo'] ."'");
		while($showData = mysqli_fetch_array($statusData))
		{
			$updatedV = mysqli_query($con,"UPDATE vehicle_database SET 
			Status='For Rent' WHERE Vehicle_Plate = '{$showData['Plate_No']}'");
			echo "<script>alert('Vehicle & VRR updates sent to manager and dispatcher');window.location.href='qualityControl.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
		}
		
	
	}
}
elseif(isset($_POST['userSave']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	if($_SESSION['vrrStatus']=="Pending")
	{
		$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
		User_Account = 'Secretary', Status = 'VRR Checking' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
		$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
		(VRR_ID,
		Note_Type,
		Notes,
		User_Note,
		Change_User,
		Note_date,
		Note_Time) VALUES 
		('". $_SESSION['vrrNo'] ."',
		'Change Account',
		'". $_POST['userNotes'] ."',
		'By: ". $_SESSION['Fullname'] ."',	
		'Secretary',
		'". $dateToday ."',
		'". $timeToday ."')");
	}
	elseif($_SESSION['vrrStatus']=="Repair Checking")
	{
		$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
		User_Account = 'Manager' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
		$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
		(VRR_ID,
		Note_Type,
		Notes,
		User_Note,
		Change_User,
		Note_date,
		Note_Time) VALUES 
		('". $_SESSION['vrrNo'] ."',
		'Change Account',
		'". $_POST['userNotes'] ."',
		'By: ". $_SESSION['Fullname'] ."',	
		'Manager',
		'". $dateToday ."',
		'". $timeToday ."')");
	}
	elseif($_SESSION['vrrStatus']=="Repair Ongoing")
	{
		$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
		User_Account = 'Manager' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
		$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
		(VRR_ID,
		Note_Type,
		Notes,
		User_Note,
		Change_User,
		Note_date,
		Note_Time) VALUES 
		('". $_SESSION['vrrNo'] ."',
		'Forward Account',
		'". $_POST['userNotes'] ."',
		'By: ". $_SESSION['Fullname'] ."',	
		'Manager',
		'". $dateToday ."',
		'". $timeToday ."')");
	}
	echo "<script>alert('Additional note has been added.');window.location.href='qualityControl.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
}
elseif(isset($_POST['noteSave']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
	(VRR_ID,
	Note_Type,
	Notes,
	User_Note,
	Note_date,
	Note_Time) VALUES 
	('". $_SESSION['vrrNo'] ."',
	'". $_POST['noteType'] ."',
	'". $_POST['noteDetails'] ."',
	'By: ". $_SESSION['Fullname'] ."',
	'". $dateToday ."',
	'". $timeToday ."')");
	echo "<script>alert('Additional note has been added.');window.location.href='qualityControl.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quality Control Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	<?php
	include "styles.css";
	?>
</style>
<body bgcolor="#d3d3d3" onload="PMS(), <?php if(isset($_GET['action'])) echo "modal()"; ?>">
	<form action="#" method="POST">
		<div class="topnav">
			<div class="dropdown">
				<button class="dropbtn">View Database</button>
				<div class="dropdown-content">
					<a href="qualityControl.php?vehicle=1">Cars</a>
					<a href="qualityControl.php?vrr=1">VRR</a>
				</div>
			</div>
			<button class="dropbtn" name="viewAccount">Account</button>
			<button class="dropbtn" name="viewHome">Home</button>
			<img src="qc2.jpg" style="float: right; width: 4%; height: 4%; border-radius: 50%;" class="dropbtn1">
			<button class="dropbtn" name="logout" style="float: right;">Log-out</button>
		</div>
	</form>
	<center>
		<div style="padding-top: 50px;">
			<?php
			$cartotal = 0;
			include 'data.php';
			$reservedquery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='Reserved'");
			$reservedtotal=mysqli_num_rows($reservedquery);
			$reservequery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='For Rent'");
			$reservetotal=mysqli_num_rows($reservequery);
			$repairquery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='For Repair'");
			$repairtotal=mysqli_num_rows($repairquery);
			$vehiclequery=mysqli_query($con,"SELECT * FROM vehicle_database");
			$vehicletotal=mysqli_num_rows($vehiclequery);
			$vrrpending=mysqli_query($con,"SELECT * FROM vrr_database WHERE User_Account = 'Quality Controller'");
			$vrrtotal = mysqli_num_rows($vrrpending);
			$vrrpending=mysqli_query($con,"SELECT * FROM vrr_database WHERE Status = 'Repair Checking'");
			$vrrChecking = mysqli_num_rows($vrrpending);
			if(isset($_POST['viewAccount']) or isset($_POST['editAccount']) or $_SESSION['updateCounter'] == 1)
			{
				include "accountDetails.php";
			}
			elseif(!isset($_GET['vehicle']) and !isset($_GET['vrr']) and !isset($_GET['users']) and !isset($_GET['view']) and !isset($_GET['vview']) and !isset($_GET['aview']) and !isset($_GET['vrrDetails']) and !isset($_GET['action']))
			{
				echo '
				<table width="60%" border="0" style="border-collapse: collapse;" cellpadding="5">
					<tr>
						<td bgcolor="white" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; border-right: 2px solid black;">
							<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
								<tr>
									<td bgcolor="white"><b>Total Number of Cars for Reservation:</b> <a href="qualityControl.php?vehicle=reserve">'.$reservetotal.'</a></td>
								</tr>
								<tr>
									<td bgcolor="white"><b>Total Number of Cars Reserved:</b> <a href="qualityControl.php?vehicle=reserved">'.$reservedtotal.'</a></td>
								</tr>
								<tr>
									<td bgcolor="white"><b>Total Number of Cars Under Repair:</b> <a href="qualityControl.php?vehicle=repair">'.$repairtotal.'</a></td>
								</tr>
							</table>
						</td>
						<td bgcolor="white" style="border-right: 2px solid black;">
							<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
								<tr>
									<td bgcolor="white"><b>Total Number of Owned Cars:</b> <a href="qualityControl.php?vehicle=owned">'.$vehicletotal.'</a></td>
								</tr>
								<tr>
									<td bgcolor="white"><b>Pending Tickets:</b> <a href="qualityControl.php?vrr=pending">'.$vrrtotal.'</a></td>
								</tr>
								<tr>
									<td bgcolor="white"><b>VRR Fixed (to be check):</b> <a href="qualityControl.php?vrr=RepairChecking">'.$vrrChecking.'</a></td>
								</tr>
							</table>
						</td>
						<td bgcolor="yellow" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
							<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
								<tr>
									<td bgcolor="yellow"><b>Account Type:</b> <br>'.$_SESSION['Accounttype'].'</td>
								</tr>
								<tr>
									<td bgcolor="yellow"><b>Full Name:</b> <br>'.$_SESSION['Fullname'].'</td>
								</tr>
								<tr>
									<td bgcolor="yellow"><b>Contact Number:</b> <br>'.$_SESSION['Contact'].'</td>
								</tr>
								<tr>
									<td bgcolor="yellow"><b>E-mail:</b> <br>'.$_SESSION['Email'].'</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>';
			}
			elseif(isset($_GET['vehicle']))
			{	
				include "carsDatabase.php";
			}
			elseif(isset($_GET['vview']))
			{
				include "editVehicle.php";
			}
			elseif(isset($_GET['vrr']))
			{
				include "vrrDatabase.php";
			}
			elseif(isset($_GET['vrrDetails']) or isset($_GET['action']))
			{
				include "vrrDetails.php";
			}
			?>
		</div>
	</center>
	<script>
		<?php
		include "scripts.js";
		?>
	</script>	
</body>
</html>