<?php
include "data.php";
$details = mysqli_query($con,"SELECT * FROM users_database WHERE User_ID = '". $_SESSION['UserID'] ."'");
while($rdetails = mysqli_fetch_array($details))
{
	$_SESSION['detailsID'] = $rdetails['User_ID'];
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
?>
<h2 style="color: #b22222;"><b>ACCOUNT DETAILS</b></h2>
<form action='#' method='POST'>
	<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 15px; border-collapse: collapse;'>
		<tr>
			<td bgcolor='white' style='border: 2px solid black;'><b>First Name:</b>
				<br>
				<input type='text' name='updateFirst' size='20%' 
				<?php
				if(isset($_POST['editAccount'])) echo "value='{$detailsFirst}'";
				else echo "value='{$detailsFirst}' readonly";
				?>
				>
			</td>
			<td bgcolor='white' style='border: 2px solid black;'><b>Middle Name:</b>
				<br>
				<input type="text" name="updateMiddle" size='20%' 
				<?php
				if(isset($_POST['editAccount'])) echo "value='{$detailsMiddle}'";
				else echo "value='{$detailsMiddle}' readonly";
				?>
				>
			</td>
			<td bgcolor='white' style='border: 2px solid black;'><b>Last Name:</b>
				<br>
				<input type="text" name="updateLast" size='20%' 
				<?php
				if(isset($_POST['editAccount'])) echo "value='{$detailsLast}'";
				else echo "value='{$detailsLast}' readonly";
				?>
				>
			</td>
		</tr>
	</table>
	<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 30px; border-collapse: collapse;'>
		<tr>
			<td bgcolor='white' style='border: 2px solid black;' width="50%"><b>Contact #:</b>
				<br>
				<input type='text' name='updateContact' size='30%' 
				<?php
				if(isset($_POST['editAccount'])) echo "value='{$detailsContact}'";
				else echo "value='{$detailsContact}' readonly";
				?>
				>
			</td>
			<td bgcolor='white' style='border: 2px solid black;'><b>Birthday:</b>
				<br>
				<input type="date" name="updateBirth" size="30%" 
				<?php
				if(isset($_POST['editAccount'])) echo "value='{$detailsBirth}'";
				else echo "value='{$detailsBirth}' readonly";
				?>
				>				
			</td>
		</tr>
		<tr>
			<td bgcolor='white' style='border: 2px solid black;'><b>Email:</b>
				<br>
				<input type='text' name='updateEmail' size='30%' 
				<?php
				if(isset($_POST['editAccount'])) echo "value='{$detailsEmail}'";
				else echo "value='{$detailsEmail}' readonly";
				?>
				>
			</td>
			<td bgcolor='white' style='border: 2px solid black;'><b>Account Type:</b>
				<br>
				<?php
				if(!isset($_POST['editAccount']))
					echo "
					<input type='text' name='updateType' value='{$detailsType}'";
				else
				{
					echo "
					<select name='updateType' style='width: 40%;'s>
						<option ";
						if($detailsType=="Dispatcher") echo "selected";
						echo ">Dispatcher</option>";
						echo "<option ";
						if($detailsType=="Quality Controller") echo "selected";
						echo ">Quality Controller</option>";
						echo "<option ";
						if($detailsType=="Secretary") echo "selected";
						echo ">Secretary</option>";
						echo "<option ";
						if($detailsType=="Manager") echo "selected";
						echo "
						>Manager</option>
					</select>";
				}
				?>
			</td>
		</tr>
		<tr>
			<td bgcolor='white' style='border: 2px solid black;' colspan='2'><b>Address:</b>
				<br>
				<textarea name='updateAddress' style="width: 60%;" 
				<?php
				if(!isset($_POST['editAccount'])) echo "readonly";
				?>
				>
<?php
echo $detailsAddress;
?>
				</textarea>
			</td>
		</tr>
		<tr>
			<td bgcolor='white' style='border: 2px solid black;'
			<?php
			if(!isset($_POST['editAccount'])) echo "colspan='2'";
			?>
			><b>Username:</b>
				<br>
				<input type='text' name='updateUsername' size='30%' 
				<?php
				if(isset($_POST['editAccount'])) echo "value={$detailsUsername}";
				else echo "value={$detailsUsername} readonly";
				?>
				>
			</td>
			<?php
			if(isset($_POST['editAccount']))
				echo "
				<td bgcolor='white' style='border: 2px solid black;'><b>Password:</b>
				<br>
				<input type='password' name='updatePassword' size='30%'' value='{$detailsPassword}'>				
			</td>";
			?>
			<!--  -->
		</tr>
		<tr>
			<td bgcolor='white' colspan="2">
				<input type='submit' 
				<?php
				if(!isset($_POST['editAccount'])) echo "name='editAccount' value='Edit'";
				else echo "name='updateAccount' value='Update'";
				?>
				 class='button button5'>
			</td>
		</tr>
	</table>
</form>
<font size="2" color="#195905"><b>***NOTE: Please click edit button to change details.***</b></font>