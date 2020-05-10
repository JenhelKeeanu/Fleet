<form action='#' method='POST'>
	<table cellpadding="10" width='30%' border='0' bgcolor='white' style='margin: 60px; border-radius: 20px; border-collapse: collapse; border: 2px solid black;'>
		<tr style="background-color: white;">
			<td colspan="3" align="center"><h3 style="color: #b22222;"><b>Users Login Details</b></h3></td>
		</tr>
		<tr>
			<td bgcolor="#666666"><b style="color: white;">Account Name</b></td>
			<td bgcolor="#666666"><b style="color: white;">Log Date</b></td>
			<td bgcolor="#666666"><b style="color: white;">Log Time</b></td>
		</tr>
		<?php
		if (isset($_GET['page']))
		{
		    $pageno = $_GET['page'];
		} 
		else 
		{
		    $pageno = 1;
		}
		$numberPages = 10;
		$offset = ($pageno-1) * $numberPages;
		include "data.php";
		$page = mysqli_query($con,"SELECT * FROM log_database");
		$totalLogs = mysqli_num_rows($page);
		$totalLogs = $totalLogs/10;
		$totalLogs = ceil($totalLogs);
		$getLogs = mysqli_query($con,"SELECT * FROM log_database LIMIT $offset,10");
		while($showLogs=mysqli_fetch_array($getLogs))
		{
			echo "
			<tr>
				<td bgcolor='white'>{$showLogs['Log_User']}</td>
				<td bgcolor='white'>{$showLogs['Log_Date']}</td>
				<td bgcolor='white'>{$showLogs['Log_Time']}</td>
			</tr>";
		}
		//echo $totalLogs;
		// $Prev_Page = $_GET['page']-$_GET['page']+1;
		// $Next_Page = $_GET['page']-$_GET['page']+$totalLogs;
		$i = 1;
		if(isset($_GET['end']))
		{
			if($_GET['end']%5==0)
			{
				$i = $_GET['end']+1;
				$_SESSION['i'] = $_GET['end']+1;
			}
		}
		elseif(isset($_SESSION['i']))
		{
			if($_SESSION['i']<$_GET['page'])
			{
				$i = $_SESSION['i'];
			}
		}
		// if($end>$i)
		// {
		// 	$i = $end
		// }
		echo "
		<tr>
			<td colspan='3' bgcolor='white' align='center'>
				<a href='manager.php?page=1'><b><<</a> |</b> ";
				if($i>5)
				{
					$back = $i - 5;
					if($back==1) echo "<a href='manager.php?page=1'><b>...</a> |</b>";
					elseif(($back-1)%5==0)
					{
						$back = $back -1;
						echo "<a href='manager.php?end={$back}'><b>...</a> |</b>";
					}
				}
				for($i;$i<=$totalLogs;$i++)
				{
					echo "<a href='manager.php?page={$i}'><b>".$i."</a> |</b> ";
					if($i==$totalLogs) break;
					elseif($i%5==0)
					{
						echo "<a href='manager.php?end={$i}'><b>...</a> |</b> ";
						$end = $i;
						break;
					}
					// $end = $i;
				}
				echo "
				<a href='manager.php?page={$totalLogs}'><b> >></b></a>
			</td>
		</tr>";
		?>
	</table>
</form>
