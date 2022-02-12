<?php
$idEmploye=$_POST['idEmploye'];
$nameArabic=$_POST['nameArabic'];
$nameEnglish=$_POST['nameEnglish'];
$address=$_POST['address'];
$dateBirth=$_POST['dateBirth'];
$dateJoin=$_POST['dateJoin'];
$jobTitle=$_POST['jobTitle'];
$gender=$_POST['gender'];
$religion=$_POST['religion'];
$notes=$_POST['notes'];

$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'root';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username,$db_password);
mssql_select_db($db_name); 
$result = mssql_query("SELECT id FROM user_info WHERE id='$idEmploye'");
if(mssql_fetch_array($result) == true)
{
       mssql_query("UPDATE user_info
 SET name_ar='$nameArabic',                   name_en='$nameEnglish',address='$address',date_birth='$dateBirth',date_join='$dateJoin',title_job='$jobTitle',gender='$gender',religion='$religion',other_info='$notes'
WHERE id='$idEmploye' ") or die(mssql_error()) ;
    echo '<script language="javascript">';
    echo 'alert("Successfully Update User")';
    echo '</script>';
    echo "<script>setTimeout(\"location.href = 'new_user.php?id=$idEmploye';\",10);</script>";

    
}else
{
	mssql_query("INSERT INTO user_info (id, name_ar, name_en,address, date_birth, date_join, title_job,gender,religion,other_info) VALUES ('$idEmploye', '$nameArabic', '$nameEnglish','$address', '$dateBirth', '$dateJoin', '$jobTitle','$gender' ,'$religion','$notes') ") or die(mssql_error()) ;
     echo '<script language="javascript">';
    echo 'alert("Successfully Add New User")';
    echo '</script>';
    echo "<script>setTimeout(\"location.href = 'new_user.php?id=$idEmploye';\",10);</script>";
}

?>