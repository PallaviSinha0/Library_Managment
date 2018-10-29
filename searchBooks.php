<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>Search</title>
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
$sql = "SELECT b.isbn,b.title, name, availability FROM book b, bookauthors ba, authors a where b.isbn = ba.isbn and ba.authorid = a.authorid and 
((title like '%$q%') or (name like '%$q%') or (b.isbn like '%$q%'))";


$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<br/>";
 echo "<table border='1'>
 	<tr><th>ISBN</th>
	<th>Title</th>	
	<th>Author(s)</th>
	<th>Avalability</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        if($row["availability"]=='1'){         
        echo "<tr><td>".$row["isbn"]."</td><td>".$row["title"]."</td><td>".$row["name"]."</td><td>".$row["availability"]."</td><td>".
        '<form action="checkout.php" method="POST"><input type="hidden" name= "name" value= '.$row["isbn"].' ><button type="submit">Check Out</button></form>'."</td></tr>";
    
        }

        else{
			echo "<tr><td>".$row["isbn"]."</td><td>".$row["title"]."</td><td>".$row["name"]."</td><td>".$row["availability"]."</td><td>".'<input type="hidden" name="name" value="Not Available" ><button type="fail">Not Available</button>'."</td></tr>";
        
            
        }
    }

} else {    echo "<br/><br/><br/>No results"; }




mysqli_close($con);
?>
<div class="footer">
	<h3 align="center"></hr>Copyright &copy; Pallavi Sinha</h3>

</div>
</body>
</html>