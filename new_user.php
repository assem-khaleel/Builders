<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User_info</title>
<script type="text/javascript">
<!--
function myPopup2() {
window.open( "get_all.php", "myWindow", 
"status = 1, height = 300, width = 300, resizable = 0" )
}

//-->
</script>
<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
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
	var id=$("#idEmploye").val();    // get the id from textbox
	$.ajax({
			type:"post",
			dataType:"json",
			data:"id="+id,
			url:"page.php",   // url of php page where you are writing the query
			success:function(json)
			{ 
			   
			  $("#nameArabic").val(json.name_ar); 
			  $("#nameEnglish").val(json.name_en);
			  $("#address").val(json.address);   
              $("#dateBirth").val(json.date_birth); 
			  $("#dateJoin").val(json.date_join);
			  $("#jobTitle").val(json.title_job);
			  $("input:radio[name='gender'][value='"+ json.gender +"']").prop('checked',true);
			  $("#religion").val(json.religion);
			  $("#notes").val(json.other_info);
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
<?php $intMenuId=0; ?>
<nav>
	
				<!-- menu -->
<ul id="nav" class="sf-menu">
<li  <?php if($intMenuId==0) {?> class="current-menu-item" <?php } ?> ><a class="button-link" href="new_user.php">Employe</a></li>
<li  <?php if($intMenuId==1) {?> class="button-link" <?php } ?> ><a class="button-link" href="address.php">Address</a></li>

</ul>
<?php
if(isset($_GET['id'])){
$idEmploye=$_GET['id'];

$db_host = 'MOHAMMAD-PC\SQL2005';
$db_username = 'root';
$db_password = '123321';
$db_name = 'db_test';
mssql_connect($db_host,$db_username,$db_password);
mssql_select_db($db_name); 

$resualt=mssql_query("SELECT * FROM user_info where id=$idEmploye ") ;
while ($row = mssql_fetch_assoc($resualt)) {
	 
	 
	 $id=$row['id'];
	 $name_ar=$row['name_ar'];
	 $name_en=$row['name_en'];
	 $address=$row['address'];
	 $dateOfBirth=$row['date_birth'];
	 $dateJoin=$row['date_join'];
	 $titleJob=$row['title_job'];
	 $gender=$row['gender'];
	 $religion=$row['religion'];
	 $otherInfo=$row['other_info'];
	 
	 
}
 
?>

<form name="frmEDIT"  id="frmEDIT" action="post_info.php" method="post">
<table>

<tr>
<td>
<label>Id Employe</label>
</td>
<td>
<input name="idEmploye" value="<?php echo $id ?>"  type="text" />
</td>
<td>
<input type="button" class='button-link' onClick="myPopup2()" value="Search">
</td>
</tr>
<tr>
<td>
<label>Employe Name Arabic</label>
</td>
<td>
<input name="nameArabic" value="<?php echo  $name_ar ?>" type="text" />
</td>
</tr>
<tr>
<td>
<label>Employe Name English</label>
</td>
<td>
<input name="nameEnglish" value="<?php echo  $name_en ?>" type="text" />
</td>
</tr>
<tr>
<td>
<label>Address</label>
</td>
<td>
<textarea name="address" cols="" rows=""><?php echo   $address ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Date OF Birth</label>
</td>
<td>
<input name="dateBirth" value="<?php echo  $dateOfBirth ?>" type="text" class="datepicker" />
</td>
</tr>
<tr>
<td>
<label>Date Join</label>
</td>
<td>
<input name="dateJoin" type="text"  value="<?php echo  $dateJoin ?>"  class="datepicker"  />
</td>
</tr>
<tr>
<td>
<label>Job Title</label>
</td>
<td>
<select name="jobTitle">
 
<option value="Developer" <?php if($titleJob=="Developer") echo "selected"?> >Developer</option>
<option value="hr"  <?php if($titleJob=="hr") echo "selected"?>>hr</option>
</select>
</td>
</tr>
<tr>
<td>
<label>Gender</label>
</td>
<td>
<input name="gender" type="radio" <?php if($gender == "Male") echo  'checked="checked"'?>  value="Male" >Male</input>
</td>
<td>
<input name="gender" type="radio" <?php if($gender == "Female") echo 'checked="checked"'?>value="Female">Female</input>
</td>
</tr>
<tr>
<td>
<label>Religion</label>
</td>
<td>

<select name="religion">
<option value="Muslim" <?php if($religion == "Muslim") echo  "selected"?> >Muslim</option>
<option value="Christian"<?php if($religion == "Christian") echo  "selected" ?>>Christian</option>
								                  
</select>
</td>
</tr>
<tr>
<td>
<label>Notes</label>
</td>
<td>
<textarea name="notes" cols="" rows=""><?php echo  $otherInfo ?></textarea>
</td>
</tr>
<tr>
<td>
<input name="save" class='button-link' type="Submit" value="submit" />
<?php echo"<a class='button-link' href='delete_user.php?id=$id'>delete</a>";
?>
<?php echo"<a class='button-link' href='new_user.php'>New</a>";
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

<form name="frmNew" action="post_info.php" method="post">
<table>

<tr>
<td>
<label>Id Employe</label>
</td>
<td>
<input name="idEmploye"  id="idEmploye" tabindex="1"  type="text" onChange="getname()" />
</td>
<td>
<input type="button" class='button-link' onClick="myPopup2()" value="Search">
</td>
</tr>
<tr>
<td>
<label>Employe Name Arabic</label>
</td>
<td>
<input name="nameArabic" id="nameArabic" type="text" />
</td>
</tr>
<tr>
<td>
<label>Employe Name English</label>
</td>
<td>
<input name="nameEnglish" id="nameEnglish" type="text" />
</td>
</tr>
<tr>
<td>
<label>Address</label>
</td>
<td>
<textarea name="address" id="address" cols="" rows=""></textarea>
</td>
</tr>
<tr>
<td>
<label>Date OF Birth</label>
</td>
<td>
<input name="dateBirth" id="dateBirth" class="datepicker"/>
</td>
</tr>
<tr>
<td>
<label>Date Join</label>
</td>
<td>
<input name="dateJoin" id="dateJoin" class="datepicker" />
</td>
</tr>
<tr>
<td>
<label>Job Title</label>
</td>
<td>
<select name="jobTitle" id="jobTitle">
<option value="Developer">Developer</option>
<option value="hr">hr</option>
</select>
</td>
</tr>
<tr>
<td>
<label >Gender</label>
</td>
<td>
<input name="gender" id="gender" type="radio"   value="Male" >Male</input>
</td>
<td>
<input name="gender" id="gender" type="radio"  value="Female">Female</input>
</td>
</tr>
<tr>
<td>
<label>Religion</label>
</td>
<td>
<select name="religion" id="religion">
<option value="Muslim">Muslim</option>
<option value="Christian">Christian</option>
</select>
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
<?php } ?>
</body>
</html>