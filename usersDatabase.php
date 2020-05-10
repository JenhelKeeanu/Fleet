<table style='width: 60%;' border='0'>
	<tr>
		<td width='32%' align='left' bgcolor='#d3d3d3'><b>Search By:</b> 
			<select id='usersearch' style='min-width: 150px;' onchange='searchuser()'>
				<option>-Select-</option>
				<option value='userName' 
				<?php if(isset($_GET['users'])) if($_GET['users']=="userName") echo "selected"; ?>
				>Username</option>
				<option value='firstName' 
				<?php if(isset($_GET['users'])) if($_GET['users']=="firstName") echo "selected"; ?>
				>First Name</option>
				<option value='lastName' 
				<?php if(isset($_GET['users'])) if($_GET['users']=="lastName") echo "selected"; ?>
				>Last Name</option>
				<option value='accountType' 
				<?php if(isset($_GET['users'])) if($_GET['users']=="accountType") echo "selected"; ?>
				>Account Type</option>
			</select>
		</td>
			<form action='#' method='POST'>
				<?php
				if($_GET['users']=="userName") echo "
				<td width='20%' bgcolor='#d3d3d3'>
					<input type='text' name='searchUname' placeholder='Username...'>
				</td>
				<td bgcolor='#d3d3d3'>
					<input type='submit' name='usersRecord' class='button button5' value='Search'>
				</td>";
				elseif($_GET['users']=="firstName") echo "
				<td width='20%' bgcolor='#d3d3d3'>
					<input type='text' name='searchFirstname' placeholder='First Name...'>
				</td>
				<td bgcolor='#d3d3d3'>
					<input type='submit' name='usersRecord' class='button button5' value='Search'>
				</td>";
				elseif($_GET['users']=="lastName") echo "
				<td width='20%' bgcolor='#d3d3d3'>
					<input type='text' name='searchLastname' placeholder='Last Name...'>
				</td>
				<td bgcolor='#d3d3d3'>
					<input type='submit' name='usersRecord' class='button button5' value='Search'>
				</td>";
				elseif($_GET['users']=="accountType") echo "
				<td width='20%' bgcolor='#d3d3d3'>
					<select name='searchAtype'>
						<option>Dispatcher</option>
						<option>Quality Controller</option>
						<option>Secretary</option>
						<option>Manager</option>
					</select>
				</td>
				<td bgcolor='#d3d3d3'>
					<input type='submit' name='usersRecord' class='button button5' value='Search'>
				</td>";
				?>
			</form>
		<td align='right' bgcolor='#d3d3d3'>
			<button class="button button5" id="showModal">Add User</button>
		</td>
	</tr>
</table>
<?php
if(isset($_POST['usersRecord']))
{
	if(isset($_POST['searchUname']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Users Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Username</b></td>
				<td align='center'><b>Full Name</b></td>
				<td align='center'><b>Account Type</b></td>
				<td align='center'><b>--</b></td>
			</tr>";
		include "data.php";
		$x = 0;
		$q=mysqli_query($con,"SELECT * FROM users_database where Username LIKE '". $_POST['searchUname'] ."%' AND Account_Type != 'Manager'");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>			
				<td align='center'>{$r['Username']}</td>
				<td align='center'>{$r['Last_Name']}, {$r['First_Name']} {$r['Middle_Name']}</td>
				<td align='center'>{$r['Account_Type']}</td>
				<td align='center'><a href='manager.php?view={$r['User_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px;'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "| <a href='manager.php?deleteUser={$r['User_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?')"
					<?php
					echo " style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a>";
				}
				echo "</td>	
			</tr>";
		}
		echo "
		</table>";
	}
	if(isset($_POST['searchFirstname']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>User Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Username</b></td>
				<td align='center'><b>Full Name</b></td>
				<td align='center'><b>Account Type</b></td>
				<td align='center'>--</td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM users_database where First_Name LIKE '". $_POST['searchFirstname'] ."%' AND Account_Type != 'Manager'");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Username']}</td>
				<td align='center'>{$r['Last_Name']}, {$r['First_Name']} {$r['Middle_Name']}</td>
				<td align='center'>{$r['Account_Type']}</td>
				<td align='center'><a href='manager.php?view={$r['User_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "| <a href='manager.php?deleteUser={$r['User_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?')"
					<?php
					echo " style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a>";
				}
				echo "
				</td>
			</tr>";
		}
		echo "
		</table>";
	}
	if(isset($_POST['searchLastname']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Users Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Username</b></td>
				<td align='center'><b>Full Name</b></td>
				<td align='center'><b>Account Type</b></td>
				<td align='center'>--</td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM users_database where Last_Name LIKE '". $_POST['searchLastname'] ."%' AND Account_Type != 'Manager'");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Username']}</td>
				<td align='center'>{$r['Last_Name']}, {$r['First_Name']} {$r['Middle_Name']}</td>
				<td align='center'>{$r['Account_Type']}</td>
				<td align='center'><a href='manager.php?view={$r['User_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "| <a href='manager.php?deleteUser={$r['User_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?')"
					<?php
					echo " style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a>";
				}

				echo "
				</td>
			</tr>";
		}
		echo "
		</table>";
	}
	if(isset($_POST['searchAtype']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Users Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Username</b></td>
				<td align='center'><b>Full Name</b></td>
				<td align='center'><b>Account Type</b></td>
				<td align='center'>--</td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM users_database where Account_Type ='". $_POST['searchAtype'] ."' AND Account_Type != 'Manager'");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Username']}</td>
				<td align='center'>{$r['Last_Name']}, {$r['First_Name']} {$r['Middle_Name']}</td>
				<td align='center'>{$r['Account_Type']}</td>
				<td align='center'><a href='manager.php?view={$r['User_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "| <a href='manager.php?deleteUser={$r['User_ID']}' ";
					?>
					onclick="return confirm('Are you sure you want to delete this record?')"
					<?php
					echo " style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a>";
				}

				echo "
				</td>
			</tr>";
		}
		echo "
		</table>";
	}
}
elseif($_GET['users']=="total")
{
	echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='6' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'>
					<h2><b>Users Database</b><h2>
				</td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Username</b></td>
				<td align='center'><b>Full Name</b></td>
				<td align='center'><b>Account Type</b></td>
				<td align='center'>--</td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM users_database");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Username']}</td>
				<td align='center'>{$r['Last_Name']}, {$r['First_Name']} {$r['Middle_Name']}</td>
				<td align='center'>{$r['Account_Type']}</td>
				<td align='center'>";
				if($r['Account_Type']!="Manager")
				{
					echo "<a href='manager.php?view={$r['User_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
					if($_SESSION['Accounttype']=="Manager")
					{
						echo "| <a href='manager.php?deleteUser={$r['User_ID']}' ";
						?>
						onclick="return confirm('Are you sure you want to delete this record?')"
						<?php
						echo " style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a>";
					}
				}
			echo "</td>
			</tr>";
		}
		echo "
		</table>";
}
?>
<div id="modalShow" class="modal">
	<div class="modal-user">
		<span class="close">&times;</span>
		<h3 style="color: #b22222;"><b>Add New User Account</b></h3>
		<form action='#' method='POST'>
			<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 20px; border-collapse: collapse;'>
				<tr>
					<td bgcolor='white' style='border: 2px solid black;'><b>First Name:</b>
						<br>
						<input type='text' name='saveFirst' size='18%' required>
					</td>
					<td bgcolor='white' style='border: 2px solid black;'><b>Middle Name:</b>
						<br>
						<input type="text" name="saveMiddle" size='18%' required>
					</td>
					<td bgcolor='white' style='border: 2px solid black;'><b>Last Name:</b>
						<br>
						<input type="text" name="saveLast" size='18%' required>
					</td>
				</tr>
			</table>
			<table cellpadding='10' width='60%' border='0' bgcolor='white' style='margin: 30px; border-collapse: collapse;'>
				<tr>
					<td bgcolor='white' style='border: 2px solid black;'><b>Contact #:</b>
						<br>
						<input type='text' name='saveContact' size='30%' required>
					</td>
					<td bgcolor='white' style='border: 2px solid black;'><b>Birthday:</b>
						<br>
						<input type="date" name="saveBirth" size="30%" required>				
					</td>
				</tr>
				<tr>
					<td bgcolor='white' style='border: 2px solid black;'><b>Email:</b>
						<br>
						<input type='text' name='saveEmail' size='30%' required>
					</td>
					<td bgcolor='white' style='border: 2px solid black;'><b>Account Type:</b>
						<br>
						<select name='saveType' style="width: 40%;" required>
							<option>-select-</option>
							<option>Dispatcher</option>
							<option>Quality Controller</option>
							<option>Secretary</option>
							<option>Manager</option>
						</select>
					</td>
				</tr>
				<tr>
					<td bgcolor='white' style='border: 2px solid black;' colspan='2'><b>Address:</b>
						<br>
						<textarea name='saveAddress' style="width: 60%;" required></textarea>
					</td>
				</tr>
				<tr>
					<td bgcolor='white' style='border: 2px solid black;'><b>Username:</b>
						<br>
						<input type='text' name='saveUsername' size='30%' required>
					</td>
					<td bgcolor='white' style='border: 2px solid black;'><b>Password:</b>
						<br>
						<input type="password" name="savePassword" size="30%" required>				
					</td>
				</tr>
				<tr>
					<td bgcolor='white'><input type='submit' name='saveAccount' class='button button5' value='Save'></td>
		</form>
		<form action="#" method="POST">
					<td align='right' bgcolor='white'><input type='submit' name='backU' class='button button5' value='Back'></td>
				</tr>
			</table>
		</form>
	</div>
</div>