<!DOCTYPE html>
<html>
<head>
 <style type="text/css">
        p{
            font-family: times new roman;
            color: blue;
         }
        
       }
  h3   {
       margin-left: 10em;
	   }
	   a{
        color: blue;
        font-weight: bolder;
</style>            
</head>                       
<body>
<form action="<?php echo base_url()?>index.php/login/logging_in" method="post">
Username: <input autocomplete="off" type="text" style="width:200px;height:30px" name="username"><br>
Password: <input type="password" style="width:200px;height:30px" name="password"><br><br>
<input type="submit" style="margin-left: 13em;width:120px;height:35px;font-size:12px" value="LOGIN"></form>
<br><br>
<p><b>Note:</b> The characters in a password field are masked (shown as asterisks or circles).</p>

</body>
</html>
