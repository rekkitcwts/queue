 <style type="text/css">
	    
		p{
             font-size:15px;
			 color:red;
       }
	     button[type=submit]{
			cursor:pointer;
background-color: #f37873;			
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ee432e), color-stop(50%, #c63929), color-stop(50%, #b51700), color-stop(100%, #891100));
  background-image: -webkit-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
  background-image: -moz-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
  background-image: -ms-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
  background-image: -o-linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
  background-image: linear-gradient(top, #ee432e 0%, #c63929 50%, #b51700 50%, #891100 100%);
  border: 1px solid #951100;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4), 0 1px 3px #333333;
  -moz-box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4), 0 1px 3px #333333;
  box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4), 0 1px 3px #333333;
  color: #fff;
  font: bold 10px "helvetica neue", helvetica, arial, sans-serif;
  line-height: 1;
  padding: 12px 0 14px 0;
  text-align: center;
  text-shadow: 0px -1px 1px rgba(0, 0, 0, 0.8);
  width: 120px; }
  button.thoughtbot:hover {
    background-color: #f37873;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f37873), color-stop(50%, #db504d), color-stop(50%, #cb0500), color-stop(100%, #a20601));
    background-image: -webkit-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: -moz-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: -ms-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: -o-linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    background-image: linear-gradient(top, #f37873 0%, #db504d 50%, #cb0500 50%, #a20601 100%);
    cursor: pointer; }
  button.thoughtbot:active {
    background-color: #d43c28;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d43c28), color-stop(50%, #ad3224), color-stop(50%, #9c1500), color-stop(100%, #700d00));
    background-image: -webkit-linear-gradient(top, #d43c28 0%, #ad3224 50%, #9c1500 50%, #700d00 100%);
    background-image: -moz-linear-gradient(top, #d43c28 0%, #ad3224 50%, #9c1500 50%, #700d00 100%);
    background-image: -ms-linear-gradient(top, #d43c28 0%, #ad3224 50%, #9c1500 50%, #700d00 100%);
    background-image: -o-linear-gradient(top, #d43c28 0%, #ad3224 50%, #9c1500 50%, #700d00 100%);
    background-image: linear-gradient(top, #d43c28 0%, #ad3224 50%, #9c1500 50%, #700d00 100%);
    -webkit-box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4);
    -moz-box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4);
    box-shadow: inset 0px 0px 0px 1px rgba(255, 115, 100, 0.4); }
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
<div>   
<center>
<?php 
			echo '<form action="updating_clerkaccount" method="POST">';
			echo '<table border="0" class="mytable" cellpadding="0" cellspacing="0">';
			echo '<tbody><tr><th colspan="3"> </th></tr>';
			echo '<tr><td>Counter Name</td><td><input autocomplete="off" type="text" name="countername" value="'.$countername.'"></td></tr>';
			echo '<tr><td>Username</td><td><input autocomplete="off" type="text" name="username" value="'.$username.'"></td></tr>';
            echo '<tr><td>Password</td><td> <input autocomplete="off" type="password" name="password" value="'.$password.'"></td></tr>';
			echo '<tr><td>Transaction</td><td><input autocomplete="off" name="transaction"  value="'.$transaction.'" type="text" maxlength="50" id="transaction" tabindex="2" onchange="DropDownIndexClear(\'DropDownExTextboxExample\');" style="z-index: 2;width:150px;position: absolute;" />
			<select name="DropDownExTextboxExample" id="DropDownExTextboxExample" tabindex="1000" onchange="DropDownTextToBox(this,\'transaction\');" style="z-index: 1;position: absolute; width: 167px;">';
			$all_transaction=$this->queue_model->get_distinct_transaction($systemusername);
			foreach($all_transaction->result() as $mytransaction)
			{
				echo'<option value="'.$mytransaction->transaction.'">'.$mytransaction->transaction.'</option>';
			}
			echo'</select><script language="javascript" type="text/javascript"> DropDownIndexClear("DropDownExTextboxExample") </script></td></tr></tbody></table>';
			echo'<input type="submit" onclick="return confirm (\'Are you sure? It cannot be undone.\')" style="margin-left:13em;width:120px;height:35px;font-size:12px" value="UPDATE CHANGES"></form><br>';
			echo '<p>'.validation_errors().'</p><br>';
			echo'<form action="transfer_customers" method="post">';
			echo'<input type="hidden" name="old_countername" value="'.$countername.'">';
			echo'Transfer Customers to Counter:<select name="new_countername">';
			foreach($allcounters->result() as $mycounternames)
			{
					$cname=$mycounternames->countername;
					echo '<option value="'.$cname.'">'.$cname.'</option>';
			}
			echo'</select><br>';
			echo'<input type="submit" onclick="return confirm (\'Are you sure? It cannot be undone.\')"  style="font-size:12px;width:100px;height:30px;margin-left:14em" value="Transfer"></form>';
			echo '<table style="display: inline-table" border="0" class="mytable" cellpadding="0" cellspacing="0"><tbody>';
			if(($ispresent)=='f')
				echo '<tr><th colspan="2"><h4 align="Center">Counter Name:'.$countername.'<br>(absent)';
			else
				echo '<tr><th colspan="2"><h4 align="Center">Counter:'.$countername.' (present)';
			echo'<tr><th>Customer Name</th>';
			echo'<th>Customer Purpose</th></tr>';
			if($customers->num_rows()>0)
			{
				foreach($customers->result() as $customer)
				{
					if($customer->type=='constituent')
					{
						$constituent_idnumber=$this->queue_model->getIdnumber_of_constituent($customer->lastname,$customer->firstname);
						foreach($constituent_idnumber->result() as $myidnumber)
						{
							$idnumber=$myidnumber->idnumber;
						}
						echo '<tr><td> ('.$idnumber.') '.ucwords($customer->lastname).', '.ucwords($customer->firstname).'</td><td>'.$customer->purpose.'</td></tr>';
					}
					else
						echo '<tr><td>'.ucwords($customer->lastname).', '.ucwords($customer->firstname).'</td><td>'.$customer->purpose.'</td></tr>';
				}
				echo '</tbody></table>';
				echo'<form action="restart_this_queue" method="POST"><button type="submit" name="restart_queue" style="margin-left:25em; width:120px;height:35px;font-size:12px" onclick="return confirm (\'Are you sure you want to reset this Queue? It cannot be undone.\')" value="'.$countername.'">Reset this Queue</button></form>';
			}
			else
			{
				echo '<tr><td colspan="2"><p align="center">No Customer in this Counter yet</p></td></tr>';
				echo '</tbody></table>';
			}
		?>
</center>
</div>