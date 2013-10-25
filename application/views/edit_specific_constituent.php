 <style type="text/css">
	    p{
              color:red;
       }
</style>     
<form action="<?php echo base_url();?>index.php/queue_home/updating_constituent" method="post" accept-charset="utf-8">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">All fields are required.</th>
</tr>
<?php
echo'<tr><td>ID Number</td><td><input autocomplete="off" type="text" name="idnumber" value="'.$idnumber.'"></td></tr>';
echo'<tr><td>Last Name</td><td><input autocomplete="off" type="text" name="lastname" value="'.$lastname.'"></td></tr>';
echo'<tr><td>First Name</td><td><input autocomplete="off" type="text" name="firstname" value="'.$firstname.'"></td></tr>';
?>
</tbody>
</table>
<p><?php echo validation_errors(); ?> </p>
<input type="submit" name="" onclick="return confirm ('Are you sure?')" style="width:150px;height:35px;font-size:12px" value="Generate Constituent">
</center>
</form>