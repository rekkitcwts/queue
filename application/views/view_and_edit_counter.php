 <style type="text/css">
	    p{
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
<center>
		<?php 
		foreach($clerks->result() as $clerk) 
		{	
			echo '<table style="display: inline-table" border="0" class="mytable" cellpadding="0" cellspacing="0"><tbody>';
			if(($clerk->ispresent)=='f')
			{
				echo '<th>Counter:'.$clerk->countername.'<br/>(absent)<br/><form action="edit_this_counter" method="POST">
				<button type="submit" name="edit" style="width:px;height:35px;font-size:12px" value="'.$clerk->countername.'">Edit this Counter</button></form><form action="delete_this_counter" method="POST">
             <button type="submit" name="delete" style="width:px;height:35px;font-size:12px"  onclick="return confirm (\'Are you sure you want to delete this Counter? It cannot be undone.\')" value="'.$clerk->countername.'">Delete this Counter</button></form></th>';
			}
			else
			{
				echo '<th>Counter:'.$clerk->countername.'<br/>(present)<br/><form action="edit_this_counter" method="POST">';
				echo '<button type="submit" name="edit" style="width:120px;height:35px;font-size:12px" value="'.$clerk->countername.'">Edit this Counter</button></form><form action="delete_this_counter" method="POST">
				<button type="submit" name="delete" style="width:px;height:35px;font-size:12px"  onclick="	return confirm (\'Are you sure you want to delete this Counter? It cannot be undone.\')" value="'.$clerk->countername.'">Delete this Counter</button></form></th>';
			}
			$customer=$this->queue_model->get_customers_of_this_counter($clerk->countername);
			if($customer->num_rows()>0)
			{
				foreach($customer->result() as $customers)
				{
					if($customers->type=='constituent')
						{
							$constituent=$this->queue_model->getIdnumber_of_constituent($customers->lastname,$customers->firstname);
							foreach($constituent->result() as $myidnumber)
							{
								$idnumber=$myidnumber->idnumber;
							}
							echo '<tr><td> ('.$idnumber.') '.ucwords($customers->lastname).', '.ucwords($customers->firstname).'</td></tr>';
						}
						else
							echo '<tr><td>'.ucwords($customers->lastname).', '.ucwords($customers->firstname).'</td></tr>';
				}
			}
			else
			{
				echo '<tr><td><p>No Customer in this Counter yet</p></td></tr>';
			}
			echo '</tbody></table>';
		}
		?>
</center>

