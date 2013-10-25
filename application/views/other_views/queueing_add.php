<form action="<?php echo base_url();?>index.php/queue_home/createNewCustomer" method="post" accept-charset="utf-8">
	<!-- Schadenfreude -->
	<center>
	<table border="0" class="mytable" cellpadding="0" cellspacing="0">
	<tbody>
	<tr>
		<th colspan="3">Enter customer info</th>
	</tr>
	<tr><td>Last Name</td><td><input type="text" name="lname" value=""></td></tr>
	<tr><td>First Name</td><td><input type="text" name="fname" value=""></td></tr>
<!--	<tr><td>Priority Number</td><td><input type="text" name="prionum" value=""></td></tr> -->
	<tr><td>Transaction Type</td><td>
		<select name="window">
			<?php 
				$sql = $this->queue_model->returnWindowList();
				foreach($sql->result() as $window)
				{
					echo "<option value=" . $window->windowID . ">" . $window->windowName . "</option>";
				}
			?>
		</select>
	</tbody>
	</table>

	<input type="submit" name="" value="Add To Queue">
</center>
</form>