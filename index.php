<?php
session_start();
$loginerror = 0;
if(isset($_POST['alogin']))
{
  $ctr=0;
  include "data.php";
  $Q=mysqli_query($con,"SELECT * FROM users_database WHERE Username ='". $_POST['usrnm'] ."' and Password='". $_POST['psw'] ."'");
  $N=mysqli_num_rows($Q);
  if($N>0)
  {
    while($R=mysqli_fetch_array($Q))
    {
      $dateToday = date("Y-m-d");
      $timeToday = date("h:i:sa");
      echo "<script>alert('Welcome user {$R['Last_Name']},{$R['First_Name']} {$R['Middle_Name']}');</script>";
      if($R['Account_Type']=="Manager")
      {
        $_SESSION['vrrNo'] = "0";
        $_SESSION['UserID']=$R['User_ID'];
        $_SESSION['Accounttype']=$R['Account_Type'];
        $_SESSION['Contact']=$R['Contact_No'];
        $_SESSION['Email']=$R['Email'];
        $_SESSION['Fullname']=$R['Last_Name'].", ".$R['First_Name']." ".$R['Middle_Name'];
        $_SESSION['updateCounter'] = 0;
        $pmsCount = mysqli_query($con,"SELECT * FROM vehicle_database WHERE PMS_End = '". $dateToday ."'");
        $_SESSION['PMS'] = mysqli_num_rows($pmsCount);
        $log = mysqli_query($con,"INSERT INTO log_database 
        (Log_User,
        Log_Date,
        Log_Time) VALUE 
        ('". $_SESSION['Fullname'] ."',
        '". $dateToday ."',
        '". $timeToday ."')");
        $_SESSION['security']=1;
        echo "<script>window.location.href='manager.php';</script>";
        mysqli_close();
      }
      elseif($R['Account_Type']=="Secretary")
      {
        $_SESSION['vrrNo'] = "0";
        $_SESSION['UserID']=$R['User_ID'];
        $_SESSION['Accounttype']=$R['Account_Type'];
        $_SESSION['Contact']=$R['Contact_No'];
        $_SESSION['Email']=$R['Email'];
        $_SESSION['Fullname']=$R['Last_Name'].", ".$R['First_Name']." ".$R['Middle_Name'];
        $_SESSION['updateCounter'] = 0;
        $pmsCount = mysqli_query($con,"SELECT * FROM vehicle_database WHERE PMS_End = '". $dateToday ."'");
        $_SESSION['PMS'] = mysqli_num_rows($pmsCount);
        $log = mysqli_query($con,"INSERT INTO log_database 
        (Log_User,
        Log_Date,
        Log_Time) VALUE 
        ('". $_SESSION['Fullname'] ."',
        '". $dateToday ."',
        '". $timeToday ."')");
        $_SESSION['security']=1;
        echo "<script>window.location.href='secretary.php';</script>";
        mysqli_close();

      }
      elseif($R['Account_Type']=="Dispatcher")
      {
        $_SESSION['vrrNo'] = "0";
        $_SESSION['UserID']=$R['User_ID'];
        $_SESSION['Accounttype']=$R['Account_Type'];
        $_SESSION['Contact']=$R['Contact_No'];
        $_SESSION['Email']=$R['Email'];
        $_SESSION['Fullname']=$R['Last_Name'].", ".$R['First_Name']." ".$R['Middle_Name'];
        $_SESSION['updateCounter'] = 0;
        $pmsCount = mysqli_query($con,"SELECT * FROM vehicle_database WHERE PMS_End = '". $dateToday ."'");
        $_SESSION['PMS'] = mysqli_num_rows($pmsCount);
        $log = mysqli_query($con,"INSERT INTO log_database 
        (Log_User,
        Log_Date,
        Log_Time) VALUE 
        ('". $_SESSION['Fullname'] ."',
        '". $dateToday ."',
        '". $timeToday ."')");
        $_SESSION['security']=1;
        echo "<script>window.location.href='dispatcher.php';</script>";
        mysqli_close(); 
      }
      elseif($R['Account_Type']=="Quality Controller")
      {
        $_SESSION['vrrNo'] = "0";
        $_SESSION['UserID']=$R['User_ID'];
        $_SESSION['Accounttype']=$R['Account_Type'];
        $_SESSION['Contact']=$R['Contact_No'];
        $_SESSION['Email']=$R['Email'];
        $_SESSION['Fullname']=$R['Last_Name'].", ".$R['First_Name']." ".$R['Middle_Name'];
        $_SESSION['updateCounter'] = 0;
        $pmsCount = mysqli_query($con,"SELECT * FROM vehicle_database WHERE PMS_End = '". $dateToday ."'");
        $_SESSION['PMS'] = mysqli_num_rows($pmsCount);
        $log = mysqli_query($con,"INSERT INTO log_database 
        (Log_User,
        Log_Date,
        Log_Time) VALUE 
        ('". $_SESSION['Fullname'] ."',
        '". $dateToday ."',
        '". $timeToday ."')");
        $_SESSION['security']=1;
        echo "<script>window.location.href='qualityControl.php';</script>";
        mysqli_close(); 
      }
      elseif($R['Account_Type']=="Billing")
      {
        $_SESSION['vrrNo'] = "0";
        $_SESSION['UserID']=$R['User_ID'];
        $_SESSION['Accounttype']=$R['Account_Type'];
        $_SESSION['Contact']=$R['Contact_No'];
        $_SESSION['Email']=$R['Email'];
        $_SESSION['Fullname']=$R['Last_Name'].", ".$R['First_Name']." ".$R['Middle_Name'];
        $_SESSION['updateCounter'] = 0;
        $pmsCount = mysqli_query($con,"SELECT * FROM vehicle_database WHERE PMS_End = '". $dateToday ."'");
        $_SESSION['PMS'] = mysqli_num_rows($pmsCount);
        $log = mysqli_query($con,"INSERT INTO log_database 
        (Log_User,
        Log_Date,
        Log_Time) VALUE 
        ('". $_SESSION['Fullname'] ."',
        '". $dateToday ."',
        '". $timeToday ."')");
        $_SESSION['security']=1;
        echo "<script>window.location.href='billing.php';</script>";
        mysqli_close(); 
      }
      elseif($R['Account_Type']=="Affiliate")
      {
        $_SESSION['vrrNo'] = "0";
        $_SESSION['UserID']=$R['User_ID'];
        $_SESSION['Accounttype']=$R['Account_Type'];
        $_SESSION['Contact']=$R['Contact_No'];
        $_SESSION['Email']=$R['Email'];
        $_SESSION['Fullname']=$R['Last_Name'].", ".$R['First_Name']." ".$R['Middle_Name'];
        $_SESSION['updateCounter'] = 0;
        $pmsCount = mysqli_query($con,"SELECT * FROM vehicle_database WHERE PMS_End = '". $dateToday ."'");
        $_SESSION['PMS'] = mysqli_num_rows($pmsCount);
        $log = mysqli_query($con,"INSERT INTO log_database 
        (Log_User,
        Log_Date,
        Log_Time) VALUE 
        ('". $_SESSION['Fullname'] ."',
        '". $dateToday ."',
        '". $timeToday ."')");
        $_SESSION['security']=1;
        echo "<script>window.location.href='affiliate.php';</script>";
        mysqli_close(); 
      }
    }
  }
  else
  {
    if(!isset($_GET['login'])) echo "<script>alert('Username/Password is invalid');window.location.href='index.php?error={$loginerror}';</script>";
    else
    {
      $eCounter = $_GET['login']+1;
      if($eCounter==3) echo "<script>alert('Login error limit reached!');window.location.href='google.com';</script>";
      echo "<script>alert('Username/Password is invalid');window.location.href='index.php?login={$eCounter}';</script>";
    }
  }
}
if(isset($_GET['error']))
{
  echo "<script>window.location.href='index.php?login=1';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
body{
	margin: 150px;	
  font-family: 'Times New Roman', Times, serif;   
}
	.parallax{
		background-image: url("hertzbg.png");
		background-attachment: fixed;
   
    background-repeat: no-repeat;
    background-size: cover;
	 /*background-repeat: no-repeat;
	background-size: cover;
	background-position: center;*/
    
    
	}
	.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: gray;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.btn:hover {
  opacity: 1;
}
::placeholder {
  color: black;
  }
</style>
<body class="parallax">
<form action="#" method="POST">
<center>
	<table width="30%" cellpadding=" 4" cellspacing="0">
    <tr>
      <td align="center" style="border-top: 4px solid red; border-left: 4px solid red; border-right: 4px solid red;">
        <h2><font style="color: white;">Fleet Monitoring System</font></h2>
      </td>
    </tr>
	 <tr>
			<td style="border-left: 4px solid red; border-right: 4px solid red;">
				<div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username..." name="usrnm" required style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; background-color: orange;">
  </div>
			</td>
		</tr>
		<tr>
			<td style="border-left: 4px solid red; border-right: 4px solid red;">
				<div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password..." name="psw" required style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; background-color: orange;">
  </div>
			</td>
		</tr>
		<tr>
			<td align="right" style="border-left: 4px solid red; border-right: 4px solid red; border-bottom: 4px solid red;">
				<input type="submit" name="alogin" style="background-color: black; color: white; height: 40px; width: 80px; border-radius: 8px;">
			</td>
		</tr>
	</table>
</center>
</form>
</body>
</html>