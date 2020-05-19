<?php
session_start();
if(isset($_POST['viewLog'])) echo "<script>window.location.href='affiliate.php?page=1';</script>";
elseif(isset($_POST['saveAffiliate']))
{
	include "data.php";
	$findArecord = mysqli_query($con,"SELECT * FROM affiliates_database WHERE Affiliates_Name = '". $_POST['addAname'] ."' and Branch = '". $_POST['addAbranch'] ."'");
	$nAfind = mysqli_num_rows($findArecord);
	if($nAfind>0) echo "<script>alert('Record not saved. Account already exist in database.');</script>";
	else
	{
		$addArecord = mysqli_query($con,"INSERT INTO affiliates_database (Affiliates_Name,Branch) VALUES ('". $_POST['addAname'] ."','". $_POST['addAbranch'] ."')");
		echo "<script>alert('Account successfully saved.');window.location.href='affiliate.php?affil=1';</script>";
	}
}
elseif(isset($_POST['updateAffil']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	$affilUpdate = mysqli_query($con,"UPDATE vrr_database SET 
	Affiliates = '". $_POST['affilList'] ."',
	Branch = '". $_POST['branchList'] ."',
	Status = 'Affiliate Repair' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
	$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
	(VRR_ID,
	Note_Type,
	Notes,
	User_Note,
	Assigned_Affil,
	Note_date,
	Note_Time) VALUES 
	('". $_SESSION['vrrNo'] ."',
	'Update Affiliate',
	'". $_POST['noteVrr'] ."',
	'By: ". $_SESSION['Fullname'] ."',
	'". $_POST['affilList'] ."(". $_POST['branchList'] .")',
	'". $dateToday ."',
	'". $timeToday ."')");
	echo "<script>alert('Ticket assigned to affiliate.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
}
elseif(isset($_POST['updateQC']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	$affilUpdate = mysqli_query($con,"UPDATE vrr_database SET 
	Status = 'Repair Ongoing',
	User_Account = 'Quality Controller' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
	$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
	(VRR_ID,
	Note_Type,
	Notes,
	User_Note,
	Note_date,
	Note_Time) VALUES 
	('". $_SESSION['vrrNo'] ."',
	'Update QC',
	'". $_POST['noteVrr'] ."',
	'By: ". $_SESSION['Fullname'] ."',
	'". $dateToday ."',
	'". $timeToday ."')");
	echo "<script>alert('Ticket assigned to QC Department.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
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
	echo "<script>alert('Additional note has been added.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
}
elseif(isset($_POST['userSave']))
{
	if($_SESSION['Accounttype']=="Manager")
	{
		$dateToday = date("Y-m-d");
		$timeToday = date("h:i:sa");
		include "data.php";
		$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
		User_Account = 'Quality Controller', Status = 'VRR Checking' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
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
		'Quality Controller',
		'". $dateToday ."',
		'". $timeToday ."')");
		echo "<script>alert('Additional note has been added.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
	}
	elseif($_SESSION['Accounttype']=="Secretary")
	{
		$dateToday = date("Y-m-d");
		$timeToday = date("h:i:sa");
		include "data.php";
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
		echo "<script>alert('Additional note has been added.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
	}
}
elseif(isset($_POST['submit_addQuotation'])){
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	$newNote = mysqli_query($con,"INSERT INTO quotation_database VALUES 
	(NULL,
	(SELECT Affiliates_ID FROM affiliates_database where affiliate_user = ".$_SESSION['UserID']."),
	'". $_POST['addQuotPlate'] ."',
	'". $_POST['addQuotDesc'] ."',
	'". $_POST['addQuotAmount']  ."',	
	'0',
	'Pending',
	now())");
	// echo "<script>alert('Quotation Added.');window.location.href='affiliate.php';</script>";
}
elseif(isset($_POST['returnSave']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	if($_SESSION['vrrStatus']=="Repair Ongoing")
	{
		$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
		User_Account = 'Quality Controller' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
	}
	elseif($_SESSION['vrrStatus']=="VRR Checking")
	{
		$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
		User_Account = 'Quality Controller', Status = 'Pending' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
	}
	$newNote = mysqli_query($con,"INSERT INTO vrrnotes_database
	(VRR_ID,
	Note_Type,
	Notes,
	User_Note,
	Change_User,
	Note_date,
	Note_Time) VALUES 
	('". $_SESSION['vrrNo'] ."',
	'Return Account',
	'". $_POST['userNotes'] ."',
	'By: ". $_SESSION['Fullname'] ."',	
	'Quality Controller',
	'". $dateToday ."',
	'". $timeToday ."')");
	echo "<script>alert('Ticket returned to Quality Control.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
}
elseif(isset($_POST['statusSave']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	if(isset($_POST['statusChoice']))
	{
		if($_POST['statusChoice']=="Void Ticket")
		{
			include "data.php";
			$voidUpdate = mysqli_query($con,"UPDATE vrr_database SET 
			Status = 'Ticket Voided' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
			$voidNote = mysqli_query($con,"INSERT INTO vrrnotes_database
			(VRR_ID,
			Note_Type,
			Notes,
			User_Note,
			Note_date,
			Note_Time) VALUES 
			('". $_SESSION['vrrNo'] ."',
			'Ticket Cancelled',
			'". $_POST['statusNotes'] ."',
			'By: ". $_SESSION['Fullname'] ."',
			'". $dateToday ."',
			'". $timeToday ."')");
			echo "<script>alert('Ticket has been cancelled.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
		}
		elseif($_POST['statusChoice']=="Repair Checking")
		{
			include "data.php";
			$voidUpdate = mysqli_query($con,"UPDATE vrr_database SET 
			Status = 'Repair Checking',
			User_Account = 'Quality Controller' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
			$statusNote = mysqli_query($con,"INSERT INTO vrrnotes_database
			(VRR_ID,
			Note_Type,
			Notes,
			User_Note,
			Change_User,
			Note_date,
			Note_Time) VALUES 
			('". $_SESSION['vrrNo'] ."',
			'Repair Checking',
			'". $_POST['statusNotes'] ."',
			'By: ". $_SESSION['Fullname'] ."',
			'Quality Controller',
			'". $dateToday ."',
			'". $timeToday ."')");
			echo "<script>alert('Ticket forwarded to Quality Control.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
		}
		elseif($_POST['statusChoice']=="For Rent")
		{
			include "data.php";
			$voidUpdate = mysqli_query($con,"UPDATE vrr_database SET 
			User_Account='Dispatcher', Status = 'Ticket Resolved' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
			$statusNote = mysqli_query($con,"INSERT INTO vrrnotes_database
			(VRR_ID,
			Note_Type,
			Notes,
			User_Note,
			Note_date,
			Note_Time) VALUES 
			('". $_SESSION['vrrNo'] ."',
			'Ticket Resolved',
			'". $_POST['statusNotes'] ."',
			'By: ". $_SESSION['Fullname'] ."',
			'". $dateToday ."',
			'". $timeToday ."')");
			echo "<script>alert('Ticket forwarded to dispatching department.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
		}
	}
}
if(isset($_POST['openSave']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	$voidUpdate = mysqli_query($con,"UPDATE vrr_database SET 
	Status = 'Ticket Reopened' WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
	$statusNote = mysqli_query($con,"INSERT INTO vrrnotes_database
	(VRR_ID,
	Note_Type,
	Notes,
	User_Note,
	Note_date,
	Note_Time) VALUES 
	('". $_SESSION['vrrNo'] ."',
	'Ticket Reopen',
	'". $_POST['openNotes'] ."',
	'By: ". $_SESSION['Fullname'] ."',
	'". $dateToday ."',
	'". $timeToday ."')");
	echo "<script>alert('Ticket has been opened.');window.location.href='affiliate.php?vrrDetails={$_SESSION['vrrNo']}';</script>";

}
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
	echo "<script>window.location.href='affiliate.php?vehicle=1';</script>";
}
elseif(isset($_POST['backU']))
{
	echo "<script>window.location.href='affiliate.php?users=1';</script>";
}
elseif(isset($_POST['backA']))
{
	echo "<script>window.location.href='affiliate.php?affil=1';</script>";
}
elseif(isset($_POST['backD']))
{
	echo "<script>window.location.href='affiliate.php?vrr=1';</script>";
}
elseif(isset($_POST['newVehicle']))
{
	$dateToday = date("Y-m-d");
	$dateEnd = date_create(date("Y-m-d"));
	$timeToday = date("h:i:sa");
	date_add($dateEnd,date_interval_create_from_date_string("3 months"));
	$dateEnd = date_format($dateEnd,"Y-m-d");
	include "data.php";
	$Q=mysqli_query($con,"SELECT * FROM vehicle_database where Vehicle_Plate='". $_POST['savePlate'] ."'");
	$N=mysqli_num_rows($Q);
	if($N>0)
	{
		echo "<script>alert('Plate Number is already taken!');window.location.href='affiliate.php?vehicle=1';</script>";
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
		'". $dateToday ."',
		'". $dateEnd ."')");
		echo "<script>alert('New car has been added to the database!');window.location.href='affiliate.php?vehicle=1';</script>";
	}
}
elseif(isset($_POST['saveAccount']))
{
	include "data.php";
	$Q=mysqli_query($con,"SELECT * FROM users_database WHERE Username = '". $_POST['saveUsername'] ."'");
	$N=mysqli_num_rows($Q);
	if($N>0)
	{
		echo "<script>alert('Username is already taken. Please choose another.');</script>";
	}
	else
	{
		$Q=mysqli_query($con,"INSERT INTO users_database 
			(Username,
			Password,
			First_Name,
			Middle_Name,
			Last_Name,
			Contact_No,
			Birthday,
			Account_Type,
			Email,
			Address) VALUES 
			('". $_POST['saveUsername'] ."',
			'". $_POST['savePassword'] ."',
			'". $_POST['saveFirst'] ."',
			'". $_POST['saveMiddle'] ."',
			'". $_POST['saveLast'] ."',
			'". $_POST['saveContact'] ."',
			'". $_POST['saveBirth'] ."',
			'". $_POST['saveType'] ."',
			'". $_POST['saveEmail'] ."',
			'". $_POST['saveAddress'] ."')");
		echo "<script>alert('New account has been added.');window.location.href='affiliate.php?users=1';</script>";
	}
}
elseif(isset($_POST['saveU']))
{
	include "data.php";
	$newAccount = mysqli_query($con,"SELECT * FROM users_database WHERE Username = '". $_POST['saveUsername'] ."'");
	$nNew = mysqli_num_rows($newAccount);
	if($nNew>0)
	{
		if($_SESSION['updateU']==$_POST['saveUsername'])
		{
			$addNew = mysqli_query($con,"UPDATE users_database SET 
			Username='". $_POST['saveUsername'] ."',
			Password='". $_POST['savePassword'] ."',
			First_Name='". $_POST['saveFirst'] ."',
			Middle_Name='". $_POST['saveMiddle'] ."',
			Last_Name='". $_POST['saveLast'] ."',
			Contact_No='". $_POST['saveContact'] ."',
			Birthday='". $_POST['saveBirth'] ."',
			Account_Type='". $_POST['saveType'] ."',
			Email='". $_POST['saveEmail'] ."',
			Address='". $_POST['saveAddress'] ."' WHERE User_ID = '". $_GET['view'] ."'");
			echo "<script>alert('User account updated successfully.');window.location.href='affiliate.php?users=1';</script>";
		}
		else echo "<script>alert('Username already taken. Please choose another one.');</script>";
	}
	else
	{
		$addNew = mysqli_query($con,"UPDATE users_database SET 
		Username='". $_POST['saveUsername'] ."',
		Password='". $_POST['savePassword'] ."',
		First_Name='". $_POST['saveFirst'] ."',
		Middle_Name='". $_POST['saveMiddle'] ."',
		Last_Name='". $_POST['saveLast'] ."',
		Contact_No='". $_POST['saveContact'] ."',
		Birthday='". $_POST['saveBirth'] ."',
		Account_Type='". $_POST['saveType'] ."',
		Email='". $_POST['saveEmail'] ."',
		Address='". $_POST['saveAddress'] ."' WHERE User_ID = '". $_GET['view'] ."'");
		echo "<script>alert('User account updated successfully.');window.location.href='affiliate.php?users=1';</script>";
	}
}
if(isset($_POST['updateAccount']))
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
elseif(isset($_POST['saveAffil']))
{
	include "data.php";
	$updateAffil = mysqli_query($con,"SELECT * FROM affiliates_database WHERE Affiliates_Name = '". $_POST['updateAname'] ."' AND Branch = '". $_POST['updateAbranch'] ."'");
	$nUpdate = mysqli_num_rows($updateAffil);
	if($nUpdate>0)
	{
		while($rAffilupdate = mysqli_fetch_array($updateAffil))
		{
			if($_POST['updateAname']==$rAffilupdate['Affiliates_Name'] and $_POST['updateAbranch']==$rAffilupdate['Branch'])
				echo "<script>alert('No changes in data has been made.');</script>";
			else echo "<script>alert('Affiliate name and branch already exist in the record.');</script>";
		}
	}
	else
	{
		$updatedA = mysqli_query($con,"UPDATE affiliates_database SET
		Affiliates_Name = '". $_POST['updateAname'] ."',
		Branch = '". $_POST['updateAbranch'] ."' WHERE Affiliates_ID = '". $_GET['aview'] ."'");
		echo "<script>alert('Affiliate record successfully updated.'); window.location.href='affiliate.php?affil=1';</script>";
	}
}
elseif(isset($_POST['saveVehicle']))
{
	include "data.php";
	$updateVehicle = mysqli_query($con,"SELECT * FROM vehicle_database WHERE Vehicle_Plate = '". $_POST['updatePlate'] ."'");
	$nUpdate = mysqli_num_rows($updateVehicle);
	if($nUpdate>0)
	{
		if($_SESSION['updateP']==$_POST['updatePlate'])
		{
			$updatedV = mysqli_query($con,"UPDATE vehicle_database SET 
			Vehicle_Brand = '". $_POST['updateBrand'] ."',
			Vehicle_Model = '". $_POST['updateModel'] ."',
			Vehicle_Plate = '". $_POST['updatePlate'] ."',
			Status = '". $_POST['updateStatus'] ."',
			PMS_Start = '". $_POST['updatePMSStart'] ."',
			PMS_End = '". $_POST['updatePMSEnd'] ."' WHERE Vehicle_ID = '". $_GET['vview'] ."'");
			echo "<script>alert('Car record successfully updated.');window.location.href='affiliate.php?vehicle=1';</script>";
		}
		else echo "<script>alert('Plate number already taken.');</script>";
	}
	else
	{
		$updatedV = mysqli_query($con,"UPDATE vehicle_database SET 
		Vehicle_Brand = '". $_POST['updateBrand'] ."',
		Vehicle_Model = '". $_POST['updateModel'] ."',
		Vehicle_Plate = '". $_POST['updatePlate'] ."',
		Status = '". $_POST['updateStatus'] ."',
		PMS_Start = '". $_POST['updatePMSStart'] ."',
		PMS_End = '". $_POST['updatePMSEnd'] ."' WHERE Vehicle_ID = '". $_GET['vview'] ."'");
		echo "<script>alert('Car record successfully updated.');window.location.href='affiliate.php?vehicle=1';</script>";
	}
}
elseif(isset($_GET['deleteVRR']))
{
	include "data.php";
	$deleteVRR = mysqli_query($con,"DELETE FROM vrr_database WHERE VRR_ID = '". $_GET['deleteVRR'] ."'");
	echo "<script>alert('VRR record has been deleted.');window.location.href='affiliate.php?vrr=1';</script>";
}
elseif(isset($_GET['deleteVehicle']))
{
	include "data.php";
	$deleteVehicle = mysqli_query($con,"DELETE FROM vehicle_database WHERE Vehicle_ID = '". $_GET['deleteVehicle'] ."'");
	echo "<script>alert('Car record has been deleted.');window.location.href='affiliate.php?vehicle=1';</script>";
}
elseif(isset($_GET['deleteUser']))
{
	include "data.php";
	$deleteUser = mysqli_query($con,"DELETE FROM users_database WHERE User_ID = '". $_GET['deleteUser'] ."'");
	echo "<script>alert('User account has been deleted.');window.location.href='affiliate.php?users=1';</script>";
}
elseif(isset($_GET['deleteAffil']))
{
	include "data.php";
	$deleteAffil = mysqli_query($con,"DELETE FROM vrr_database WHERE VRR_ID = '". $_GET['deleteAffil'] ."'");
	echo "<script>alert('Affiliate record has been deleted.');window.location.href='affiliate.php?affil=1';</script>";
}
elseif(isset($_POST['logout']))
{
	$_SESSION['security']=0;
	echo "<script>alert('Account successfully logged-out!');window.location.href='index.php';</script>";
}
elseif(isset($_POST['viewHome']))
{
	$_SESSION['updateCounter'] = 0;
	echo "<script>window.location.href='affiliate.php';</script>";
}
elseif(isset($_GET['vehicle']) or isset($_GET['vrr']) or isset($_GET['users'])) $_SESSION['updateCounter'] = 0;
elseif(isset($_POST['viewAffiliates'])) $_SESSION['updateCounter'] = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	  
</head>
<style type="text/css">
	<?php
		include "styles.css";
	?>
</style>
<body bgcolor="#d3d3d3" onload="PMS(), <?php if(isset($_GET['action'])) echo "modal()"; if(isset($_GET['notePage']) or isset($_GET['noteEnd'])) echo "note()";?>">
	<form action="#" method="POST">
		<div class="topnav">
			<div class="dropdown">
				<button class="dropbtn">View Database</button>
				<div class="dropdown-content">
					<a href="affiliate.php?vehicle=1">Cars</a>
					<a href="affiliate.php?vrr=1">VRR</a>
					<a href="affiliate.php?users=1">Users</a>
				</div>
			</div>
			
			<!-- <button class="dropbtn" name="viewReports">Reports</button> -->
			<!-- <div class="dropdown">
				<button class="dropbtn">Reports</button>
				<div class="dropdown-content">
					<a href="">VRR Report</a>
					<a href="">Car Report</a>
					<a href="">User Report</a>
				</div>
			</div> -->
			<button class="dropbtn" name="viewAccount">Account</button>
			<button class="dropbtn" name="viewQuotation">Quotation</button>
			<?php
			if($_SESSION['Accounttype']=="Manager") echo "<button class='dropbtn' name='viewLog'>Logs</button>";
			?>
			<button class="dropbtn" name="viewHome">Home</button>
			<img src="
			<?php 
			if($_SESSION['Accounttype']=='Manager') echo 'manager.jpg';
			elseif($_SESSION['Accounttype']=='Secretary') echo 'Secretary.jpg'; 
			?>" 
			style="float: right; width: 4%; height: 4%; border-radius: 50%;" class="dropbtn1">
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
			$affilquery=mysqli_query($con,'SELECT * FROM affiliates_database');
			$affiltotal=mysqli_num_rows($affilquery);
			$vrrquery=mysqli_query($con,'SELECT * FROM vrr_database where Status="Pending" and Affiliates=(SELECT Affiliates_Name from affiliates_database where affiliate_user='.$_SESSION['UserID'].') and Branch=(SELECT Branch from affiliates_database where affiliate_user='.$_SESSION['UserID'].') ');
			$vrrtotal=mysqli_num_rows($vrrquery);

			$vrrquery=mysqli_query($con,'SELECT * FROM quotation_database qd join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID where affiliate_user='.$_SESSION['UserID'].'');
			$quotAll=mysqli_num_rows($vrrquery);
			$vrrquery=mysqli_query($con,'SELECT * FROM quotation_database qd join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID where quot_status="pending" and affiliate_user='.$_SESSION['UserID'].'');
			$quotPending=mysqli_num_rows($vrrquery);
			if($_SESSION['Accounttype']=="Manager")
			{
				$vrrpending=mysqli_query($con,"SELECT * FROM vrr_database WHERE User_Account = 'Manager'");
				$pendingtotal=mysqli_num_rows($vrrpending);
			}
			elseif($_SESSION['Accounttype']=="Secretary")
			{
				$vrrpending=mysqli_query($con,"SELECT * FROM vrr_database WHERE User_Account = 'Secretary'");
				$pendingtotal=mysqli_num_rows($vrrpending);
			}
			if(isset($_POST['viewAccount']) or isset($_POST['editAccount']) or $_SESSION['updateCounter'] == 1)
			{
				include "accountDetails.php";
			}
			elseif(isset($_POST['viewLog']) or isset($_GET['page']) or isset($_GET['end']))
			{
				include "logDetails.php";
			}
			elseif(isset($_POST['viewQuotation']) or isset($_GET['viewQuotation']))
			{
				include "quotation.php";
			}
			elseif(isset($_POST['viewReports']) or isset($_GET['affil']))
			{
				include "reports.php";
			}
			elseif(!isset($_GET['vehicle']) and !isset($_GET['vrr']) and !isset($_GET['users']) and !isset($_GET['view']) and !isset($_GET['vview']) and !isset($_GET['aview']) and !isset($_GET['vrrDetails']) and !isset($_GET['action']) and !isset($_GET['page']) and !isset($_GET['notePage']) and !isset($_GET['noteEnd']))
			{
				echo '
				<table width="60%" border="0" style="border-collapse: collapse; background-color: #00008b; border-radius: 20px;" cellpadding="5">
					<tr>
						<td style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; border-right: 2px solid black;">
							<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
                                <tr>
                                    <td bgcolor="white"><b>Pending Quotation:</b> <a href="affiliate.php?viewQuotation=Pending">'.$quotPending.'</a></td>
                                </tr>
								<tr>
									<td bgcolor="white"><b>Total Number of Quotation:</b> <a href="affiliate.php?viewQuotation">'.$quotAll.'</a></td>
								</tr>
							</table>
						</td>
						<td bgcolor="white" style="border-right: 2px solid black;">
							<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
                                <tr>
                                    <td bgcolor="white"><b>Total Number of Pending Tickets:</b> <a href="affiliate.php?vrr=total">'.$vrrtotal.'</a></td>
                                </tr>
                                <tr>
                                    <td bgcolor="white"><b>Total Number of Cars Under Repair:</b> <a href="affiliate.php?vehicle=repair">'.$repairtotal.'</a></td>
                                </tr>
                                <tr>
                                    <td bgcolor="white"><b>Total Number of Cars Repaired:</b> <a href="affiliate.php?vehicle=reserved">'.$reservedtotal.'</a></td>
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
				</table>';
			}
			elseif(isset($_GET['vehicle']))
			{	
				include "carsDatabase.php";
			}
			elseif(isset($_GET['users']))
			{
				include "usersDatabase.php";
			}
			elseif(isset($_GET['vrr']))
			{
				include "vrrDatabase.php";
			}
			elseif(isset($_GET['view']))
			{
				include "editUser.php";
			}
			elseif(isset($_GET['vview']))
			{
				include "editVehicle.php";
			}
			elseif(isset($_GET['aview']))
			{
				include	"editAffil.php";
			}
			elseif(isset($_GET['vrrDetails']) or isset($_GET['action']) or isset($_GET['notePage']) or isset($_GET['noteEnd']))
			{
				include "vrrDetails.php";
			}
			?>
		</div>
	</center>
	<script>
		<?php include "scripts.js"; ?>
	</script>
</body>
</html>