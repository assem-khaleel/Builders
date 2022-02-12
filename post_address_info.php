<?php
if(isset($_POST['idEmploye']))
{
$idEmploye=$_POST['idEmploye'];
}

$UserId=$_POST['userID'];
$streetName=$_POST['streetName'];
$quarter=$_POST['quarter'];
$mobileNumber=$_POST['mobileNumber'];
$email=$_POST['email'];
$fromDate=$_POST['fromDate'];
$toDate=$_POST['toDate'];
$notes=$_POST['notes'];


$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'root';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username,$db_password);
mssql_select_db($db_name); 




$result = mssql_query("SELECT id FROM Address WHERE id='$idEmploye'");
if(mssql_fetch_array($result) == true)
{
	mssql_query("UPDATE Address
 SET user_id='$UserId',street='$streetName',quarter='$quarter',Phone_number='$mobileNumber',email='$email',from_date='$fromDate',to_date='$toDate',other_info='$notes'
WHERE id='$idEmploye' ") or die(mssql_error()) ;
    echo '<script language="javascript">';
    echo 'alert("Successfully Update Address")';
    echo '</script>';
    echo "<script>setTimeout(\"location.href = 'address.php?id=$idEmploye';\",10);</script>";

	
	
	
}else
{
mssql_query("INSERT INTO Address ( user_id,street,quarter, Phone_number, email, from_date,to_date,other_info) VALUES ('$UserId', '$streetName', '$quarter','$mobileNumber', '$email', '$fromDate', '$toDate','$notes') ") or die(mssql_error()) ;
     echo '<script language="javascript">';
    echo 'alert("Successfully Add New Address")';
    echo '</script>';
    echo "<script>setTimeout(\"location.href = 'address.php';\",10);</script>";
}