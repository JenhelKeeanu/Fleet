<?php
include "data.php";
$viewUser = mysqli_query($con,"SELECT * FROM users_database WHERE User_ID='". $_GET['view'] ."'");
while($showView = mysqli_fetch_array($viewUser))
{
	echo "
	<form action='#' method='POST'>
		<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 20px; border-collapse: collapse;'>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;'>First Name:
					<br>
					<input type='text' name='saveFirst' size='20%' value='{$showView['First_Name']}'>
				</td>
				<td bgcolor='white' style='border: 2px solid black;'>Middle Name:
					<br>
					<input type='text' name='saveMiddle' size='20%' value='{$showView['Middle_Name']}'>
				</td>
				<td bgcolor='white' style='border: 2px solid black;'>Last Name:
					<br>
					<input type='text' name='saveLast' size='20%' value='{$showView['Last_Name']}'>
				</td>
			</tr>
		</table>
	</form>
	<form action='#' method='POST'>
		<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 60px; border-collapse: collapse;'>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;'>Contact #:
					<br>
					<input type='text' name='saveContact' size='30%' value='{$showView['Contact_No']}'>
				</td>
				<td bgcolor='white' style='border: 2px solid black;'>Birthday:
					<br>
					<input type='date' name='saveBirth' value='{$showView['Birthday']}'>				
				</td>
			</tr>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;'>Email:
					<br>
					<input type='text' name='saveEmail' size='30%' value='{$showView['Email']}'>
				</td>
				<td bgcolor='white' style='border: 2px solid black;'>Account Type:
					<br>
					<select name='saveType' style='width: 40%;'>
						<option>-select-</option>
						<option>Dispatcher</option>
						<option>Quality Controller</option>
						<option>Secretary</option>
						<option>Manager</option>
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;' colspan='2'>Address:
					<br>
					<textarea name='saveAddress' style='width: 60%;''>{$showView['Address']}</textarea>
				</td>
			</tr>
			<tr>
				<td bgcolor='white' style='border: 2px solid black;'>Username:
					<br>
					<input type='text' name='saveUsername' size='30%' value='{$showView['Username']}'>
				</td>
				<td bgcolor='white' style='border: 2px solid black;'>Password:
					<br>
					<input type='password' name='savePassword' size='30%' value='{$showView['Password']}'>				
				</td>
			</tr>
			<tr>
				<td bgcolor='white'><input type='submit' name='saveAccount' class='button button5' value='Save'></td>
				<td align='right' bgcolor='white'><input type='submit' name='backU' class='button button5' value='Back'></td>
			</tr>
		</table>
	</form>";
}
?>

		
		
		
		