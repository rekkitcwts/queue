<html>
<head>

<title>Login</title>

<style type="text/css">
@font-face {
    font-family: 'lubalgraph_bd_btbold';
    src: url('<?php echo base_url();?>fonts/lubalin_graph_bold_cartoon_network.eot');
    src: url('<?php echo base_url();?>fonts/lubalin_graph_bold_cartoon_network.eot?#iefix') format('embedded-opentype'),
         url('<?php echo base_url();?>fonts/lubalin_graph_bold_cartoon_network.woff') format('woff'),
         url('<?php echo base_url();?>fonts/tf2build.ttf') format('truetype'),
         url('<?php echo base_url();?>fonts/lubalin_graph_bold_cartoon_network.svg#lubalgraph_bd_btbold') format('svg');
    font-weight: normal;
    font-style: normal;

}
div
{
font-family: 'lubalgraph_bd_btbold';
}
h1
{
font-family: 'lubalgraph_bd_btbold';
}

p
{
font-family: 'lubalgraph_bd_btbold';
font-size:x-large;
}

span
{
font-family: 'lubalgraph_bd_btbold';
font-size:x-large;
}

time
{
font-family: 'lubalgraph_bd_btbold';
font-size:250%;
}
 </style>
</head>
<body style="background-image:url(<?php echo base_url();?>/img/loginbackground.png); background-size:100% 100%;">
<form method="POST" action="<?php echo site_url("login/logging_in")?>">
<br>
<br>
<span style="color:red">
<?php
if(isset($msg))
	{
		echo $msg."<br>";
		echo "Please try again.";
		echo "<br><br>";
	}
else
	{
		echo "<p>LOGIN</p>";
	}
?>
</span>
<br>
<br>
<br>
<br>
<p>USERNAME <input type="text" name="username"><br>
PASSWORD <input type="password" name="userpass"><br></p>
<input type="submit" value="Login">
</form>
<br>
<br>
<br>
<br>
</body>
</html>