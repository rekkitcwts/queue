<!DOCTYPE html>
<html>
<head>
 <style type="text/css">
       
		p{
            font-family: times new roman;
            color: red;
         }
	   form select[name=usertype]{
                border:1px solid #000066;
				font-weight:bold;
				width:140px;
				height:30px;
				font-size: x-large;
				margin-left: 0.5em;
       }
	    form   {
        font-size:xx-large;
	   }   
</style>              
</head>
<body>

<br>
<form action="<?php echo base_url()?>index.php/queue_home/user" method="post">
<br>
<h3> System Admin Created</h3>
Type Of User:<select name="usertype">
  <option value="customer">Customer</option>
  <option value="staff">Staff</option>
</select>
<br><br>
<input type="submit"  style="width:150px;height:40px; margin-left: 7em;" value="Proceed"></form>


</body>
</html>