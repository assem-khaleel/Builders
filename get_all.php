<head>
<head>
<link rel="stylesheet" href="css/jquery-ui.css">
</head>
<script>

var id= $row['id'];
function myPopup2(id) {
	opener.location.href = 'new_user.php?id='+id ;
     close();
}

</script>

</head>
<?php

$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'root';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username,$db_password);
mssql_select_db($db_name); 

$resualt=mssql_query("SELECT id,name_en FROM user_info ") ;
echo "<b>User Information</b>";
echo "<table border='1' class='imagetable' width='200px'>\n";
echo '<thead>'.'<tr>';
	echo '<th>ID</th>';
	echo '<th>Name</th>';
	 echo '</tr>'.'</thead>';
while ($row = mssql_fetch_assoc($resualt)) {
	 echo "<tr onClick='myPopup2($row[id])'><td>{$row['id']}</td>\n"."<td>{$row['name_en']} </td>\n";
	 echo '</tr>'."\n";
}
echo "</table>\n";
echo "</br>\n";

?>



