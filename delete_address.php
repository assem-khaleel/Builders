<?php
$idEmploye=$_GET['id'];


$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'sa';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username, $db_password);
mssql_select_db($db_name); 


mssql_query("DELETE FROM Address
WHERE id='$idEmploye' ; ") or die(mssql_error()) ;
    echo '<script language="javascript">';
    echo 'alert("successfully deleted ")';
    echo '</script>';
    echo "<script>setTimeout(\"location.href = 'address.php';\",10);</script>"; 

?>