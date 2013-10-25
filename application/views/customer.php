<!DOCTYPE html>
<html>
<head>
 <style type="text/css">
       
		p{
            font-family: times new roman;
            color: red;
         }
	   form select[name=customertype]{
                border:1px solid #000066;
				font-weight:bold;
				width:160px;
				height:30px;
				font-size: x-large;
				margin-left: 0.5em;
       }
  h3   {
       margin-left: 10em;
	   }
	    form   {
        font-size:xx-large;
	   }   
</style>              
</head>
<body>

<br>
<form action="<?php echo base_url()?>index.php/queue_home/register_customer" method="post">
Customer Type:<select name="customertype">
  <option value="Constituent">Constituent</option>
  <option value="Walk_in">Walk_in</option>
</select>
<br><br>
<input type="submit"  style="width:150px;height:45px;margin-left: 7em" value="Proceed"></form>


</body>
</html>