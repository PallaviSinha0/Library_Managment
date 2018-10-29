<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>Update Book loan</title>

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
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$database = "library";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}



$q=$_REQUEST['name'];
$loanid= $q;
$sql = "SELECT isbn FROM bookloans where loanid='$loanid';";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$isbn=$row[isbn];

$up1 = mysqli_query($con,"UPDATE bookloans SET datein = current_date() WHERE loanid = $loanid");
$sq4 = mysqli_query($con,"UPDATE book SET availability='1' WHERE isbn='$isbn'");
echo "<h4><br></br><br></br>Book Checked in successful for isbn : {$isbn}</h4>";

mysqli_close($con);
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>