
<?php
// Grab User submitted information
$user = $_POST["username"];
$pass = $_POST["password"];

// Connect to the database
$con = mssql_connect("MOHAMMAD-PC\SQL2005","sa","123321");
// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mssql_select_db("db_test",$con);

$result = mssql_query("SELECT username, password FROM login WHERE username = '$user' and  password = '$pass'");

$row = mssql_fetch_array($result);

if($row["username"]==$user && $row["password"]==$pass)
{
    header("Location: new_user.php");
}
else
{
    echo '<script language="javascript">';
    echo 'alert("Login Failed")';
    echo '</script>';
    echo "<script>setTimeout(\"location.href = 'login.php';\",10);</script>";
}



?>
