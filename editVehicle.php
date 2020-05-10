<?php
include "data.php";
$vehicleView = mysqli_query($con,"SELECT * FROM vehicle_database WHERE Vehicle_ID='". $_GET['vview'] ."'");
while($showVehicle = mysqli_fetch_array($vehicleView))
{
	$_SESSION['updateP'] = $showVehicle['Vehicle_Plate'];
	echo "
	<form action='#' method='POST'>
		<table cellspacing='10' width='30%' border='0' bgcolor='white' style='margin: 30px; border-radius: 20px;'>
			<tr style='background-color: white;''>
				<td colspan='2' align='center'><h3 style='color: #b22222;'><b>CAR DETAILS</b></h3></td>
			</tr>
			<tr>
				<td bgcolor='white'><b>Plate No.:</b></td>
				<td bgcolor='white'><input type='text' name='updatePlate' size='30%' value='{$showVehicle['Vehicle_Plate']}' ";
				if(!isset($_POST['updateVehicle']) or $_SESSION['Accounttype']!="Manager") echo "readonly";
			echo "></td>
			</tr>
			<tr>
				<td bgcolor='white'><b>Vehicle Brand:</b></td>
				<td bgcolor='white'><input type='text' name='updateBrand' size='30%' value='{$showVehicle['Vehicle_Brand']}' ";
				if(!isset($_POST['updateVehicle']) or $_SESSION['Accounttype']!="Manager") echo "readonly";
			echo "></td>
			</tr>
			<tr>
				<td bgcolor='white'><b>Vehicle Model:</b></td>
				<td bgcolor='white'><input type='text' name='updateModel' size='30%' value='{$showVehicle['Vehicle_Model']}' ";
				if(!isset($_POST['updateVehicle']) or $_SESSION['Accounttype']!="Manager") echo "readonly";
			echo "></td>
			</tr>
			<tr>
				<td bgcolor='white'><b>Status:</b></td>
				<td bgcolor='white'>";
				if(!isset($_POST['updateVehicle'])) echo "<input type='text' value='{$showVehicle['Status']}'>";
				else
				{
					echo "
					<select style='font-size: 15px;' name='updateStatus'>
						<option ";
						if($showVehicle['Status']=="For Rent") echo "selected";
						echo "
						>For Rent</option>
						<option ";
						if($showVehicle['Status']=="For Repair") echo "selected";
						echo "
						>For Repair</option>
						<option ";
						if($showVehicle['Status']=="Reserved") echo "selected";
						echo "
						>Reserved</option>
					</select>";
				}
					
				echo "
				</td>
			</tr>
			<tr>
				<td colspan='2' bgcolor='white'><b>Maintenance Period:</b></td>
			</tr>
			<tr>
				<td bgcolor='white'><font style='font-size: 12px;'><b>Start Date:</b></font><br><input type='date' name='updatePMSStart' value='{$showVehicle['PMS_Start']}' ";
				if(!isset($_POST['updateVehicle']) or $_SESSION['Accounttype']!="Manager") echo "readonly";
			echo "></td>
				<td bgcolor='white'><font style='font-size: 12px;'><b>End Date:</b></font><br><input type='date' name='updatePMSEnd' value='{$showVehicle['PMS_End']}' ";
				if(!isset($_POST['updateVehicle']) or $_SESSION['Accounttype']!="Manager") echo "readonly";
			echo "></td>
			</tr>
			<tr>";
				if($_SESSION['Accounttype']!="Quality Controller")
				{
					if(!isset($_POST['updateVehicle'])) echo "<td bgcolor='white'><input type='submit' name='updateVehicle' class='button button5' value='Update'></td>";
					else echo "<td bgcolor='white'><input type='submit' name='saveVehicle' class='button button5' value='Save'></td>";
				}
				echo "
				<td align='right' bgcolor='white' ";
				if($_SESSION['Accounttype']=="Quality Controller") echo "colspan='2'";
				echo "
				><input type='submit' name='backV' class='button button5' value='Back'></td>
			</tr>
		</table>
	</form>";
}
if($_SESSION['Accounttype']!="Quality Controller") echo "<font size='2' color='#195905'><b>***NOTE: Please click update button to change details.***</b></font>";
?>

		
		
		
		
		