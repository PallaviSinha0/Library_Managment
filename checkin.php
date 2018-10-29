<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>CheckIn</title>

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
$database = "library";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}



$q=$_REQUEST['search'];


$sql = "SELECT bl.loanid, bl.isbn, bl.cardid, bl.dateout, bl.duedate, bl.datein, b.firstname, b.lastname FROM bookloans bl, borrower b where bl.cardid = b.cardid and ((bl.cardid like '%$q%') or (bl.isbn like '%$q%') or (b.firstname like '%$q%') or (b.lastname like '%$q%'));";


$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "</br></br><h3>Books to be Checked in Based on given Search</h3>";
	echo "<table border='1'>
	 	<tr><th>Loanid</th>
		<th>ISBN</th>	
		<th>CardID(s)</th>
		<th>First Name(s)</th>
		<th>Last Name(s)</th>
		<th>Date Out(s)</th>
		<th>DueDate(s)</th></tr>";

    while($row = mysqli_fetch_assoc($result)) {
    	$flag='0';
        if(is_null($row["datein"]))   {   
        	$flag='1';      	
				echo "<tr><td>".$row["loanid"]."</td><td>".$row["isbn"]."</td>
        		  <td>".$row["cardid"]."</td>
        		  <td>".$row["firstname"]."</td>
        		  <td>".$row["lastname"]."</td>
        		  <td>".$row["dateout"]."</td>
        		  <td>".$row["duedate"]."</td>
	<td>".'<form action="updatebookloans.php" method="POST"><input type="hidden" name= "name" value= '.$row["loanid"].' ><button type="submit">Check In</button></form>'."</td></tr>";}}
    
    }
 else {    echo "<br></br>No results found"; }





mysqli_close($con);
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>