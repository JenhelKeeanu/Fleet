<table style='width: 70%;' border='0'>
	<tr>
		<td width='27%' align='left' bgcolor='#d3d3d3'><b>Search By: </b>
			<select id='vrrsearch' name='vrrsearch' style='min-width: 150px;' onchange='searchvrr()'>
				<option>-Select-</option>
				<option value='vrrType' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrType") echo "selected"; ?>
				>VRR Type</option>
				<option value='vrrDate' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrDate") echo "selected"; ?>
				>VRR Date</option>
				<option value='vrrPlateno' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrPlateno") echo "selected"; ?>
				>Plate Number</option>
				<option value='vrrCarbrand' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrCarbrand") echo "selected"; ?>
				>Car Brand</option>
				<option value='vrrCarmodel' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrCarmodel") echo "selected"; ?>
				>Car Model</option>
				<option value='vrrAtype' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrAtype") echo "selected"; ?>
				>Account Type</option>
				<option value='vrrStatus' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrStatus") echo "selected"; ?>
				>Status</option>
				<option value='vrrAffiliates' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="vrrAffiliates") echo "selected"; ?>
				>Affiliates</option>
			</select>
			<input type='text' id='iduser' hidden>
		</td>
		<form action='#' method='POST'>
		<?php if($_GET['vrr']=="vrrType") echo "
		<td width='12%' bgcolor='#d3d3d3'>
			<select name='searchVtype' style='width: 75px;'>
				<option>Major</option>
				<option>Minor</option>
			</select>
		</td>
		<td bgcolor='#d3d3d3'>
			<input type='submit' name='vrrRecord' class='button button5' value='Search'>
		</td>";
		elseif($_GET['vrr']=="vrrDate") echo "
		<td width='20%' bgcolor='#d3d3d3'>
			<input type='date' name='searchVdate'>
		</td>
		<td bgcolor='#d3d3d3'>
			<input type='submit' name='vrrRecord' class='button button5' value='Search'>
		</td>";
		elseif($_GET['vrr']=="vrrPlateno") 
		{
			include "data.php";
			echo "
			<td width='15%' bgcolor='#d3d3d3'>
				<select name='searchVplate' style='width: 100px;'>";
				$plate=mysqli_query($con,"SELECT Vehicle_Plate FROM vehicle_database");
				while($rplate=mysqli_fetch_array($plate))
				{
					echo "<option>{$rplate['Vehicle_Plate']}</option>";
				}
				echo "
				</select>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='vrrRecord' class='button button5' value='Search'>
			</td>";
		}
		elseif($_GET['vrr']=="vrrCarbrand") 
		{
			include "data.php";
			echo "
			<td width='15%' bgcolor='#d3d3d3'>
				<select name='searchVbrand' style='width: 100px;'>";
				$brand = mysqli_query($con,"SELECT DISTINCT Vehicle_Brand FROM vehicle_database");
				while($rbrand=mysqli_fetch_array($brand))
				{
					echo "<option>{$rbrand['Vehicle_Brand']}</option>";
				}
				echo "
				</select>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='vrrRecord' class='button button5' value='Search'>
			</td>";
		}
		elseif($_GET['vrr']=="vrrCarmodel") 
		{
			echo "
			<td width='13%' bgcolor='#d3d3d3'>
				<select name='searchVcartype' style='width: 90px;'>";
				$cartype = mysqli_query($con,"SELECT DISTINCT Vehicle_Model FROM vehicle_database");
				while($rcartype = mysqli_fetch_array($cartype))
				{
					echo "<option>{$rcartype['Vehicle_Model']}</option>";
				}
				echo "
				</select>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='vrrRecord' class='button button5' value='Search'>
			</td>";
		}
		elseif($_GET['vrr']=="vrrAtype")
		{
			include "data.php";
			echo "
			<td width='17%' bgcolor='#d3d3d3'>
				<select name='searchVatype'>";
				$qc = mysqli_query($con,"SELECT DISTINCT Account_Type FROM users_database");
				while($ratype = mysqli_fetch_array($qc))
				{
					echo "<option>{$ratype['Account_Type']}</option>";
				}
				echo "
				</select>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='vrrRecord' class='button button5' value='Search'>
			</td>";
		}
		elseif($_GET['vrr']=="vrrStatus") echo "
			<td width='15%' bgcolor='#d3d3d3'>
				<select name='searchVstatus'>
					<option>Pending</Option>
					<option>VRR Checking</Option>
					<option>Repair Ongoing</Option>
					<option>Affiliates Repair</Option>
					<option>Repair Checking</Option>
					<option>For Rent</Option>
					<option>Ticked Voided</Option>
					<option>Ticket Reopened</Option>
				</select>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='vrrRecord' class='button button5' value='Search'>
			</td>";
		elseif($_GET['vrr']=="vrrAffiliates") 
		{
			include "data.php";
			echo "
			<td width='15%' bgcolor='#d3d3d3'>
				<select name='searchVaffiliates' style='width: 90px;'>";
				$affiliates = mysqli_query($con,"SELECT Affiliates_Name FROM affiliates_database");
				while($raffiliates = mysqli_fetch_array($affiliates))
				{
					echo "<option>{$raffiliates['Affiliates_Name']}</option>";
				}
				echo "
				</select>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='vrrRecord' class='button button5' value='Search'>
			</td>";
		}
		elseif($_GET['vrr']=="RepairChecking") 
		{
			echo "
			<td width='15%' bgcolor='#d3d3d3'>
				<select name='searchVstatus'>
					<option>Pending</Option>
					<option>VRR Checking</Option>
					<option>Repair Ongoing</Option>
					<option>Affiliates Repair</Option>
					<option selected>Repair Checking</Option>
					<option>Repair Done</Option>
					<option>For Rent</Option>
					<option>Ticked Voided</Option>
					<option>Ticket Reopened</Option>
				</select>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='vrrRecord' id='vrrRecord' class='button button5' value='Search'>
			</td>";
			echo "<script>$('#vrrsearch').val('vrrStatus');</script>";
		}
		?>
		</form>
		<?php
		if($_SESSION['Accounttype']!="Manager") echo "
		<td align='right' bgcolor='#d3d3d3'>
			<button class='button button5' id='btn_Add_Vrr'>Add VRR</button>
		</td>";
		?>
	</tr>
</table>
<?php
if(isset($_POST['vrrRecord']))
{
	if(isset($_POST['searchVtype']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='9' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'><h2><b>VRR Database</b><h2></td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where VRR_Type LIKE '". $_POST['searchVtype'] ."%'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
	elseif(isset($_POST['searchVdate']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'><h2><b>VRR Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where VRR_Date = '". $_POST['searchVdate'] ."'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager"  or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
	elseif(isset($_POST['searchVplate']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>VRR Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where Plate_No = '". $_POST['searchVplate'] ."'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
	elseif(isset($_POST['searchVbrand']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>VRR Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where Car_Brand = '". $_POST['searchVbrand'] ."'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
	elseif(isset($_POST['searchVcartype']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>VRR Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where Car_Type ='". $_POST['searchVcartype'] ."'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
	elseif(isset($_POST['searchVatype']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>VRR Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where User_Account ='". $_POST['searchVatype'] ."'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
	elseif(isset($_POST['searchVstatus']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>VRR Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where Status ='Ticket Resolved'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
	elseif(isset($_POST['searchVaffiliates']))
	{
		echo "
		<table width='70%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>VRR Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>VRR ID</b></td>
				<td align='center'><b>VRR Type</b></td>
				<td align='center'><b>VRR Date</b></td>
				<td align='center'><b>Plate Number</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Type</b></td>
				<td align='center'><b>QC Name</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>Affiliates</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vrr_database where Affiliates ='". $_POST['searchVaffiliates'] ."'");
		while($r=mysqli_fetch_array($q))
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo 
				">{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		echo "
		</table>";
	}
}
elseif($_GET['vrr']=="total")
{
	echo "
	<table width='70%' class='tableVehicle'>
		<tr>
			<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
				border-top-left-radius: 15px;
				border-top-right-radius: 15px;'>
				<h2><b>VRR Database</b><h2>
			</td>
		</tr>
		<tr style='background-color: #778899;'>
			<td align='center'><b>VRR ID</b></td>
			<td align='center'><b>VRR Type</b></td>
			<td align='center'><b>VRR Date</b></td>
			<td align='center'><b>Plate Number</b></td>
			<td align='center'><b>Car Brand</b></td>
			<td align='center'><b>Car Type</b></td>
			<td align='center'><b>QC Name</b></td>
			<td align='center'><b>Status</b></td>
			<td align='center'><b>Affiliates</b></td>
		</tr>";
	include "data.php";
	$q=mysqli_query($con,"SELECT * FROM vrr_database");
	while($r=mysqli_fetch_array($q))
	{
		$_SESSION['modalID'] = $r['VRR_ID'];
		echo "
		<tr>
			<td align='center'><a ";
			if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
			elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
			elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
			echo 
			">{$r['VRR_ID']}</a></td>
			<td align='center'>{$r['VRR_Type']}</td>
			<td align='center'>{$r['VRR_Date']}</td>
			<td align='center'>{$r['Plate_No']}</td>
			<td align='center'>{$r['Car_Brand']}</td>
			<td align='center'>{$r['Car_Type']}</td>
			<td align='center'>{$r['User_Account']}</td>
			<td align='center'>{$r['Status']}</td>
			<td align='center'>{$r['Affiliates']}</td>
		</tr>";
	}
	echo "
	</table>";
}
elseif($_GET['vrr']=="RepairChecking")
{
	
	echo "
	<table width='70%' class='tableVehicle'>
		<tr>
			<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
				border-top-left-radius: 15px;
				border-top-right-radius: 15px;'>
				<h2><b>VRR Database</b><h2>
			</td>
		</tr>
		<tr style='background-color: #778899;'>
			<td align='center'><b>VRR ID</b></td>
			<td align='center'><b>VRR Type</b></td>
			<td align='center'><b>VRR Date</b></td>
			<td align='center'><b>Plate Number</b></td>
			<td align='center'><b>Car Brand</b></td>
			<td align='center'><b>Car Type</b></td>
			<td align='center'><b>QC Name</b></td>
			<td align='center'><b>Status</b></td>
			<td align='center'><b>Affiliates</b></td>
		</tr>";
	include "data.php";
	if($_SESSION['Accounttype']=="Quality Controller") 
	{
		$q=mysqli_query($con,"SELECT * FROM vrr_database WHERE Status='Repair Checking'");
	}
	while($r=mysqli_fetch_array($q))
	{
		if($_SESSION['Accounttype']!="Dispatcher")
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo  "
				>{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		else
		{
			if($countPending>0)
			{
				$displayCar = mysqli_query($con,"SELECT * FROM vrr_database where Plate_No = '". $r['Vehicle_Plate'] ."' AND Status = 'Ticket Resolved'");
				while($showQ = mysqli_fetch_array($displayCar))
				{
					$_SESSION['modalID'] = $showQ['VRR_ID'];
					echo "
					<tr>
						<td align='center'><a ";
						if($_SESSION['Accounttype']=="Manager") echo "href='manager.php?vrrDetails={$showQ['VRR_ID']}'";
						elseif($_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$showQ['VRR_ID']}'";
						elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$showQ['VRR_ID']}'";
						elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$showQ['VRR_ID']}'";
						echo  "
						>{$showQ['VRR_ID']}</a></td>
						<td align='center'>{$showQ['VRR_Type']}</td>
						<td align='center'>{$showQ['VRR_Date']}</td>
						<td align='center'>{$showQ['Plate_No']}</td>
						<td align='center'>{$showQ['Car_Brand']}</td>
						<td align='center'>{$showQ['Car_Type']}</td>
						<td align='center'>{$showQ['User_Account']}</td>
						<td align='center'>{$showQ['Status']}</td>
						<td align='center'>{$showQ['Affiliates']}</td>
					</tr>";						
				}			
			}
		}
	}
	echo "
	</table>";
}
elseif($_GET['vrr']=="pending")
{
	echo "
	<table width='70%' class='tableVehicle'>
		<tr>
			<td align='center' colspan='10' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
				border-top-left-radius: 15px;
				border-top-right-radius: 15px;'>
				<h2><b>VRR Database</b><h2>
			</td>
		</tr>
		<tr style='background-color: #778899;'>
			<td align='center'><b>VRR ID</b></td>
			<td align='center'><b>VRR Type</b></td>
			<td align='center'><b>VRR Date</b></td>
			<td align='center'><b>Plate Number</b></td>
			<td align='center'><b>Car Brand</b></td>
			<td align='center'><b>Car Type</b></td>
			<td align='center'><b>QC Name</b></td>
			<td align='center'><b>Status</b></td>
			<td align='center'><b>Affiliates</b></td>
		</tr>";
	include "data.php";
	if($_SESSION['Accounttype']=="Dispatcher")
	{
		$q=mysqli_query($con,"SELECT * FROM vehicle_database WHERE Status = 'For Repair'");
		$countPending = mysqli_num_rows($q);
	}
	elseif($_SESSION['Accounttype']=="Manager") 
	{
		$q=mysqli_query($con,"SELECT * FROM vrr_database WHERE User_Account = 'Manager' or Status = 'Ticket Reopened'");
	}
	elseif($_SESSION['Accounttype']=="Secretary") 
	{
		$q=mysqli_query($con,"SELECT * FROM vrr_database WHERE User_Account = 'Secretary'");
	}
	elseif($_SESSION['Accounttype']=="Quality Controller") 
	{
		$q=mysqli_query($con,"SELECT * FROM vrr_database WHERE User_Account = 'Quality Controller'");
	}
	while($r=mysqli_fetch_array($q))
	{
		if($_SESSION['Accounttype']!="Dispatcher")
		{
			$_SESSION['modalID'] = $r['VRR_ID'];
			echo "
			<tr>
				<td align='center'><a ";
				if($_SESSION['Accounttype']=="Manager") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$r['VRR_ID']}'";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$r['VRR_ID']}'";
				echo  "
				>{$r['VRR_ID']}</a></td>
				<td align='center'>{$r['VRR_Type']}</td>
				<td align='center'>{$r['VRR_Date']}</td>
				<td align='center'>{$r['Plate_No']}</td>
				<td align='center'>{$r['Car_Brand']}</td>
				<td align='center'>{$r['Car_Type']}</td>
				<td align='center'>{$r['User_Account']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['Affiliates']}</td>
			</tr>";
		}
		else
		{
			if($countPending>0)
			{
				$displayCar = mysqli_query($con,"SELECT * FROM vrr_database where Plate_No = '". $r['Vehicle_Plate'] ."' AND Status = 'Ticket Resolved'");
				while($showQ = mysqli_fetch_array($displayCar))
				{
					$_SESSION['modalID'] = $showQ['VRR_ID'];
					echo "
					<tr>
						<td align='center'><a ";
						if($_SESSION['Accounttype']=="Manager") echo "href='manager.php?vrrDetails={$showQ['VRR_ID']}'";
						elseif($_SESSION['Accounttype']=="Secretary") echo "href='manager.php?vrrDetails={$showQ['VRR_ID']}'";
						elseif($_SESSION['Accounttype']=="Dispatcher") echo "href='dispatcher.php?vrrDetails={$showQ['VRR_ID']}'";
						elseif($_SESSION['Accounttype']=="Quality Controller") echo "href='qualityControl.php?vrrDetails={$showQ['VRR_ID']}'";
						echo  "
						>{$showQ['VRR_ID']}</a></td>
						<td align='center'>{$showQ['VRR_Type']}</td>
						<td align='center'>{$showQ['VRR_Date']}</td>
						<td align='center'>{$showQ['Plate_No']}</td>
						<td align='center'>{$showQ['Car_Brand']}</td>
						<td align='center'>{$showQ['Car_Type']}</td>
						<td align='center'>{$showQ['User_Account']}</td>
						<td align='center'>{$showQ['Status']}</td>
						<td align='center'>{$showQ['Affiliates']}</td>
					</tr>";						
				}			
			}
		}
	}
	echo "
	</table>";
}
?>
<div id="modalShow" class="modal">
	<div class="modal-user">
		<span class="close">&times;</span>
		<h3 style="color: #b22222;"><b>Create New Ticket</b></h3>
		<form action='#' method='POST'>
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
						<select style='width:70%;' id='newPlate' name='newPlate' onchange='form.submit()'>
							<option>-select-</option>";
							$plate = mysqli_query($con,"SELECT * FROM vehicle_database");
							while($showPlate = mysqli_fetch_array($plate))
							{
								// $_SESSION['vBrand'] = $showPlate['Vehicle_Brand'];
								// $_SESSION['vModel'] = $showPlate['Vehicle_Model'];
								echo "<option ";
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
					<?php
					if(isset($_POST['newPlate']))
					{
						include "data.php";
						$carDetails = mysqli_query($con,"SELECT * FROM vehicle_database WHERE Vehicle_Plate = '". $_POST['newPlate'] ."'");
						while($showCar = mysqli_fetch_array($carDetails))
						{
							$brandDetails = $showCar['Vehicle_Brand'];
							$modelDetails = $showCar['Vehicle_Model'];
						}
					}
					?>
					<td bgcolor="white"><b>ODO:</b>
						<br>
						<input type="text" name="newODO" size='25%' required>
					</td>
				</tr>
				<tr>
					<td bgcolor="white" width="50%"><b>Car Brand:</b>
						<br>
						<input type="text" name="newBrand" id="newBrand" size='25%' value="<?php if(isset($brandDetails)) echo $brandDetails; ?>" readonly>
					</td>
					<td bgcolor="white" width="50%"><b>Car Model:</b>
						<br>
						<input type="text" name="newModel" id="newModel" size='25%' value="<?php if(isset($modelDetails)) echo $modelDetails; ?>" readonly>
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
		</form>
	</div>
</div>