<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>Update Fines</title>

</head>
<body>
<header>
	<h1 align="center">Library Management System</h1>
</header>
<div id="header">
	<ul id="navbar">
	<li><a href='index.html'> Home </a></li>
	</ul>
</br>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "library";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 


$sql="SELECT  loanid, TIMESTAMPDIFF(Day, duedate, datein)*0.25 AS fine FROM bookloans WHERE datein IS NOT NULL  and current_date > duedate; ";
$result=mysqli_query($con,$sql);
$flag='0';
if(mysqli_num_rows($result)>0){
	
	$flag='1';
	while($row=mysqli_fetch_array($result)){
		$loan=$row["loanid"];
		$fine=$row["fine"];
		$sql1="select loanid from fines where loanid=$loan and paid=0;";
		$result1=mysqli_query($con,$sql1);
		if(mysqli_num_rows($result1)>0)	{
			$sql2="update fines set fineamt=$fine where loanid=$loan and paid=0;";
			$result2=mysqli_query($con,$sql2);
		}
		else{
			$sql3="insert into fines (fineamt,loanid) values('$fine','$loan');";
			$result3=mysqli_query($con,$sql3);			
		}

	}
	   
	
}

$sql4="SELECT loanid, TIMESTAMPDIFF(Day, duedate,current_date)*0.25 as fine FROM bookloans where current_date > duedate and datein is NULL;";
$result4=mysqli_query($con,$sql4);
if(mysqli_num_rows($result4)>0){
		$flag='1';
		while($row2=mysqli_fetch_array($result4)){
		$loan=$row2["loanid"];
		$fine=$row2["fine"];
		
		$sql5="select loanid from fines where loanid=$loan and paid=0;";
		$result5=mysqli_query($con,$sql5);
		if(mysqli_num_rows($result5)>0)	{
			
			$sql6="update fines set fineamt=$fine where loanid=$loan and paid=0;";
			$result6=mysqli_query($con,$sql6);
		}
		else{
			
			$sql7="insert into fines (fineamt,loanid) values('$fine','$loan');";
			$result7=mysqli_query($con,$sql7);			
		}

	}
	
	
}
if($flag=='1')
{echo "</br></br></br>Fines for each record have been updated";
}
else{
	echo "<br></br><br></br>There is nothing to update";
}

mysqli_close($con);
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>