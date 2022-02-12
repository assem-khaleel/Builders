<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/jquery-1.10.2.js"></script>
<script>
  $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
  if(e.which == 13) {
    e.preventDefault();
    return false;
  }
});
function getname()
{
var id=$("#id").val();    // get the id from textbox
$.ajax({
        type:"post",
        dataType:"json",
        data:"id="+id,
        url:"page.php",   // url of php page where you are writing the query
        success:function(json)
        { 
           // $("#name").val(json);   // setting the result from page as value of name field
			//console.log(json)
             
           $("#userId").val(json.id); 
		   $("#userName").val(json.name_ar);   
        }
        });

}
</script>
</head>

<body>
<form name="frmNew"  id="frmNew" action="post_info.php" method="post">

<input type="text" name="id" id="id" tabindex="1" onKeyPress="getname()">
<input type="text" name="userId" id="userId" />
<input type="text" name="userName" id="userName" />
<input name="save" class='button-link' type="Submit" value="submit" />

</form>



</body>
</html>