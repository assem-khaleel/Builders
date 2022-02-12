<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/jquery-1.10.2.js"></script>
<script>
  

function getname()
{
var id=$("#id").val();    // get the id from textbox
$.ajax({
        type:"post",
        dataType:"text",
        data:"id="+id,
        url:"page.php",   // url of php page where you are writing the query
        success:function(json)
        { 
            $("#name").val(json);   // setting the result from page as value of name field
           
        }
        });

}
</script>
</head>

<body>
<input type="text" name="id" id="id" tabindex="1" onkeypress="getname()">
<input type="text" name="name" id="name" tabindex="1"/>


</body>
</html>
<?php
$id=$_POST['id'];
$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'sa';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host, $db_username, $db_password);
mssql_select_db($db_name); 
$query=mssql_query("select * from user_info where id='$id'");
$result=mssql_fetch_assoc($query);

echo "{$result['id']}"."{$result['name_ar']}";    // echo the name to js function
exit;

?>