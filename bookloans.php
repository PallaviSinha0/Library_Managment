<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>BookLoan</title>

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



$q=$_REQUEST['search'];
$sql = "SELECT * FROM borrower WHERE cardid='$q'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $cardid=$row["cardid"];
 } else {    echo "<br/><br/>Invalid CardID"; }

$isbn=$_SESSION["isbn"];


$sq2 = "SELECT count(*) AS countLoanBooks FROM bookloans bl WHERE bl.cardid = $cardid AND datein is NULL AND dateout IS NOT NULL";
$result2 = mysqli_query($con, $sq2);
if (mysqli_num_rows($result2) > 0) {
    $row = mysqli_fetch_assoc($result2);
    $countLoanBooks=$row["countLoanBooks"];
    if($countLoanBooks>2)
    	{ echo "</br></br>Maximum Book Limit Reached(Max 3 Books per CardID)";
    		   }
    else
    {

    $r = mysqli_query($con,"SELECT max(loanid) AS maxLoanID FROM bookloans");
	$maxLoanIDRow =  mysqli_fetch_array($r);
	$maxLoanID = $maxLoanIDRow['maxLoanID'];
	$loanID = $maxLoanID + 1;
	$sq3 = mysqli_query($con,"INSERT INTO bookloans VALUES ($loanID,'$isbn',$cardid,NOW(),DATE_ADD(NOW(), INTERVAL 14 DAY),null)");
	$sq4 = mysqli_query($con,"UPDATE book SET availability='0' WHERE isbn='$isbn'");

	echo "<h4><br/><br/>Book Check Out Successful</h4>";
    }	


 } else {    echo "<br/><br/><br/>Invalid CardID"; }

?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>
