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
<form action="<?php echo base_url()?>index.php/queue_home/system_admin_created" method="post">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">All fields are required.</th>
</tr>
<tr><td>System Username</td><td><input readonly style="width:200px;height:30px" name="systemusername" value="admin"></td></tr>
<tr><td>System Password</td><td><input type="password" style="width:200px;height:30px" name="systempassword"></td></tr>
<tr><td>Password Confirmation</td><td><input type="password" style="width:200px;height:30px" name="systemconfirm_password"></td></tr></tbody></table>
<p><?php echo validation_errors(); ?></p>
<input type="submit"  style="width:100px;height:35px; font-size:15px; margin-left: 13em" value="Submit"></form>
<br><br>

</body>
</html>
