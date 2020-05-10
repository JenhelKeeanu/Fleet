<?php

$user=$_POST['user'];

$pwd=$_POST['pwd'];

// now this data can be used for any function.

//One can even add this to database.

//We will just echo the data.

echo "username=".$user."password=".$pwd;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>


<input type="text" placeholder="username" id="uname" />

<input type="password" placeholder="passowrd" id="pwd" />

<button onclick="testing()">Submit</button>
<script>
	function testing(){
		document.getElementById("uname").value = "testing";
	}
	function submit_form(){
		document.
// $("#uname").val() = "test";
// var data1=$("#uname").val();

// var data2=$("#pwd").val();

// var dataTosend='user='+data1+'&pwd='+data2;

// $.ajax({

// url: 'test.php',

// method: 'POST',

// data:dataTosend,

// async: true,

// success: function (data) {

// alert(data)

// },

// });
}
</script>
</body>
</html>