<?php $intMenuId=2; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Address Page</title>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  
  <script type="text/javascript">
   var id= $row['id'];
   function myPopup(id) {
	   if(id){
	   location.href = "address.php?id="+id;
	//window.open( "address.php?id="+id, "sameWindow" )
	}
	
	   }

</script>
  
  <script type="text/javascript">
   
	<!--
	function myPopup2() {
	window.open( "get_all_address.php", "myWindow", 
	"status = 1, height = 300, width = 300, resizable = 0" )
	}
	
	//-->
</script>
  <script>
  $(function() {
    $( ".datepicker" ).datepicker();
	 dateFormat: "dd/mm/yy"
	 var dateFormat = $( ".datepicker" ).datepicker( "option", "dateFormat" );
	 //to get date in textbox
 $(".datepicker").val(date.getMonth()+"/"+date.getDate()+"/"+date.getFullYear());
// Setter
   $( ".datepicker" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
    });
  </script>
  <script>
 function getname()
	{
		
	var id=$("#userID").val();    // get the id from textbox
	$.ajax({
			type:"post",
			dataType:"json",
			data:"userID="+id,
			url:"address_json_data.php",   // url of php page where you are writing the query
			success:function(json)
			{ 
			   
			  //$("#userID").val(json.user_id); 
			  /*$("#streetName").val(json.street);
			  $("#quarter").val(json.quarter);   
              $("#mobileNumber").val(json.Phone_number); 
			  $("#email").val(json.email);
			  $("#fromDate").val(json.from_date);
			  $("#toDate").val(json.to_date);
			  $("#notes").val(json.other_info);*/
		$("#userID").val(json.user_id);	  
	    var str = '';
		str += "<thead>.<tr>.<th>Street</th>.<th>Quarter</th>.<th>From_date</th>.<th>To_date               </th>.<th>Notes</th>.</thead>";
		
        for(var x in json)
        {
			
         str += "<tr onClick='myPopup("+json[x].id+")'>";
         str += "<td style='width:129px;'>" + json[x].street + "</td>";
		 str += "<td style='width:75px;'>" + json[x].quarter + "</td>";
		 str += "<td style='width:75px;'>" + json[x].from_date + "</td>";
		 str += "<td style='width:75px;'>" + json[x].to_date + "</td>";
         str += "<td style='width:75px;'>" +json[x].other_info + "</td></tr>";
        }
          $("table.imagetable").html(str);
			
			}
			});
	
	}
	
	//used if user insert id and click enter not make submit
	$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
  if(e.which == 13) {
    e.preventDefault();
    return false;
  }
});
//last function to change bgcolor button if selected
var element = null;

function select(xx) 
{ 
if ( element ) { 
element.style.backgroundColor='gray'; 
element.style.border='2px outset white'; 
} 
element = xx; 
xx.style.backgroundColor='green'; 
xx.style.border='2px inset black'; 
// I was thinking about nullifying the onMouseOut command of the selected item so that it will stay selected when the mouse leaves the box. This command doen't seem to do it. Do you know of anything simmilar. 
xx.onMouseOut='null' 
}

	</script>
</head>
<body>
	<?php $intMenuId=1; ?>
<nav>
	
				<!-- menu -->
<ul id="nav" class="sf-menu">
<li  <?php if($intMenuId==0) {?> class="button-link" <?php } ?> ><a class="button-link" href="new_user.php">Employe</a></li>
<li  <?php if($intMenuId==1) {?> class="current-menu-item" <?php } ?> ><a class="button-link" href="address.php">Address</a></li>

</ul>


<?php
if(isset($_GET['id'])){
	$idEmploye=$_GET['id'];
    $db_host = 'MOHAMMAD-PC\SQL2005';
    $db_username = 'root';
	$db_password = '123321';
    $db_name = 'db_test';
    mssql_connect($db_host, $db_username,$db_password);
    mssql_select_db($db_name); 
$resualt=mssql_query("SELECT * FROM Address where id=$idEmploye ") ;
while ($row = mssql_fetch_assoc($resualt)) {
	 
	 
	 $id=$row['id'];
	 $UserId=$row['user_id'];
	 $street=$row['street'];
	 $quarter=$row['quarter'];
     $mobileNumber=$row['Phone_number'];
     $email=$row['email'];
     $fromDate=$row['from_date'];
     $toDate=$row['to_date'];
     $notes=$row['other_info'];
	 
	 
}
	

?>
</br>
<form name="frmEdit" id="frmEdit" action="post_address_info.php" method="post">
<tr>
<td>
<label>Id</label>
</td>
<td>
<input name="userID" id="userID"  onChange="getname()" type="text" />
</td>
<td>
<input type="button" class='button-link' onClick="myPopup2()" value="Search">
</td>
</tr>
</br>
<?php
$resualt=mssql_query("SELECT * FROM Address where user_id='$UserId' ") ;
echo "<table border='1' class='imagetable' id='imagetable' width='400px'  >\n";
echo '<thead>'.'<tr>';
    echo '<th>Street</th>'.'<th>Quarter</th>'.
	'<th>From</th>'.'<th>To</th>'.'<th>Notes</th>';
	 echo '</tr>'.'</thead>';
	 echo '<tbody>';
while ($row = mssql_fetch_assoc($resualt)) {
	
	 echo " <tr onClick='myPopup($row[id])'". ( $_GET['id'] == $row['id'] ? "style='background-color: green;'":"").">\n"."<td >{$row['street']}</td>\n"."<td>{$row['quarter']}</td>\n"."<td>{$row['from_date']}</td>\n".
	  "<td>{$row['to_date']}</td>\n"."<td>{$row['other_info']}</td>\n";
}
echo '</tbody>';
echo "</table>\n";
?>



<table>

<tr>
<td>
<input name="idEmploye"  id="idEmploye" value=" <?php echo $id?>" tabindex="1" readonly type="hidden" onkeypress="getname()" />
</td>

</tr>
<tr>
<td>
<input name="userID" id="userID" value="<?php echo $UserId?>" type="hidden" />
</td>
</tr>
<tr>
<td>
<label>Street Name</label>
</td>
<td>
<input name="streetName" id="streetName" value="<?php echo $street?>" type="text" />
</td>
</tr>
<tr>
<td>
<label>Quarter</label>
</td>
<td>
<input name="quarter" id="quarter" value="<?php echo $quarter?>" type="text" />
</td>
</tr>
<tr>
<td>
<label>mobile Number</label>
</td>
<td>
<input name="mobileNumber" id="mobileNumber" value="<?php echo $mobileNumber?>" type="text" />
</td>
</tr>
<tr>
<td>
<label>Email</label>
</td>
<td>
<input name="email" id="email" value="<?php echo $email?>" type="email" />

</td>
</tr>
<tr>
<td>
<label>From Date</label>
</td>
<td>
<input name="fromDate" id="fromDate" value="<?php echo $fromDate?>" class="datepicker"/>
</td>
</tr>
<tr>
<td>
<label>To Date</label>
</td>
<td>
<input name="toDate" id="toDate" value="<?php echo $toDate?>" class="datepicker" />
</td>
</tr>
<tr>
<td>
<label>Notes</label>
</td>
<td>
<textarea name="notes" id="notes" cols="" rows=""><?php echo $notes?></textarea>
</td>
</tr>
<tr>
<td>
<?php echo"<a class='button-link' href='address.php'>New</a>";
?>
<input name="save" class='button-link' type="Submit" value="submit" />
<?php echo"<a class='button-link' href='delete_address.php?id=$id'>delete</a>";
?>
<input name="exit" class='button-link' type="button" onclick="window.location.href='login.php'" value="Exit" />
</td>
</tr>
</table>
</form>
<?php
}else
{

?>
<form name="frmNew" action="post_address_info.php" method="post">
<table>
<tr>
<td>
<label>User ID</label>
</td>
<td>
<input name="userID" id="userID"  onChange="getname()" type="text" />
</td>
<td>
<input type="button" class='button-link' onClick="myPopup2()" value="Search">
</td>
</tr>

</br>

<table border='1' class="imagetable" width="400px">
<thead>
<tr><th>Street</th><th>Quarter</th><th>From_date</th><th>To_date</th><th>Notes</th>
</thead>
<tbody>
<!--<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>-->
</tbody>
</table>
<table>
<tr>
<td>
<label>User ID</label>
</td>
<td>
<input name="userID" id="userID" type="text" />
</td>
</tr>
<tr>
<td>
<label>Street Name</label>
</td>
<td>
<input name="streetName" id="streetName" type="text" />
</td>
</tr>
<tr>
<td>
<label>Quarter</label>
</td>
<td>
<input name="quarter" id="quarter" type="text" />
</td>
</tr>
<tr>
<td>
<label>mobile Number</label>
</td>
<td>
<input name="mobileNumber" id="mobileNumber" type="text" />
</td>
</tr>
<tr>
<td>
<label>Email</label>
</td>
<td>
<input name="email" id="email" type="email" />

</td>
</tr>
<tr>
<td>
<label>From Date</label>
</td>
<td>
<input name="fromDate" id="fromDate" class="datepicker"/>
</td>
</tr>
<tr>
<td>
<label>To Date</label>
</td>
<td>
<input name="toDate" id="toDate" class="datepicker" />
</td>
</tr>
<tr>
<td>
<label>Notes</label>
</td>
<td>
<textarea name="notes" id="notes" cols="" rows=""></textarea>
</td>
</tr>
<tr>
<td>
<input name="new" class='button-link' type="button" onClick="history.go(0)" value="New" />
<input name="save" class='button-link' type="Submit" value="submit" />
<input name="delete" class='button-link' type="button" onClick="history.go(0)" value="Delete" />
<input name="exit" class='button-link' type="button" onclick="window.location.href='login.php'" value="Exit" />
</td>
</tr>
</table>
</form>
<?php
}
?>



</body>
</html>