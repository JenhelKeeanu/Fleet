<?php
include "data.php";
$affilView = mysqli_query($con,"SELECT * FROM affiliates_database WHERE Affiliates_ID='". $_GET['aview'] ."'");
while($showAffil = mysqli_fetch_array($affilView))
{
	$_SESSION['updateN'] = $showAffil['Affiliates_Name'];
	$_SESSION['updateB'] = $showAffil['Branch'];
	echo "
	<form action='#' method='POST'>
		<table cellspacing='10' width='35%' border='0' bgcolor='white' style='margin: 60px; border-radius: 20px;'>
			<tr style='background-color: white;'>
					<td align='center' colspan='2'><h3 style='color: #b22222;'><b>AFFILIATE DETAILS</b></h3></td>
				</tr>
			<tr>
				<td bgcolor='white'><b>Affiliates Name:</b></td>
				<td bgcolor='white'><input type='text' name='updateAname' size='30%' value='{$showAffil['Affiliates_Name']}' ";
				if(!isset($_POST['updateAffil'])) echo "readonly";
			echo "></td>
			</tr>
			<tr>
				<td bgcolor='white'><b>Affiliates Branch:</b></td>
				<td bgcolor='white'><input type='text' name='updateAbranch' size='30%' value='{$showAffil['Branch']}' ";
				if(!isset($_POST['updateAffil'])) echo "readonly";
			echo "></td>
			</tr>
			<tr>";
			if(!isset($_POST['updateAffil'])) echo "<td bgcolor='white'><input type='submit' name='updateAffil' class='button button5' value='Update'></td>";
			else echo "<td bgcolor='white'><input type='submit' name='saveAffil' class='button button5' value='Save'></td>";
			echo "
				<td align='right' bgcolor='white'><input type='submit' name='backA' class='button button5' value='Back'></td>
			</tr>
		</table>
	</form>";
}
?>
<font size="2" color="#195905"><b>***NOTE: Please click update button to change details.***</b></font>

		
		
		
		
		