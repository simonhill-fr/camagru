<div><h1>An error occured</h1></div>
<div><h2>

<?php 

if (isset($_GET["ernum"]))
{
	if ($_GET["ernum"] == "1")
		echo "Failed to connect to database";
	else if ($_GET["ernum"] == "2")
		echo "Filesystem Failure";
}

?>

</h2></div>