<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>Borrower</title>

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
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$ssn= $_POST["ssn"]; 

$firstname= $_POST["firstname"]; 

$lastname= $_POST["lastname"]; 

$email= $_POST["email"]; 

$address= $_POST["address"]; 

$city= $_POST["city"]; 

$state=$_POST["state"];

$phone=$_POST["phone"];



if(strlen($ssn)==0 || strlen($firstname)==0 ||strlen($lastname)==0  || strlen($email)==0 || strlen($address)==0 || strlen($city)==0 || strlen($state)==0 || strlen($phone)==0)

{echo "</br></br>please complete all required details";}else{

if(strlen($ssn)==9){
    $ssn1 = substr($ssn, 0, 3);
$ssn2 = substr($ssn, 3, 2);  
$ssn3 = substr($ssn, 5, 4);
$ssn= "{$ssn1}-{$ssn2}-{$ssn3}";
}
else{echo "SSN length should be exactly 9 digits";
    exit();}


$sqc = "SELECT * FROM borrower where ssn='$ssn';";
$result = $conn->query($sqc);
if ($result->num_rows > 0) {
    echo "</br></br>Borrower with same SSN exits in DataBase";
    exit();}
else {

$sql="INSERT INTO borrower(ssn,firstname, lastname, email, address, city, state, phone) 
VALUES ('$ssn','$firstname','$lastname','$email','$address','$city','$state','$phone');";

if ($conn->query($sql) === TRUE) {
    echo "</br></br>New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

}
$conn->close();
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>
