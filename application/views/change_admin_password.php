<!DOCTYPE html>
<html>
<head>
 <style type="text/css">
       p{
            font-family: times new roman;
            color: red;
         }
	
  h3   {
       margin-left: 10em;
	   }
</style>            
</head>                       
<body>
<br><br>
<form action="<?php echo base_url()?>index.php/queue_home/system_password_changed" method="post">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">All fields are required.</th>
</tr>
<?php echo '<input type="hidden" name="my_old_password" value="'.$systempassword.'">'; ?>
<?php echo '<tr><td>Username</td><td><input readonly style="width:200px;height:30px" name="username" value="'.$username.'"></td></tr>'; ?>
<tr><td>Old Password</td><td><input type="password" style="width:200px;height:30px" name="password"></td></tr>
<tr><td>New Password</td><td><input type="password" style="width:200px;height:30px" name="new_password"></td></tr>
<tr><td>Password Confirmation</td><td><input type="password" style="width:200px;height:30px" name="confirm_password"></td></tr></tbody></table>
<p><?php echo validation_errors(); ?></p>
<input type="submit" style="margin-left: 13em;width:120px;height:35px;font-size:12px" value="Submit"></form>
<br><br>
</body>
</html>