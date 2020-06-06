<?php
session_start();

if(isset($_SESSION['security']))
{
	if($_SESSION['security']!=1)
	{
		echo "<script>window.location.href='index.php';</script>";	
	} 
}
elseif(!isset($_SESSION['security'])) echo "<script>window.location.href='index.php';</script>";
if(isset($_POST['noteSave']))
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
	echo "<script>alert('Additional note has been added.');window.location.href='dispatcher.php?vrrDetails={$_SESSION['vrrNo']}';</script>";
}
elseif(isset($_POST['backV']))
{
	echo "<script>window.location.href='dispatcher.php?vehicle=1';</script>";
}
elseif(isset($_POST['backD']))
{
	echo "<script>window.location.href='dispatcher.php?vrr=1';</script>";
}
elseif(isset($_POST['newVRR']))
{
	$dateToday = date("Y-m-d");
	$timeToday = date("h:i:sa");
	include "data.php";
	$newVRRrecord = mysqli_query($con,"INSERT INTO vrr_database 
	(VRR_Date,
	Plate_No,
	Car_Brand,
	Car_Type,
	ODO,
	User_Account,
	Status) VALUES 
	('". $_SESSION['dateToday'] ."',
	'". $_POST['newPlate'] ."',
	'". $_POST['newBrand'] ."',
	'". $_POST['newModel'] ."',
	'". $_POST['newODO'] ."',
	'Quality Controller',
	'Pending')");
	$updateCar = mysqli_query($con,"UPDATE vehicle_database SET Status = 'For Repair' WHERE Vehicle_Plate = '". $_POST['newPlate'] ."'");
	$searchvrr = mysqli_query($con,"SELECT * FROM vrr_database");
	{
		while($vrrnote = mysqli_fetch_array($searchvrr))
		{
			$noteVrr = $vrrnote['VRR_ID'];
		}
	}
	$newVRRnote = mysqli_query($con,"INSERT INTO vrrnotes_database
	(VRR_ID,
	Note_Type,
	User_Note,
	Note_date,
	Note_Time) VALUES 
	('". $noteVrr ."',
	'Ticket Created',
	'By: ". $_SESSION['Fullname'] ."',
	'". $dateToday ."',
	'". $timeToday ."')");
	echo "
	<script>
		alert('New VRR ticket successfully created. Kindly inform Quality Control for new ticket.');
		window.location.href='dispatcher.php?vrr=1';
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
elseif(isset($_POST['saveVehicle']))
{
	$dateToday = date("Y-m-d");
	$dateEnd = date_create(date("Y-m-d"));
	$timeToday = date("h:i:sa");
	date_add($dateEnd,date_interval_create_from_date_string("3 months"));
	$dateEnd = date_format($dateEnd,"Y-m-d");
	include "data.php";
	$updateVehicle = mysqli_query($con,"SELECT * FROM vehicle_database WHERE Vehicle_Plate = '". $_POST['updatePlate'] ."'");
	$ticketPending = mysqli_query($con,"SELECT * FROM vrr_database WHERE Plate_No = '". $_POST['updatePlate'] ."' AND Status != 'Ticket Resolved'");
	$nPending = mysqli_num_rows($ticketPending);
	$nUpdate = mysqli_num_rows($updateVehicle);
	if($nUpdate>0)
	{
		if($nPending==1)
		{
			echo "<script>alert('There are still pending {$nPending} VRR ticket/s for the car. Please resolve the remaining tickets first before changing the status.');</script>";
		}
		elseif($_SESSION['updateP']==$_POST['updatePlate'])
		{
			$updatedV = mysqli_query($con,"UPDATE vehicle_database SET 
			Status = '". $_POST['updateStatus'] ."', PMS_Start = '". $dateToday ."', PMS_End = '". $dateEnd ."' WHERE Vehicle_ID = '". $_GET['vview'] ."'");
			echo "<script>alert('Car record successfully updated.');window.location.href='dispatcher.php?vehicle=1';</script>";
		}
		else echo "<script>alert('Plate number already taken.');</script>";
	}
	else
	{
		$updatedV = mysqli_query($con,"UPDATE vehicle_database SET 
		Status = '". $_POST['updateStatus'] ."', PMS_Start = '". $dateToday ."', PMS_End = '". $dateEnd ."' WHERE Vehicle_ID = '". $_GET['vview'] ."'");
		echo "<script>alert('Car record successfully updated.');window.location.href='dispatcher.php?vehicle=1';</script>";
	}
}
elseif(isset($_POST['logout']))
{
	$_SESSION['security']=0;
	session_destroy();
	echo "<script>alert('Account successfully logged-out!');window.location.href='index.php';</script>";
}
elseif(isset($_POST['viewHome']))
{
	$_SESSION['updateCounter'] = 0;
	echo "<script>window.location.href='dispatcher.php';</script>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Dispatcher Account</title>
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
<body bgcolor="#d3d3d3" onload="PMS(), <?php if(isset($_GET['action'])) echo "modal()"; if(isset($_POST['newPlate'])) echo "plateno()";  if(isset($_GET['notePage']) or isset($_GET['noteEnd'])) echo "note()";?>">
	<form action="#" method="POST">
		<div class="topnav">
			<div class="dropdown">
				<button class="dropbtn">View Database</button>
				<div class="dropdown-content">
					<a href="dispatcher.php?vehicle=1">Cars</a>
					<a href="dispatcher.php?vrr=1">VRR</a>
				</div>
			</div>
			<button class="dropbtn" name="viewAccount">Account</button>
			<input type="button" value="Add Vrr" class="dropbtn" onclick="$('#modal_Add_Vrr').css('display','block')">
			<button class="dropbtn" name="viewHome">Home</button>
			<img src="dispatcher.jpg" style="float: right; width: 4%; height: 4%; border-radius: 50%;" class="dropbtn1">
			<button class="dropbtn" name="logout" style="float: right;">Log-out</button>
		</div>
	</form>
	<center>
		<div style="padding-top: 50px;">
			<?php
				echo date("Y-m-d H:i:s", strtotime('+5 hours'));
			$cartotal = 0;
			include 'data.php';
			if(isset($_SESSION['notifVRRDone']) && !empty($_SESSION['notifVRRDone'])) {
				$Latest=mysqli_query($con,"select * from vrr_database vrd join vrrnotes_database vd on vd.VRR_ID=vrd.VRR_ID where Status='VRR Closed'order by Note_ID DESC Limit 1");
				// echo $Latest;
				while($late = mysqli_fetch_array($Latest))
				{	
					if($late['notif']!=2&&$late['notif']!=3){
						if($_SESSION['notifVRRDoneID']==$late['VRR_ID']&&$_SESSION['notifVRRDoneNote']==$late['Note_ID']){

						}else{
							
							$string = "VRR #{$late['VRR_ID']} \\nNotes: {$late['Notes']}  \\n{$late['User_Note']}";
							echo "<script>alert(\"$string\")</script>";
							$_SESSION['notifVRRDone']=1;
							$_SESSION['notifVRRDoneID']=$late['VRR_ID'];
							$_SESSION['notifVRRDoneNote']=$late['Note_ID'];
							$updateNotif=2;
							if($late['notif']==1){
								$updateNotif=3;
							}
							$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
							notif = {$updateNotif} WHERE VRR_ID='". $late['VRR_ID'] ."'");
						}
					}
				}
			}else{
				$Latest=mysqli_query($con,"select * from vrr_database vrd join vrrnotes_database vd on vd.VRR_ID=vrd.VRR_ID where Status='VRR Closed' order by Note_ID DESC Limit 1");
				// echo $Latest;
				while($late = mysqli_fetch_array($Latest))
				{	
					if($late['notif']!=2&&$late['notif']!=3){
						$string = "VRR #{$late['VRR_ID']} \\nNotes: {$late['Notes']}  \\n{$late['User_Note']}";
						echo "<script>alert(\"$string\")</script>";
						$_SESSION['notifVRRDone']=1;
						$_SESSION['notifVRRDoneID']=$late['VRR_ID'];
						$_SESSION['notifVRRDoneNote']=$late['Note_ID'];
						$updateNotif=2;
						if($late['notif']==1){
							$updateNotif=3;
						}
						$userUpdate = mysqli_query($con,"UPDATE vrr_database SET 
						notif = {$updateNotif} WHERE VRR_ID='". $late['VRR_ID'] ."'");
						
					}
				}
			}
			$reservedquery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='Reserved'");
			$reservedtotal=mysqli_num_rows($reservedquery);
			$reservequery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='For Rent'");
			$reservetotal=mysqli_num_rows($reservequery);
			$repairquery=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status='For Repair'");
			$repairtotal=mysqli_num_rows($repairquery);
			$vehiclequery=mysqli_query($con,"SELECT * FROM vehicle_database");
			$vehicletotal=mysqli_num_rows($vehiclequery);
			$vrrpending=mysqli_query($con,"SELECT * FROM vrr_database WHERE Status = 'Ticket Resolved'");
			while($countCar = mysqli_fetch_array($vrrpending))
			{
				$carpending = mysqli_query($con,"SELECT * FROM vehicle_database where Vehicle_Plate = '". $countCar['Plate_No'] ."' AND Status = 'For Repair'");
				while($pendingcar = mysqli_fetch_array($carpending))
				{
					$cartotal = $cartotal + 1;
				}

			}
			if(isset($_POST['viewAccount']) or isset($_POST['editAccount']) or $_SESSION['updateCounter'] == 1)
			{
				include "accountDetails.php";
			}
			elseif(!isset($_GET['vehicle']) and !isset($_GET['vrr']) and !isset($_GET['users']) and !isset($_GET['view']) and !isset($_GET['vview']) and !isset($_GET['aview']) and !isset($_GET['vrrDetails']) and !isset($_GET['action']) and !isset($_GET['notePage']) and !isset($_GET['noteEnd']))
			{
				echo '
				<table width="60%" border="0" style="border-collapse: collapse;" cellpadding="5">
					<tr>
						<td bgcolor="white" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; border-right: 2px solid black;">
							<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
								<tr>
									<td bgcolor="white"><b>Total Number of Cars for Reservation:</b> <a href="dispatcher.php?vehicle=reserve">'.$reservetotal.'</a></td>
								</tr>
								<tr>
									<td bgcolor="white"><b>Total Number of Cars Reserved:</b> <a href="dispatcher.php?vehicle=reserved">'.$reservedtotal.'</a></td>
								</tr>
								<tr>
									<td bgcolor="white"><b>Total Number of Cars Under Repair:</b> <a href="dispatcher.php?vehicle=repair">'.$repairtotal.'</a></td>
								</tr>
							</table>
						</td>
						<td bgcolor="white" style="border-right: 2px solid black;">
							<table style="border-collapse: collapse;" cellpadding="10" cellspacing="10">
								<tr>
									<td bgcolor="white"><b>Total Number of Owned Cars:</b> <a href="dispatcher.php?vehicle=owned">'.$vehicletotal.'</a></td>
								</tr>
								<tr>
									<td bgcolor="white"><b>Pending Cars for Assigning:</b> <a href="dispatcher.php?vrr=pending">'.$cartotal.'</a></td>
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
			elseif(isset($_GET['vrrDetails']) or isset($_GET['action']) or isset($_GET['notePage']) or isset($_GET['noteEnd']))
			{
				include "vrrDetails.php";
			}
			?>
		</div>
	</center>
	<div id="modal_Add_Vrr" class="modal">
		<div class="modal-user">
			<button class="add_Vrr_close">&times;</button>
			<h3 style="color: #b22222;"><b>Create New Ticket</b></h3>
			<form action='#' method='POST'>
				<center>
				<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 20px; border-collapse: collapse; border: 2px solid black;'>
					<?php
					$_SESSION['dateToday'] = date("Y-m-d");
					echo "
					<tr>
						<td bgcolor='white' align='right' colspan='2'><b>Date: {$_SESSION['dateToday']}</b></td>
					</tr>";
					if($_SESSION['Accounttype']!="Dispatcher")
					{
						echo "
						<tr>
							<td bgcolor='white' colspan='2'>VRR Type: 
								<select name='newType'>
									<option>Major</option>
									<option>Minor</option>
								</select>
							</td>
						</tr>";
					}
					?>
					<tr>
						<td bgcolor="white"><b>Plate No:</b>
							<br>
							<?php
							echo "
							<select style='width:70%;' id='addVrrPlate' name='newPlate'>
								<option>-select-</option>";
								$plate = mysqli_query($con,"SELECT * FROM vehicle_database");
								while($showPlate = mysqli_fetch_array($plate))
								{
									// $_SESSION['vBrand'] = $showPlate['Vehicle_Brand'];
									// $_SESSION['vModel'] = $showPlate['Vehicle_Model'];
									echo "<option data-brand='{$showPlate['Vehicle_Brand']}' data-model='{$showPlate['Vehicle_Model']}'";
									if(isset($_POST['newPlate']))
									{
										if($_POST['newPlate']==$showPlate['Vehicle_Plate']) echo "selected";
									}
									echo "
									>{$showPlate['Vehicle_Plate']}</option>";
								}
							echo "
							</select>";
							?>
						</td>
						<td bgcolor="white"><b>ODO:</b>
							<br>
							<input type="text" name="newODO" size='25%' required>
						</td>
					</tr>
					<tr>
						<td bgcolor="white" width="50%"><b>Car Brand:</b>
							<br>
							<input type="text" name="newBrand" id="addVrrBrand" size='25%'  readonly>
						</td>
						<td bgcolor="white" width="50%"><b>Car Model:</b>
							<br>
							<input type="text" name="newModel" id="addVrrModel" size='25%' readonly>
						</td>
					</tr>
					<?php
					if($_SESSION['Accounttype']!="Dispatcher")
					{
						echo "
						<tr>
							<td bgcolor='white' colspan='2'><b>Description:</b>
								<br>
								<textarea name='newConcern'></textarea>
							</td>
						</tr>";
					}
					?>
					<tr>
						<td bgcolor="white" colspan="2">
							<input type="submit" class="button button5" name="newVRR" value="Create">
						</td>
					</tr>
				</table>
				<center>
			</form>
		</div>
	</div>
	<script>
		<?php
		include "scripts.js";
		?>
	</script>
</body>
</html>