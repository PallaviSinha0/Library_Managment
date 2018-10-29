<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>Checkout</title>

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
$_SESSION["isbn"] = $q;
$sql = "SELECT b.isbn,b.title, name, availability FROM book b, bookauthors ba, authors a where b.isbn = ba.isbn and ba.authorid = a.authorid and ((title like '%$q%') or (name like '%$q%') or (b.isbn like '%$q%'))";


$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

	
echo "</br></br></br>Recheck the book name and continue</br></br>";
echo "<table border='1'>
 	<tr><th>ISBN</th>
	<th>Title</th></tr>";

echo "<tr><td>".$row["isbn"]."</td><td>".$row["title"]."</td></tr>";
echo "</table>";
echo "</br></br></br></br>Enter Borrower Cardid:".'<div id="menu"> <form action="bookloans.php"  method="post"><input type="search"  name="search" id="search"><input type="submit" value="Check out"/>	';

mysqli_close($con);
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>