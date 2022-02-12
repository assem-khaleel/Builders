<?php

$id=$_POST['userID'];
$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'sa';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username, $db_password);
mssql_select_db($db_name); 
$query=mssql_query("select * from address where user_id='$id'");
while($result=mssql_fetch_assoc($query))
{
   $json[]= array(
                  'id'=>$result['id'],
                  'user_id'=>$result['user_id'],
                  'street'=>$result['street'],
                  'quarter'=>$result['quarter'],
				  'from_date'=>$result['from_date'],
                  'to_date'=>$result['to_date'],
				  'other_info'=>$result['other_info'],
  );
}

echo json_encode($json);
exit;

?>