<?php
include "data.php";
$viewUser = mysqli_query($con,"SELECT * FROM users_database WHERE User_ID='". $_GET['view'] ."'");
while($showView = mysqli_fetch_array($viewUser))
{
	$_SESSION['updateU'] = $showView['Username'];
	echo "
	<h2 style='color: #b22222;'><b>ACCOUNT DETAILS</b></h2>
	<form action='#' method='POST'>
		<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 15px; border-collapse: collapse;'>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;'><b>First Name:</b>
					<br>
					<input type='text' name='saveFirst' size='20%' value='{$showView['First_Name']}' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">
				</td>
				<td bgcolor='white' style='border: 2px solid black;'><b>Middle Name:</b>
					<br>
					<input type='text' name='saveMiddle' size='20%' value='{$showView['Middle_Name']}' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">
				</td>
				<td bgcolor='white' style='border: 2px solid black;'><b>Last Name:</b>
					<br>
					<input type='text' name='saveLast' size='20%' value='{$showView['Last_Name']}' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">
				</td>
			</tr>
		</table>
		<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 30px; border-collapse: collapse;'>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;' width='50%'><b>Contact #:</b>
					<br>
					<input type='text' name='saveContact' size='30%' value='{$showView['Contact_No']}' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">
				</td>
				<td bgcolor='white' style='border: 2px solid black;'><b>Birthday:</b>
					<br>
					<input type='date' name='saveBirth' value='{$showView['Birthday']}' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">				
				</td>
			</tr>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;'><b>Email:</b>
					<br>
					<input type='text' name='saveEmail' size='30%' value='{$showView['Email']}' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">
				</td>
				<td bgcolor='white' style='border: 2px solid black;'><b>Account Type:</b>
					<br>";
					if(!isset($_POST['updateU'])) echo "<input type='text' size='30%' value='{$showView['Account_Type']}'>";
					else
					{
						echo "
						<select name='saveType' style='width: 40%;'>
							<option ";
						if($showView['Account_Type']=="Dispatcher") echo "selected";
						echo ">Dispatcher</option>
							<option ";
						if($showView['Account_Type']=="Quality Controller") echo "selected";
						echo ">Quality Controller</option>
							<option ";
						if($showView['Account_Type']=="Secretary") echo "selected";
						echo ">Secretary</option>
							<option ";
						if($showView['Account_Type']=="Manager") echo "selected";
						echo ">Manager</option>
						</select>";
					}
			echo "</td>
			</tr>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;' colspan='2'><b>Address:</b>
					<br>
					<textarea name='saveAddress' style='width: 60%;' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">{$showView['Address']}</textarea>
				</td>
			</tr>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;' ";
				if(!isset($_POST['updateU'])) echo "colspan='2'";
			echo "><b>Username:</b>
					<br>
					<input type='text' name='saveUsername' size='30%' value='{$showView['Username']}' ";
					if(!isset($_POST['updateU'])) echo "readonly";
				echo ">
				</td>";
				if(isset($_POST['updateU']))
				{
					echo "
					<td bgcolor='white' style='border: 2px solid black;'>
						<b>Password:</b>
						<br>
						<input type='password' name='savePassword' value='{$showView['Password']}'>
					</td>";
				}
		echo "</tr>
			<tr>
				<td bgcolor='white'>
					<input type='submit' class='button button5' ";
					if(!isset($_POST['updateU'])) echo "value='Update' name='updateU'>";
					else echo "value='Save' name='saveU'>";
				echo "
				</td>
				<td align='right' bgcolor='white'>
					<input type='submit' class='button button5' value='Back' name='backU'>
				</td>
			</tr>
		</table>
	</form>";
}
?>
<font size="2" color="#195905"><b>***NOTE: Please click update button to change details.***</b></font>

		
		
		
		