<table style='width: 60%;' border='0'>
	<tr>
		<td width='32%' align='left' bgcolor='#d3d3d3'><b>Search By:</b> 
			<select id='searchby' name='searchby' style='min-width: 150px;' onchange='functsearch()'>
				<option>-Select-</option>
				<option value='PlateNo' 
				<?php if(isset($_GET['vehicle'])) if($_GET['vehicle']=="PlateNo") echo "selected"; ?>
				>Plate No.</option>
				<option value='VehicleBrand' 
				<?php if(isset($_GET['vehicle'])) if($_GET['vehicle']=="VehicleBrand") echo "selected"; ?>
				>Vehicle Brand</option>
				<option value='VehicleModel' 
				<?php if(isset($_GET['vehicle'])) if($_GET['vehicle']=="VehicleModel") echo "selected"; ?>
				>Vehicle Model</option>
				<option value='Status' 
				<?php if(isset($_GET['vehicle'])) if($_GET['vehicle']=="Status") echo "selected"; ?>
				>Status</option>
			</select>
			<input type='text' id='searchid' hidden>
		</td>
		<form action='#' method='POST'>
		<?php if($_GET['vehicle']=="VehicleBrand") echo "
		<td width='20%' bgcolor='#d3d3d3'>
			<input type='text' name='searchBrand' placeholder='Car brand...'>
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
			<input type='text' name='searchModel' placeholder='Car Model...'>
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
		?>
		</form>
		<?php
		if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "
		<td align='right' bgcolor='#d3d3d3'>
			<button class='button button5' id='showModal'>Add Car</button>
		</td>";
		?>
	</tr>
</table>
<?php
if(isset($_POST['searchRecord']))
{
	if(isset($_POST['searchPlate']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Car/s Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Plate No.</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Model</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>PMS</b></td>
				<td align='center'>--</td>
			</tr>";
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
				<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
		}
		echo "
		</table>";
	}
	if(isset($_POST['searchBrand']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Car/s Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Plate No.</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Model</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>PMS</b></td>
				<td align='center'>--</td>
			</tr>";
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
				<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
		}
		echo "
		</table>";
	}
	if(isset($_POST['searchModel']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Car/s Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Plate No.</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Model</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>PMS</b></td>
				<td align='center'>--</td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM vehicle_database where Vehicle_Model LIKE '". $_POST['searchModel'] ."%'");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Vehicle_Plate']}</td>
				<td align='center'>{$r['Vehicle_Brand']}</td>
				<td align='center'>{$r['Vehicle_Model']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
				<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
		}
		echo "
		</table>";
	}
	if(isset($_POST['searchStatus']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Car/s Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Plate No.</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>car Model</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>PMS</b></td>
				<td align='center'>--</td>
			</tr>";
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
				<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
		}
		echo "
		</table>";
	}
}
elseif($_GET['vehicle']=="reserve")
{
	echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Car/s Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Plate No.</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Model</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>PMS</b></td>
				<td align='center'>--</td>
			</tr>";
	include "data.php";
	$q=mysqli_query($con,"SELECT * FROM vehicle_database where Status='For Rent'");
	while($r=mysqli_fetch_array($q))
	{
		echo "
			<tr>
				<td align='center'>{$r['Vehicle_Plate']}</td>
				<td align='center'>{$r['Vehicle_Brand']}</td>
				<td align='center'>{$r['Vehicle_Model']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
				<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
	}
	echo "
		</table>";
}
elseif($_GET['vehicle']=="reserved")
{
	echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Car/s Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Plate No.</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Model</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>PMS</b></td>
				<td align='center'>--</td>
			</tr>";
	include "data.php";
	$q=mysqli_query($con,"SELECT * FROM vehicle_database where Status='Reserved'");
	while($r=mysqli_fetch_array($q))
	{
		echo "
			<tr>
				<td align='center'>{$r['Vehicle_Plate']}</td>
				<td align='center'>{$r['Vehicle_Brand']}</td>
				<td align='center'>{$r['Vehicle_Model']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
				<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
	}
	echo "
		</table>";
}
elseif($_GET['vehicle']=="repair")
{
	echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Car/s Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Plate No.</b></td>
				<td align='center'><b>Car Brand</b></td>
				<td align='center'><b>Car Model</b></td>
				<td align='center'><b>Status</b></td>
				<td align='center'><b>PMS</b></td>
				<td align='center'>--</td>
			</tr>";
	include "data.php";
	$q=mysqli_query($con,"SELECT * FROM vehicle_database where Status='For Repair'");
	while($r=mysqli_fetch_array($q))
	{
		echo "
			<tr>
				<td align='center'>{$r['Vehicle_Plate']}</td>
				<td align='center'>{$r['Vehicle_Brand']}</td>
				<td align='center'>{$r['Vehicle_Model']}</td>
				<td align='center'>{$r['Status']}</td>
				<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
				<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
	}
	echo "
		</table>";
}
elseif($_GET['vehicle']=="owned")
{
	echo "
	<table width='60%' class='tableVehicle'>
		<tr>
			<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
				border-top-left-radius: 15px;
				border-top-right-radius: 15px;'>
				<h2><b>Car/s Database</b><h2>
			</td>
		</tr>
		<tr style='background-color: #778899;'>
			<td align='center'><b>Plate No.</b></td>
			<td align='center'><b>Car Brand</b></td>
			<td align='center'><b>Car Model</b></td>
			<td align='center'><b>Status</b></td>
			<td align='center'><b>PMS</b></td>
			<td align='center'>--</td>
		</tr>";
	include "data.php";
	$q=mysqli_query($con,"SELECT * FROM vehicle_database");
	while($r=mysqli_fetch_array($q))
	{
		echo "
		<tr>
			<td align='center'>{$r['Vehicle_Plate']}</td>
			<td align='center'>{$r['Vehicle_Brand']}</td>
			<td align='center'>{$r['Vehicle_Model']}</td>
			<td align='center'>{$r['Status']}</td>
			<td align='center'>{$r['PMS_Start']} to {$r['PMS_End']}</td>
			<td align='center'><a href='";
				if($_SESSION['Accounttype']=="Manager" or $_SESSION['Accounttype']=="Secretary") echo "manager.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher.php?vview={$r['Vehicle_ID']}";
				elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl.php?vview={$r['Vehicle_ID']}";
				echo "' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "
					| <a href='manager.php?deleteVehicle={$r['Vehicle_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?') "
					<?php
					echo "
					style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>";
				}
			echo "
			</tr>";
	}
	echo "
	</table>";
}
?>
<div id="modalShow" class="modal">
	<div class="modal-car">
		<span class="close">&times;</span>
		<form action='#' method='POST'>
			<table cellspacing='10' width='80%' border='0' bgcolor='white' style='margin: 60px; border-radius: 20px;'>
				<tr style="background-color: white;">
					<td colspan="2" align="center"><h3 style="color: #b22222;"><b>Add New Car Details</b></h3></td>
				</tr>
				<tr>
					<td bgcolor='white'><b>Plate No.:</b></td>
					<td bgcolor='white'><input type='text' name='savePlate' size='30%' required></td>
				</tr>
				<tr>
					<td bgcolor='white'><b>Car Brand:</b></td>
					<td bgcolor='white'><input type='text' name='saveBrand' size='30%' required></td>
				</tr>
				<tr>
					<td bgcolor='white'><b>Car Model:</b></td>
					<td bgcolor='white'><input type='text' name='saveModel' size='30%' required></td>
				</tr>
				<tr>
					<td bgcolor='white'><b>Status:</b></td>
					<td bgcolor='white'>
						<select style='font-size: 15px;' name='saveStatus'>
							<option>For Rent</option>
							<option>For Repair</option>
							<option>Reserved</option>
						</select>
					</td>
				</tr>
				<tr>
					<td bgcolor='white' colspan="2"><input type='submit' name='newVehicle' class='button button5' value='Save'></td>
				</tr>
			</table>
	</div>
</div>