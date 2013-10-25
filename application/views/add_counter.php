 <style type="text/css">
	    p{
              color:red;
       }
</style>   
<script language="javascript" type="text/javascript">
     function DropDownTextToBox(objDropdown, strTextboxId) {
        document.getElementById(strTextboxId).value = objDropdown.options[objDropdown.selectedIndex].value;
        DropDownIndexClear(objDropdown.id);
        document.getElementById(strTextboxId).focus();
    }
    function DropDownIndexClear(strDropdownId) {
        if (document.getElementById(strDropdownId) != null) {
            document.getElementById(strDropdownId).selectedIndex = -1;
        }
    }
</script>  
<form action="<?php echo base_url();?>index.php/queue_home/counter_created" method="post" accept-charset="utf-8">
<center>
<table border="0" class="mytable" cellpadding="0" cellspacing="0">
<tbody>
<tr>
    <th colspan="3">All fields are required.</th>
</tr>
<tr><td>Counter Name</td><td><input autocomplete="off" type="text" name="counter_name" value=""></td></tr>
<tr><td>Username</td><td><input autocomplete="off" type="text" name="uname" value=""></td></tr>
<tr><td>password</td><td><input autocomplete="off" type="password" name="pass" value=""></td></tr>
<tr><td>Confirm password</td><td><input autocomplete="off" type="password" name="confirm_password" value=""></td></tr>
<tr><td>Transaction</td><td><input autocomplete="off" name="transaction" type="text" maxlength="50" id="transaction" tabindex="2" onchange="DropDownIndexClear('DropDownExTextboxExample');" style="z-index: 2;width:150px;position: absolute;" />
<select name="DropDownExTextboxExample" id="DropDownExTextboxExample" tabindex="1000" onchange="DropDownTextToBox(this,'transaction');" style="z-index: 1;position: absolute; width: 167px;">
<?php
		$all_transaction=$this->queue_model->get_distinct_transaction($systemusername);
		foreach($all_transaction->result() as $mytransaction)
		{
			echo'<option value="'.$mytransaction->transaction.'">'.$mytransaction->transaction.'</option>';
		}
		echo'</select>';
?>
    <script language="javascript" type="text/javascript">
        DropDownIndexClear("DropDownExTextboxExample")
    </script></td></tr>
</tbody>
</table>
<p><?php echo validation_errors(); ?> </p>
<input type="submit" name="" style="width:120px;height:35px;font-size:12px" value="Add Counter">
</center>
</form>