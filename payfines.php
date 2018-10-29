<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>PayFines</title>
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

//echo "Fine payment will be done only for books which are Checked IN</br></br>";
$sql = "SELECT b.cardid,firstname,lastname,sum(fineamt) as total, datein, paid FROM bookloans bl, fines f, borrower b where bl.loanid = f.loanid and bl.cardid = b.cardid  and b.cardid='$q' and paid=0 and datein is not null GROUP BY b.cardid HAVING total>0;";


$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0) {
    $flag=0;
    // output data of each row
  

  echo "<table border='1'>
    <th>cardid</th>
    <th>firstname</th>  
    <th>lastname(s)</th>
    <th>totalfineamt</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        	
	if($row["paid"]=='0'){    
    	echo "<tr><td>".$row["cardid"]."</td>
    			  <td>".$row["firstname"]."</td>
    			  <td>".$row["lastname"]."</td>
    			  <td>".$row["total"]."</td>
    			  <td>".'<form action="payment.php" method="POST"><input type="hidden" name= "name" value= '.$q.' ><button type="submit">Pay Fine</button></form>'."</td></tr>";
                 
    			}
    }
}

else {    echo "<br></br><br></br>Please Check In Books to pay fine"; }	



$sq2 = "SELECT f.loanid,b.cardid,firstname,lastname,fineamt, datein, paid FROM bookloans bl, fines f, borrower b where bl.loanid = f.loanid and bl.cardid = b.cardid  and b.cardid='$q' and paid=0 HAVING fineamt>0;";


$result2 = mysqli_query($con, $sq2);


if (mysqli_num_rows($result2) > 0) {
	
    $flag=0;
    // output data of each row
  
  echo "<table border='1'>
    <tr><th>Loanid</th>
    <th>cardid</th>
    <th>firstname</th>  
    <th>lastname(s)</th>
    <th>fineamt</th>
    <th>datein</th>
    <th>1-paid/0-Not paid</th></tr>";
    while($row2 = mysqli_fetch_assoc($result2)) {
        	
	if($row2["paid"]=='0'){    
    	echo "<tr><td>".$row2["loanid"]."</td>
    	<td>".$row2["cardid"]."</td>
    			  <td>".$row2["firstname"]."</td>
    			  <td>".$row2["lastname"]."</td>
    			  <td>".$row2["fineamt"]."</td><td>".$row2["datein"]."</td><td>".$row2["paid"]."</td></tr>";
                 
    			}


    }

}

mysqli_close($con);
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>