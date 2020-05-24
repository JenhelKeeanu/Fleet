<?php
if(isset($_GET['vrrDetails']))
{
	 $_SESSION['vrrNo'] = $_GET['vrrDetails'];
}
include "data.php";
$showVRRdetails = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
while($viewVRRdetails = mysqli_fetch_array($showVRRdetails))
{
	echo "
	<h3 style='color: #b22222;'><b>VEHICLE REPAIR REQUEST</b></h3>
	<table cellpadding='5' cellspacing='10' width='40%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
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
				<select class='button button5' id='vrrAccount' onchange='functvrr()' ";
				// $actionView = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
				// while($doAction = mysqli_fetch_array($actionView))
				// {
				// 	if($doAction['User_Account']!="Manager") echo "hidden";
				// }
				echo "
				>
					<option>-Select Action-</option>";
					if($viewVRRdetails['Status']!="Ticket Voided")
					{
						if($_SESSION['Accounttype']!="Manager" and $_SESSION['Accounttype']!="Secretary")
						{
							echo "<option value='editTicket' ";
							if($viewVRRdetails['Status']=="Ticket Reopened" or $_SESSION['Accounttype']=="Dispatcher" or $viewVRRdetails['Status']=="VRR Checking")
							{
								if($_SESSION['Accounttype']!="Manager") echo "hidden";
							}
							elseif($viewVRRdetails['User_Account']!="Quality Controller" or $viewVRRdetails['Status']=="Repair Checking" or $viewVRRdetails['Status']=="Repair Ongoing" or $viewVRRdetails['Status']=="Affiliate Repair")
							{
								echo "hidden";
							}
							echo ">Edit Ticket</option>";
						}
						elseif($_SESSION['Accounttype']=="Manager" and $viewVRRdetails['User_Account']=="Manager")
						{
							if($viewVRRdetails['VRR_Type']=="Major" and $viewVRRdetails['Affiliates']=="") echo "<option value='chooseAffil'>Choose Affiliate</option>";
							elseif($viewVRRdetails['VRR_Type']=="Minor" and $viewVRRdetails['Status']!="Repair Ongoing") echo "<option value='assignQC'>Assign to QC</option>";
						} 
						echo "
						<option value='addNote'>Add Note</option>";
						if($_SESSION['Accounttype']=="Manager" and $viewVRRdetails['User_Account']=="Manager")
						{
							if($viewVRRdetails['Status']=='Repair Checking') echo "<option value='returnTicket'>Return Repair Ticket</option>";
							elseif($viewVRRdetails['Status']!="Affiliate Repair"&&$viewVRRdetails['Status']!='Repair Checking') echo "<option value='returnTicket'>Return Ticket</option>";
							echo "<option value='changeStatus'>Change Status</option>";
						}
						elseif($viewVRRdetails['Status']!='Repair Ongoing' && $viewVRRdetails['VRR_Type']!="" and $viewVRRdetails['VRR_Concern']!="" and $_SESSION['Accounttype']=="Quality Controller" and $viewVRRdetails['User_Account']=="Quality Controller")
						{
								echo "<option value='forwardTicket'>Forward Ticket</option>";
						}
						elseif($_SESSION['Accounttype']=="Secretary" and $viewVRRdetails['User_Account']=="Secretary")
						{
							echo "
							<option value='forwardTicket'>Forward Ticket</option>
							<option value='returnTicket'>Return Ticket</option>";
						}elseif($viewVRRdetails['Status']=='Repair Checking' && $_SESSION['Accounttype']=="Quality Controller"){
							echo "<option value='forwardTicket'>Return Repair Ticket</option>";
							echo "<option value='ticketSolved'>Ticket Solved</option>";
						}elseif($viewVRRdetails['Status']=='Repair Ongoing' && $_SESSION['Accounttype']=="Quality Controller"){
							echo "<option value='ticketSolved'>Ticket Solved</option>";
						}
					}
					else
					{
						if($_SESSION['Accounttype']=="Manager") echo "<option value='ticketOpen'>Reopen Ticket</option>";
					}
				echo "
				</select>
			</td>
			<td bgcolor='white' align='right'>
				<button class='button button5' onclick='Back2b()'>Back</button>
			</td>
		</tr>
	</table>
";
}
?>
<div id='modalShow' class="modal">
	<div class="modal-car">
		<span class="close">&times;</span>
		<center>
				<?php
				if (isset($_GET['notePage']))
				{
				    $pageno = $_GET['notePage'];
				} 
				else 
				{
				    $pageno = 1;
				}
				$numberPages = 4;
				$offset = ($pageno-1) * $numberPages;
				include "data.php";
				$notes = mysqli_query($con,"SELECT * FROM vrrnotes_database WHERE VRR_ID = '". $_SESSION['vrrNo'] ."' LIMIT $offset,4");
				$notesAll = mysqli_query($con,"SELECT * FROM vrrnotes_database WHERE VRR_ID = '". $_SESSION['vrrNo'] ."'");
				$countNotes = mysqli_num_rows($notesAll);
				$pageNote = $countNotes/4;
				$pageNote = ceil($pageNote);
				if($countNotes>0)
				{
					echo "
					<table cellpadding='6' style='border-collapse: collapse;'>
						<tr>
							<td bgcolor='white' colspan='2'><h3><b>Notes Details (Page {$pageno})</b></h3></td>
						</tr>";

					while($showNotes = mysqli_fetch_array($notes))
					{
						echo "<tr>
								<td bgcolor='white' style='border-top: 2px solid black; border-left: 2px solid black;'>
								<b>{$showNotes['Note_Type']} ";
								if($showNotes['Note_Type'] == "Update Affiliate") echo "to {$showNotes['Assigned_Affil']}";
								elseif($showNotes['Note_Type'] == "Change User") echo "to {$showNotes['Change_User']}";
								elseif($showNotes['Note_Type'] == "Change Account") echo "to {$showNotes['Change_User']}";
								elseif($showNotes['Note_Type'] == "Return Account") echo "to {$showNotes['Change_User']}";
								elseif($showNotes['Note_Type'] == "Forward Account") echo "to {$showNotes['Change_User']}";
								echo "</b>
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
					$i = 1;
					if(isset($_GET['noteEnd']))
					{
						if($_GET['noteEnd']%3==0)
						{
							$i = $_GET['noteEnd']+1;
							$_SESSION['n'] = $_GET['noteEnd']+1;
						}
					}
					elseif(isset($_SESSION['n']))
					{
						if(isset($_GET['notePage']))
						{
							if($_SESSION['n']<=$_GET['notePage'])
							{
								$i = $_SESSION['n'];
							}
						}
					}
					echo "
						<tr>
							<form action='#' method='POST'>
								<td bgcolor='white' align='center' colspan='2'>
									<a href='";
									if($_SESSION['Accounttype']=="Manager") echo "manager";
									elseif($_SESSION['Accounttype']=="Secretary") echo "manager";
									elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl";
									elseif($_SESSION['Accounttype']=="Dispatcher") echo "Dispatcher";
									echo "
									.php?notePage=1'><b><<</a> |</b> ";
									if($i>3)
									{
										$back = $i - 3;
										if($back==1)
										{
											echo "<a href='";
											if($_SESSION['Accounttype']=="Manager") echo "manager";
											elseif($_SESSION['Accounttype']=="Secretary") echo "manager";
											elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl";
											elseif($_SESSION['Accounttype']=="Dispatcher") echo "Dispatcher";
											echo "
											.php?notePage=1'><b>...</a> |</b>";
										}
										elseif(($back-1)%3==0)
										{
											$back = $back -1;
											echo "<a href='";
											if($_SESSION['Accounttype']=="Manager") echo "manager";
											elseif($_SESSION['Accounttype']=="Secretary") echo "manager";
											elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl";
											elseif($_SESSION['Accounttype']=="Dispatcher") echo "dispatcher";
											echo "
											.php?noteEnd={$back}'><b>...</a> |</b>";
										}
									}
									for($i;$i<=$pageNote;$i++)
									{
										echo "<a href='";
										if($_SESSION['Accounttype']=="Manager") echo "manager";
										elseif($_SESSION['Accounttype']=="Secretary") echo "manager";
										elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl";
										elseif($_SESSION['Accounttype']=="Dispatcher") echo "Dispatcher";
										echo "
										.php?notePage={$i}'><b>".$i."</a> |</b> ";
										if($i==$pageNote) break;
										elseif($i%3==0)
										{
											echo "<a href='";
											if($_SESSION['Accounttype']=="Manager") echo "manager";
											elseif($_SESSION['Accounttype']=="Secretary") echo "manager";
											elseif($_SESSION['Accounttype']=="Quality Controller") echo "qualityControl";
											elseif($_SESSION['Accounttype']=="Dispatcher") echo "Dispatcher";
											echo "
											.php?noteEnd={$i}'><b>...</a> |</b> ";
											$end = $i;
											break;
										}
									}
									// for($i=1;$i<=$pageNote;$i++){
									// 	echo "<b> <a href='manager.php?notePage={$i}'>".$i." | </a></b>";
									// 	if($i%3==0)
									// 	{
									// 		echo "<a href='manager.php?noteEnd={$i}'><b>...</a> |</b> ";
									// 		$end = $i;
									// 		break;	
									// 	} 
									// }
								echo "
									<a href='manager.php?notePage={$pageNote}'><b> >></b></a>
								</td>
							</form>
						</tr>
					</table>";
				}
				else
				{
					echo "
					<table>
						<tr>
							<td bgcolor='white'><h3><b>No Notes for the VRR Ticket</b></h3></td>
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
				<table cellpadding='5' cellspacing='10' width='50%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
					<tr>
						<td bgcolor='white' width='50%'><b>Select an Affiliate: <b></td>
						<td bgcolor='white'>	
							<select style='min-width: 120px;' name='affilList' onchange='this.form.submit()'>
								<option>-select-</option>";
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
							<textarea name='noteVrr' style='width: 100%;' required></textarea>
						</td>
					</tr>
					<tr>
						<td colspan='2' bgcolor='white'><input class='button button5' name='updateAffil' type='submit' value='Update Changes'></td>
					</tr>
				</table>
			</form>";
		}
		if($_GET['action']=="assignQC")
		{
			echo "
			<form action='#' method='POST'>
				<table cellpadding='5' cellspacing='10' width='40%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
					<tr>
						<td bgcolor='white' width='50%'><b>Assign to Quality Control<b></td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><b>Note:</b></td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'>
							<textarea name='noteVrr' style='width: 100%;' required></textarea>
						</td>
					</tr>
					<tr>
						<td bgcolor='white'><input class='button button5' name='updateQC' type='submit' value='Update Changes'></td>
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
						<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='noteDetails' required></textarea></td>
					</tr>
					<tr>
						<td bgcolor='white'><input type='submit' class='button button5' name='noteSave' value='Save Note'></td>
					</tr>
				</table>
			</form>";
		}
		elseif($_GET['action']=="forwardTicket")
		{
			if($_SESSION['Accounttype']=="Manager")
			{
				echo "
				<form action='#' method='POST'>
					<table cellpadding='5' cellspacing='10' width='40%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
						<tr>
							<td bgcolor='white' colspan='2'><b>Forward to Quality Control</b></td>
						</tr>
						<tr>
							<td bgcolor='white' colspan='2'><b>Note: </b></td>
						</tr>
						<tr>
							<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='userNotes' required></textarea></td>
						</tr>
						<tr>
							<td bgcolor='white'><input type='submit' class='button button5' name='userSave' value='Save Changes'></td>
						</tr>
					</table>
				</form>";
			}
			elseif($_SESSION['Accounttype']=="Quality Controller" or $_SESSION['Accounttype']=="Secretary")
			{
				echo "
				<form action='#' method='POST'>
					<table cellpadding='5' cellspacing='10' width='40%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
						<tr>
							<td bgcolor='white' colspan='2'><b>";
							include "data.php";
							$statusData = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID = '". $_SESSION['vrrNo'] ."'");
							while($showData = mysqli_fetch_array($statusData))
							{
								$_SESSION['vrrStatus'] = $showData['Status'];
								if($showData['Status']=="Pending") echo "Forward to Secretary";
								elseif($showData['Status']=="VRR Checking") echo "Forward to Manager";
								elseif($showData['Status']=="Repair Ongoing") echo "Forward to Manager";
								elseif($showData['Status']=="Repair Checking") echo "Forward to Manager";
							}
							echo "
							</b></td>
						</tr>
						<tr>
							<td bgcolor='white' colspan='2'><b>Note: </b></td>
						</tr>
						<tr>
							<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='userNotes' required></textarea></td>
						</tr>
						<tr>
							<td bgcolor='white'><input type='submit' class='button button5' name='userSave' value='Save Changes'></td>
						</tr>
					</table>
				</form>";
			}
		}
		elseif($_GET['action']=="ticketSolved")
		{
			echo "
			<form action='#' method='POST'>
				<table cellpadding='5' cellspacing='10' width='40%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
					<tr>
						<td bgcolor='white' colspan='2'><b>";
						include "data.php";
						$statusData = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID = '". $_SESSION['vrrNo'] ."'");
						while($showData = mysqli_fetch_array($statusData))
						{
							$_SESSION['vrrStatus'] = $showData['Status'];
							if($showData['Status']=="Pending") echo "Forward to Secretary";
							elseif($showData['Status']=="VRR Checking") echo "Forward to Manager";
							elseif($showData['Status']=="Repair Ongoing") echo "Forward to Manager";
							elseif($showData['Status']=="Repair Checking") echo "Forward To Dispatcher";
						}
						echo "
						</b></td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><b>Note: </b></td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='userNotes' required></textarea></td>
					</tr>
					<tr>
						<td bgcolor='white'><input type='submit' class='button button5' name='btnticketSolved' value='Save Changes'></td>
					</tr>
				</table>
			</form>";
		}
		elseif($_GET['action']=="returnTicket")
		{
			echo "
			<form action='#' method='POST'>
				<table cellpadding='5' cellspacing='10' width='40%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
					<tr>";
					include "data.php";
					$statusData = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID = '". $_SESSION['vrrNo'] ."'");
					while($showData = mysqli_fetch_array($statusData))
					{
						if($showData['Status']=="VRR Checking")
						echo"	<td bgcolor='white' colspan='2'><b>Return to Quality Control</b></td>";
						elseif($showData['Status']=="Repair Checking")
						echo"	<td bgcolor='white' colspan='2'><b>Return to Affiliate</b></td>";
					}
					echo"
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><b>Reason: </b></td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='userNotes' required></textarea></td>
					</tr>
					<tr>
						<td bgcolor='white'><input type='submit' class='button button5' name='returnSave' value='Save Changes'></td>
					</tr>
				</table>
			</form>";
		}
		elseif($_GET['action']=="changeStatus")
		{
			echo "
			<form action='#' method='POST'>
				<table cellpadding='5' cellspacing='10' width='25%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
					<tr>
						<td bgcolor='white'><b>Change Status: </b></td>
						<td bgcolor='white'>
							<select style='min-width: 120px;' name='statusChoice'>
								<option>-select-</option>
								<option>Void Ticket</option>
								<option>Repair Checking</option>
								<option>For Rent</option>
							</select>
						</td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><b>Reason: </b></td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='statusNotes' required></textarea></td>
					</tr>
					<tr>
						<td bgcolor='white'><input type='submit' class='button button5' name='statusSave' value='Save Status'></td>
					</tr>
				</table>
			</form>";	
		}
		elseif($_GET['action']=="ticketOpen")
		{
			echo "
			<form action='#' method='POST'>
				<table cellpadding='5' cellspacing='10' width='50%' border='0' bgcolor='white' style='margin: 15px; border-radius: 20px;'>
					<tr>
						<td bgcolor='white' colspan='2'><b>Reason For Opening: </b></td>
					</tr>
					<tr>
						<td bgcolor='white' colspan='2'><textarea style='width: 100%;' name='openNotes' required></textarea></td>
					</tr>
					<tr>
						<td bgcolor='white'><input type='submit' class='button button5' name='openSave' value='Save Changes'></td>
					</tr>
				</table>
			</form>";
		}
		elseif($_GET['action']=="editTicket")
		{
			include "data.php";
			$showVRRdetails = mysqli_query($con,"SELECT * FROM vrr_database WHERE VRR_ID='". $_SESSION['vrrNo'] ."'");
			while($viewVRRdetails = mysqli_fetch_array($showVRRdetails))
			{
				echo "
				<h3 style='color: #b22222;'><b>Update Ticket</b></h3>
				<form action='#' method='POST'>
					<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 20px; border-collapse: collapse; border: 2px solid black;'>
						<tr>
							<td bgcolor='white' colspan='2'><b>VRR Type:</b> 
								<select name='newType' style='width: 30%'>
									<option>-select-</option>
									<option ";
									if($viewVRRdetails['VRR_Type']=="Major") echo "selected";
									echo "
									>Major</option>
									<option";
									if($viewVRRdetails['VRR_Type']=="Minor") echo "selected";
									echo "
									>Minor</option>
								</select>
							</td>
						</tr>
						<tr>
							<td bgcolor='white' width='50%'><b>Plate No:</b>
								<br>
								<select style='width:70%;' name='newPlate' required onchange='form.submit()'>
									<option>-select-</option>";
									if(!isset($_POST['newPlate']))
									{
										$plate = mysqli_query($con,"SELECT * FROM vehicle_database");
										while($showPlate = mysqli_fetch_array($plate))
										{
											echo "
											<option ";
											if($viewVRRdetails['Plate_No']==$showPlate['Vehicle_Plate']) echo "selected";
											echo "
											>{$showPlate['Vehicle_Plate']}</option>";
										}
									}
									else
									{
										$plate = mysqli_query($con,"SELECT * FROM vehicle_database");
										while($showPlate = mysqli_fetch_array($plate))
										{
											echo "<option ";
											if(isset($_POST['newPlate']))
											{
												if($_POST['newPlate']==$showPlate['Vehicle_Plate']) echo "selected";
											}
											echo "
											>{$showPlate['Vehicle_Plate']}</option>";
										}
									}
								echo "
								</select>
							</td>
							<td bgcolor='white'><b>ODO:</b>
								<br>
								<input type='text' name='newODO' size='20%' value='{$viewVRRdetails['ODO']}' required>
							</td>
						</tr>";
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
						echo "
						<tr>
							<td bgcolor='white'><b>Car Brand:</b>
								<br>
								<input type='text' name='newBrand' id='newBrand' size='20%' readonly value='";
								if(!isset($_POST['newPlate']))
								{
									echo $viewVRRdetails['Car_Brand'];
								}
								else
								{
									if(isset($brandDetails)) echo $brandDetails;
								}
								echo "'
								>
							</td>
							<td bgcolor='white'><b>Car Model:</b>
								<br>
								<input type='text' name='newModel' id='newModel' size='20%' readonly value='";
								if(!isset($_POST['newPlate']))
								{
									echo $viewVRRdetails['Car_Type'];
								}
								else
								{
									if(isset($modelDetails)) echo $modelDetails;
								}
								echo "
								'>
							</td>
						</tr>
						<tr>
							<td colspan='2' bgcolor='white'><b>Concern:</b>
								<br>
								<textarea style='width:70%;' name='newConcern'>{$viewVRRdetails['VRR_Concern']}</textarea>
							</td>
						</tr>
						<tr>
						<td bgcolor='white' colspan='2'>
							<input type='submit' class='button button5' name='newVRR' value='Save Ticket'>
						</td>
						</tr>
					</table>
				</form>";
			}
		}
		?>
	</div>
</div>