<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ALL Address</title>
<link rel="stylesheet" href="css/jquery-ui.css">
<script>

var id= $row['id'];
function myPopup2(id) {
	opener.location.href = 'address.php?id='+id ;
     close();
}
</script>
</head>
<?php

$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'sa';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username, $db_password);
mssql_select_db($db_name); 

$resualt=mssql_query("SELECT id,user_id,street FROM Address ") ;
echo "<table border='1' class='imagetable' width='300px'>\n";
echo '<tr>';
	echo '<th>User ID</th>';
	echo '<th>Street</th>';
	 echo '</tr>';
while ($row = mssql_fetch_assoc($resualt)) {
	
	 echo "<tr onClick='myPopup2($row[id])'>"."<td>{$row['user_id']}</td>\n"."<td>{$row['street']}</td>\n";
	 echo '</tr>'."\n";
}
echo "</table>\n";

?>
</html>