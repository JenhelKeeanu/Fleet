<table style='width: 60%;' border='0'>
	<tr>
		<td width='32%' align='left' bgcolor='#d3d3d3'><b>Search By:</b> 
			<select id='affilsearch' name='vrrsearch' style='min-width: 150px;' onchange='searchaffil()'>
				<option>-Select-</option>
				<option value='affilName' 
				<?php if(isset($_GET['affil'])) if($_GET['affil']=="affilName") echo "selected"; ?>
				>Affiliate Name</option>
				<option value='affilBranch' 
				<?php if(isset($_GET['vrr'])) if($_GET['vrr']=="affilBranch") echo "selected"; ?>
				>Affiliate Branch</option>
			</select>
			<input type='text' id='iduser' hidden>
		</td>
		<form action='#' method='POST'>
		<?php if(isset($_GET['affil']))
		{
			if($_GET['affil']=="affilName") echo "
			<td width='20%' bgcolor='#d3d3d3'>
				<input type='text' name='recordAname' placeholder='Affiliate Name...' size='17px'>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='searchArecord' class='button button5' value='Search'>
			</td>";
			elseif($_GET['affil']=="affilBranch") echo "
			<td width='20%' bgcolor='#d3d3d3'>
				<input type='text' name='recordAbranch' placeholder='Affiliate Branch...' size='17px'>
			</td>
			<td bgcolor='#d3d3d3'>
				<input type='submit' name='searchArecord' class='button button5' value='Search'>
			</td>";
		}
		?>
		</form>
		<td align="right" bgcolor='#d3d3d3'>
		<?php
			if($_SESSION['Accounttype']=="Manager")
			{
				echo "<button class='button button5' id='showModal'>Add Affiliate</button>";
			}
			?>
		</td>
	</tr>
</table>
<?php
if(isset($_POST['searchArecord']))
{
	if(isset($_POST['recordAname']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='9' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'><h2><b>Affiliates Database</b><h2></td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Affiliates Name</b></td>
				<td align='center'><b>Affiliates Branch</b></td>
				<td align='center'><b>--</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM affiliates_database where Affiliates_Name LIKE '". $_POST['recordAname'] ."%'");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Affiliates_Name']}</td>
				<td align='center'>{$r['Branch']}</td>
				<td align='center'><a href='manager.php?aview={$r['Affiliates_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> ";
				if($_SESSION['Accounttype']=="Manager")
				{
					echo "| <a href='manager.php?deleteAffil={$r['Affiliates_ID']}' ";
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
	elseif(isset($_POST['recordAbranch']))
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='9' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'><h2>Affiliates Database<h2></td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Affiliates Name</b></td>
				<td align='center'><b>Affiliates Branch</b></td>
				<td align='center'><b>--</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM affiliates_database where Branch like '". $_POST['recordAbranch'] ."%'");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Affiliates_Name']}</td>
				<td align='center'>{$r['Branch']}</td>
				<td align='center'><a href='manager.php?aview={$r['Affiliates_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> | <a href='manager.php?deleteAffil={$r['Affiliates_ID']}' ";
				?>
				onclick="return confirm('Are you sure you want to delete this record?')"
				<?php
			echo " style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>
			</tr>";
		}
		echo "
		</table>";
	}
}
elseif(isset($_GET['affil']))
{
	if($_GET['affil']=="total")
	{
		echo "
		<table width='60%' class='tableVehicle'>
			<tr>
				<td align='center' colspan='9' style='background: linear-gradient(to bottom, #ff8c00, red 100%);
					border-top-left-radius: 15px;
					border-top-right-radius: 15px;'><h2>Affiliates Database<h2></td>
			</tr>
			<tr style='background-color: #778899;'>
				<td align='center'><b>Affiliates Name</b></td>
				<td align='center'><b>Affiliates Branch</b></td>
				<td align='center'><b>--</b></td>
			</tr>";
		include "data.php";
		$q=mysqli_query($con,"SELECT * FROM affiliates_database");
		while($r=mysqli_fetch_array($q))
		{
			echo "
			<tr>
				<td align='center'>{$r['Affiliates_Name']}</td>
				<td align='center'>{$r['Branch']}</td>
				<td align='center'><a href='manager.php?aview={$r['Affiliates_ID']}' style='color: black;'><i class='fa fa-edit' style='font-size:20px'></i></a> | <a href='manager.php?deleteAffil={$r['Affiliates_ID']}' ";
				?>
				onclick="return confirm('Are you sure you want to delete this record?')"
				<?php
			echo " style='color: black;'><i class='fa fa-trash' style='font-size:20px'></i></a></td>
			</tr>";
		}
		echo "
		</table>";
	}
}
?>
<div id="modalShow" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<form action="#" method="POST">
			<table class="tableVehicle" width="100%" border="0" cellpadding="10">
				<tr style="background-color: white;">
					<td align="center" colspan="2"><h3 style="color: #b22222;"><b>Add Affiliate Details</b></h3></td>
				</tr>
				<tr style="background-color: white;">
					<td align="right"><b>Affiliates Name:</b></td>
					<td><input type="text" name="addAname"></td>
				</tr>
				<tr style="background-color: white;">
					<td align="right"><b>Affiliates Branch:</b></td>
					<td><input type="text" name="addAbranch"></td>
				</tr>
				<tr style="background-color: white;">
					<td colspan="2"><input type="submit" name="saveAffiliate" class="button button5"></td>
				</tr>
			</table>
		</form>
	</div>
</div>