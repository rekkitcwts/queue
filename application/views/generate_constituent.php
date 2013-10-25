 <style type="text/css">
	    p{
              color:red;
       }
</style>     
<form action="<?php echo base_url();?>index.php/queue_home/constituent_generated" method="post" accept-charset="utf-8">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">All fields are required.</th>
</tr>
<tr><td>ID Number</td><td><input autocomplete="off" type="text" name="idnumber" value=""></td></tr>
<tr><td>Last Name</td><td><input autocomplete="off" type="text" name="lastname" value=""></td></tr>
<tr><td>First Name</td><td><input autocomplete="off" type="text" name="firstname" value=""></td></tr>
</tbody>
</table>
<p><?php echo validation_errors(); ?> </p>
<input type="submit" name="" style="width:150px;height:35px;font-size:12px" value="Generate Constituent">
</center>
</form>