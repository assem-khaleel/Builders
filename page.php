<?php
$id=$_POST['id'];
$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'root';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username,$db_password);
mssql_select_db($db_name); 
$query=mssql_query("select * from user_info where id='$id'");
$result=mssql_fetch_assoc($query);

$json= array('id'=>$result['id'], 'name_ar'=>$result['name_ar'],'name_en'=>$result['name_en'],'address'=>$result['address'],'date_birth'=>$result['date_birth'],'date_join'=>$result['date_join'],'title_job'=>$result['title_job'],'gender'=>$result['gender'],'religion'=>$result['religion'],'other_info'=>$result['other_info']);
echo json_encode($json);
exit;

?>