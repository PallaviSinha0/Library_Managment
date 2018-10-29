<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>Paid Fines</title>

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





$sql = "SELECT b.cardid,firstname,lastname,sum(fineamt) as totalfineamt,paid FROM bookloans bl, fines f, borrower b where bl.loanid = f.loanid and bl.cardid = b.cardid  GROUP BY b.cardid  HAVING totalfineamt>0;";


$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
  echo "<br><br><br/>";

    
    
    	echo "<table border='1'>
	<tr><th>cardid</th>
	<th>firstname</th>	
	<th>lastname(s)</th>
	<th>totalfineamt</th>
	<th>1-paid/0-Not paid</th></tr>";
	while($row = mysqli_fetch_assoc($result)) {
	if($row["paid"]=='1'){    
    	echo "<tr><td>".$row["cardid"]."</td>
    			  <td>".$row["firstname"]."</td>
    			  <td>".$row["lastname"]."</td>
    			  <td>".$row["totalfineamt"]."</td><td>".$row["paid"]."</td></tr>"; 
    			}
    }


}else {    echo "No results"; }	


mysqli_close($con);
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>
