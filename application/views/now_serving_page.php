 <style type="text/css">
	    p{
              color:red;
       }
			h2{
				text-align: left;
				margin-left: 10px;
			}
			h4{
				color: red;
			}
			h3[id=bb]{
				color: blue;
				text-align: left;
				margin-left: 160px;
			}
			h3[id=aa]{
				color: black;
				text-align: left;
				margin-left:20px;
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
  font: bold 20px "helvetica neue", helvetica, arial, sans-serif;
  line-height: 1;
  padding: 12px 0 14px 0;
  text-align: center;
  text-shadow: 0px -1px 1px rgba(0, 0, 0, 0.8);
  width: 150px; }
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
<script>
</script>
<div>   
<center>
<div>
<?php
	if($ispresent=='t')
	{
		echo'<h3 id="aa">CURRENT STATUS: ONLINE</h3>';
		echo '<form action="set_presence" method="POST"><button type="submit" name="presence" style="float:left;margin-left:12em;width:120px;height:35px;font-size:12px" onclick="return confirm (\'Are you sure?.\')" value="'.$ispresent.'" disabled>Go Offline</button></form><br><br>';
	}
	else
	{
		echo'<h3 id="aa">CURRENT STATUS: OFFLINE</h3>';
		echo '<form action="set_presence" method="POST"><button type="submit" name="presence" style="float:left;margin-left:12em;width:120px;height:35px;font-size:12px" onclick="return confirm (\'Are you sure?.\')" value="'.$ispresent.'" disabled>Go Online</button></form><br><br>';
	}
	if($first_customer->num_rows()>0)
	{
		foreach($first_customer->result() as $customer)
		{
			if($customer->type=='constituent')
			{
				$constituent=$this->queue_model->getIdnumber_of_constituent($customer->lastname,$customer->firstname);
				foreach($constituent->result() as $myidnumber)
				{
					$idnumber=$myidnumber->idnumber;
				}
				echo '<h2>CURRENT CUSTOMER: </h2><h3 id="bb">Name: ('.$idnumber.') '.ucwords($customer->lastname).', '.ucwords($customer->firstname).'</h3><h3 id="bb">Purpose: '.$customer->purpose.'</h3>';
			}
			else
				echo '<h2>CURRENT CUSTOMER: </h2><h3 id="bb">Name: '.ucwords($customer->lastname).', '.ucwords($customer->firstname).'</h3><h3 id="bb">Purpose: '.$customer->purpose.'</h3>';
			$customer_pnumber=$customer->prioritynumber;
		}
		echo'<br><br>';
		echo '<table ><tbody>';
		echo '<ul><form action="nextcustomer" method="POST">';
		echo'<tr><th><button type="submit" name="customer_pnumber" onclick="return confirm (\'Are you sure? It cannot be undone.\')" value="'.$customer_pnumber.'">Next Customer</button></form></th>';
		echo '<form action="requeue" method="POST">';
		echo'<th><button type="submit"  onclick="return confirm (\'Are you sure? It cannot be undone.\')" type="submit" name="customer_pnumber" value="'.$customer_pnumber.'">Requeue</button></form></th></tr>';
		echo'</tbody></table>';
	}
	else
	{
		echo '<h2>Current Customer: No Customer yet in this Counter</h2>';
	}
?>
</div>
<br>
<div>
<?php
	echo '<table style="display: inline-table" border="0" class="mytable" cellpadding="0" cellspacing="0"><tbody>';
	echo '<h4>TRANSACTION TO CUSTOMER: '.$transaction.'<h4/>';
	echo'<tr><th>Customer Name</th>';
	echo'<th>Customer Purpose</th></tr>';
	if($customers->num_rows()>0)
	{
			foreach($customers->result() as $customer)
				{
					if($customer->type=='constituent')
					{
						$constituent=$this->queue_model->getIdnumber_of_constituent($customer->lastname,$customer->firstname);
						foreach($constituent->result() as $myidnumber)
						{
							$myidnumber=$myidnumber->idnumber;
						}
						echo '<tr><td> ('.$myidnumber.') '.ucwords($customer->lastname).', '.ucwords($customer->firstname).'</td><td>'.$customer->purpose.'</td></tr>';
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
	}
	echo '</tbody></table>';
?>
</div>
</center>
</div>