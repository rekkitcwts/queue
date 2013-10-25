<form name="search" method="POST" action="viewQueue">
	<select name="window">
			<?php 
				$sql = $this->queue_model->returnWindowList();
				foreach($sql->result() as $window)
				{
					echo "<option value=" . $window->windowID . ">" . $window->windowName . "</option>";
				}
			?>
	</select>
	<input type="submit" name="submitname" value="Select Window">
</form>
<br>
<?php
if (isset($_POST['submitname'])) 
{
	if (isset($_POST['window']))    
	{    
		$window = $_POST['window'];
		
    	$customers = $this->queue_model->viewQueueWindow($window);
		
		// generate HTML table from query results
		$tmpl = array (
		'table_open' => '<table border="0" cellpadding="0" cellspacing="0" class="mytable boxshadow">',
		'heading_row_start' => '<tr bgcolor="#66cc44">',
		'row_start' => '<tr bgcolor="#dddddd">' 
		);
		$this->table->set_template($tmpl); 
    
		$this->table->set_empty("&nbsp;"); 
		if ($customers->result_array() == NULL)
		{
			echo '<img border="0" width="490" alt="Record not found!." title="Record not found!" src="' . base_url() . 'img/WITW-BHMS/record-not-found-wenhern.png" style="border:1px solid #ccc; ">';
			echo '<br>';
			echo '<span class="boxshadow" style="background:#fff">';
			echo 'Unofficial lodger with last name ' . $username . ' was not found.';
			echo '</span>';
			}
		else
		{
		$this->table->set_heading('Name','Priority Number');
		
		$table_row = array();
		foreach ($customers->result() as $queued)
		{
		$table_row = NULL;
		//$table_row[] = anchor('bhms_home/editlodger/' . $lodger->ssn, 'Edit');
		//Move this to another area.
		$table_row[] = $queued->lname . ', ' . $queued->fname;
		$table_row[] = $queued->prionum;

		$this->table->add_row($table_row);
		}
		$cust_table = $this->table->generate();
		
		echo $cust_table;
		}
	}
}


?>
<?php
if (!isset($_POST['submitname'])) 
{
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<br>';
}

?>