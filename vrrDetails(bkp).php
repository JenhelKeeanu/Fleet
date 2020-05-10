<?php
if(isset($_GET['vrrDetails']))
{
	 $_SESSION['vrrNo'] = $_GET['vrrDetails'];
	 echo "<script>test.call();</script>";
}
include "data.php";
$showVRRdetails = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
while($viewVRRdetails = mysqli_fetch_array($showVRRdetails))
{
	echo "
	<h3 style='color: #b22222;'><b>VEHICLE REPAIR REQUEST</b></h3>
	<table cellpadding='5' cellspacing='10' width='50%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
		<tr>
			<td bgcolor='white'><b>Type: </b>{$viewVRRdetails['VRR_Type']}</td>
			<td bgcolor='white'><b>Date: </b>{$viewVRRdetails['VRR_Date']}</td>
		</tr>
		<tr>
			<td width='50%' bgcolor='white'><b>Plate Number: </b>{$viewVRRdetails['Plate_No']}</td>
			<td bgcolor='white'><b>ODO: </b>{$viewVRRdetails['ODO']}</td>
		</tr>
		<tr>
			<td bgcolor='white'><b>Car Brand: </b>{$viewVRRdetails['Car_Brand']}</td>
			<td bgcolor='white'><b>Car Type: </b>{$viewVRRdetails['Car_Type']}</td>
		</tr>
		<tr>
			<td bgcolor='white' colspan='2'><b>Status: </b>{$viewVRRdetails['Status']}</td>
		</tr>
		<tr>
			<td bgcolor='white' colspan='2'><b>Concern: </b>
				<br>
				<textarea style='width: 80%;'>{$viewVRRdetails['VRR_Concern']}</textarea>
			</td>
		</tr>
		<tr>
			<td bgcolor='white' colspan='2'><b>QC Name: </b>{$viewVRRdetails['QC_Name']}</td>
		</tr>
		<tr>
			<td bgcolor='white' colspan='2'><b>Affiliate: </b>{$viewVRRdetails['Affiliates']}</td>
		</tr>
		<tr>
			<td bgcolor='white' colspan='2'><b>Branch: </b>{$viewVRRdetails['Branch']}</td>
		</tr>
		<tr>
			<td bgcolor='white' colspan='2'><button class='buttonlink' id='showModal'>>View Notes<</button></td>
		</tr>
		<tr>
			<td bgcolor='white'>
				<select class='button button5' id='vrrAccount' onchange='functvrr()'>
					<option>-Select Action-</option>";
					if($_SESSION['Accounttype']!="Manager" and $_SESSION['Accounttype']!="Secretary") echo "<option>Edit Ticket</option>";
					if($_SESSION['Accounttype']=="Manager") echo "<option value='chooseAffil'>Choose Affiliate</option>";
					echo "
					<option value='addNote'>Add Note</option>
					<option value='forwardTicket'>Forward Ticket</option>
				</select>
			</td>
			<td bgcolor='white' align='right'>
				<form action='#' method='POST'>
					<input type='submit' class='button button5' name='backD' value='Back'>
				</form>
			</td>
		</tr>
	</table>
";
}
if(isset($_GET['action']))
{
	if($_GET['action']=="chooseAffil")
	{
		echo "
		<form action='#' method='POST'>
			<table cellpadding='5' cellspacing='10' width='25%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
				<tr>
					<td bgcolor='white' width='50%'><b>Select an Affiliate: <b></td>
					<td bgcolor='white'>	
						<select style='min-width: 120px;' name='affilList' onchange='this.form.submit()'>";
						include "data.php";
						$affilChoices = mysqli_query($con,"SELECT DISTINCT Affiliates_Name FROM affiliates_database");
						while($showChoices = mysqli_fetch_array($affilChoices))
						{
							echo "<option ";
							if(isset($_POST['affilList']))
							{
								if($_POST['affilList']==$showChoices['Affiliates_Name']) echo "selected";
							} 
							echo ">{$showChoices['Affiliates_Name']}</option>";
						}
						echo "
						</select>
					</td>
				</tr>
				<tr>";
				if(isset($_POST['affilList']))
				{
					echo "
					<td bgcolor='white'><b>Select Branch: </b></td>
					<td bgcolor='white'>
						<select style='min-width: 120px;' name='branchList'>";
							include "data.php";
							$branchShow = mysqli_query($con,"SELECT Branch FROM affiliates_database WHERE Affiliates_Name='". $_POST['affilList'] ."'");
							while($showBranch = mysqli_fetch_array($branchShow))
							{
								echo "<option>{$showBranch['Branch']}</option>";
							}
						echo "
						</select>
					</td>";
				}
				echo "
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'><b>Note:</b></td>
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'>
						<textarea name='noteVrr' style='width: 100%;'></textarea>
					</td>
				</tr>
				<tr>
					<td colspan='2' bgcolor='white'><input class='button button5' name='updateAffil' type='submit' value='Update Changes'></td>
				</tr>
			</table>
		</form>";
	}
	elseif($_GET['action']=="addNote")
	{
		echo "
		<form action='#' method='POST'>
			<table cellpadding='5' cellspacing='10' width='25%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
				<tr>
					<td bgcolor='white'><b>Type of Note: </b></td>
					<td bgcolor='white'>
						<select style='min-width: 120px;' name='noteType'>
							<option>-select-</option>
							<option>Reminder</option>
							<option>Follow-Up</option>
							<option>Update</option>
							<option>Others</option>
						</select>
					</td>
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'><b>Note: </b></td>
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='noteDetails'></textarea></td>
				</tr>
				<tr>
					<td><input type='submit' class='button button5' name='noteSave' value='Save Note'></td>
				</tr>
			</table>
		</form>";
	}
	elseif($_GET['action']=="forwardTicket")
	{
		echo "
		<form action='#' method='POST'>
			<table cellpadding='5' cellspacing='10' width='25%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
				<tr>
					<td bgcolor='white'><b>Forward to: </b></td>
					<td bgcolor='white'>
						<select style='min-width: 120px;' name='userChoice'>";
						include "data.php";
						$showUsers = mysqli_query($con,"SELECT DISTINCT First_Name, Middle_Name, Last_Name FROM users_database");
						while($displayUsers = mysqli_fetch_array($showUsers))
						{
							echo "<option>{$displayUsers['Last_Name']}, {$displayUsers['First_Name']} {$displayUsers['Middle_Name']}</option>";
						}
						echo "
						</select>
					</td>
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'><b>Note: </b></td>
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='userNotes'></textarea></td>
				</tr>
				<tr>
					<td><input type='submit' class='button button5' name='userSave' value='Save Changes'></td>
				</tr>
			</table>
		</form>";	
	}
}
?>
<div id='modalShow' class="modal">
	<div class="modal-car">
		<span class="close">&times;</span>
		<center>
				<?php
				include "data.php";
				$notes = mysqli_query($con,"SELECT * FROM vrrnotes_database WHERE VRR_ID = '". $_GET['vrrDetails'] ."'");
				$countNotes = mysqli_num_rows($notes);
				if($countNotes>0)
				{
					echo "
					<table cellpadding='6' style='border-collapse: collapse;'>
						<tr>
							<td bgcolor='white' colspan='2'><h3><b>Notes Details</b></h3></td>
						</tr>";

					while($showNotes = mysqli_fetch_array($notes))
					{
						echo "<tr>
								<td bgcolor='white' style='border-top: 2px solid black; border-left: 2px solid black;'>
								<b>{$showNotes['Note_Type']}</b>
								</td>
								<td bgcolor='white' style='border-top: 2px solid black; border-right: 2px solid black;' align='right'><font style='font-size: 12px;'>{$showNotes['Note_Date']} {$showNotes['Note_Time']}</font></td>
							</tr>
							<tr>
								<td bgcolor='white' style='border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;' colspan='2'>
								{$showNotes['Notes']}
								</td>
							</tr>
							<tr>
								<td bgcolor='white' style='border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;' colspan='2' align='right'><font style='font-size: 12px;'><b>{$showNotes['User_Note']}</b></font></td>
							</tr>";
					}
					echo "
					</table>";
				}
				else
				{
					echo "
					<table>
						<tr>
							<td><h3><b>No Notes for the VRR Ticket</b></h3></td>
						</tr>";
				}
				?>
			</table>
		</center>
	</div>
</div>
<div id='actionShow' class="modal">
	<div class="modal-car">
		<span class="close" id="actionClose">&times;</span>
		<?php
		if($_GET['action']=="chooseAffil")
	{
		echo "
		<form action='#' method='POST'>
			<table cellpadding='5' cellspacing='10' width='25%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
				<tr>
					<td bgcolor='white' width='50%'><b>Select an Affiliate: <b></td>
					<td bgcolor='white'>	
						<select style='min-width: 120px;' name='affilList' onchange='this.form.submit()'>";
						include "data.php";
						$affilChoices = mysqli_query($con,"SELECT DISTINCT Affiliates_Name FROM affiliates_database");
						while($showChoices = mysqli_fetch_array($affilChoices))
						{
							echo "<option ";
							if(isset($_POST['affilList']))
							{
								if($_POST['affilList']==$showChoices['Affiliates_Name']) echo "selected";
							} 
							echo ">{$showChoices['Affiliates_Name']}</option>";
						}
						echo "
						</select>
					</td>
				</tr>
				<tr>";
				if(isset($_POST['affilList']))
				{
					echo "
					<td bgcolor='white'><b>Select Branch: </b></td>
					<td bgcolor='white'>
						<select style='min-width: 120px;' name='branchList'>";
							include "data.php";
							$branchShow = mysqli_query($con,"SELECT Branch FROM affiliates_database WHERE Affiliates_Name='". $_POST['affilList'] ."'");
							while($showBranch = mysqli_fetch_array($branchShow))
							{
								echo "<option>{$showBranch['Branch']}</option>";
							}
						echo "
						</select>
					</td>";
				}
				echo "
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'><b>Note:</b></td>
				</tr>
				<tr>
					<td bgcolor='white' colspan='2'>
						<textarea name='noteVrr' style='width: 100%;'></textarea>
					</td>
				</tr>
				<tr>
					<td colspan='2' bgcolor='white'><input class='button button5' name='updateAffil' type='submit' value='Update Changes'></td>
				</tr>
			</table>
		</form>";
	}
		?>
		</div>
	</div>