<?php 
class Queue_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	public function check_if_admin_exist()
	{
		$query=$this->db->query("SELECT * FROM systemadmin");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
	}
	public function login($u,$p)
    {
        $query=$this->db->query("SELECT * FROM staff where username='$u'and password='$p'");
        return $query;
    }
	public function check_if_logged_in($username)
    {
        $query=$this->db->query("SELECT * FROM staff where username='$username'");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function create_system_admin($username,$password)
	{
		$this->db->query("INSERT INTO staff(username,password,type) VALUES('$username','$password','systemadmin')");
		$this->db->query("INSERT INTO systemadmin(systemusername,systempassword) VALUES('$username','$password')");
	}
	public function check_if_countername_exist($countername)
    {
        $query=$this->db->query("SELECT countername FROM clerkaccount WHERE countername='$countername'");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function check_if_username_exist($username)
    {
        $query=$this->db->query("SELECT username FROM staff WHERE username='$username'");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function check_if_idnumber_exist($idnumber)
    {
        $query=$this->db->query("SELECT idnumber FROM constituent WHERE idnumber='$idnumber'");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function check_if_idnumber_exist_in_constituentdatabase($idnumber)
	{
		$query=$this->db->query("SELECT idnumber FROM constituentdatabase WHERE idnumber='$idnumber'");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
	}
	public function check_if_idnumber_is_in_database($idnumber)
    {
        $query=$this->db->query("SELECT idnumber FROM constituentdatabase WHERE idnumber='$idnumber'");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	public function create_counter($countername,$systemusername,$username,$password,$transaction,$type)
    {
		$this->db->query("INSERT INTO staff(username,password,type) VALUES ('$username','$password','$type')");
		$this->db->query("INSERT INTO clerkaccount(countername,systemusername,username,password,transaction,ispresent) VALUES ('$countername','$systemusername','$username','$password','$transaction',FALSE)");
	}
	public function customer_queue($countername)
    {
        $query=$this->db->query("SELECT * from customer where countername='$countername' ORDER BY prioritynumber");
        return $query;
    }
	public function view_all_clerks($systemusername)
    {
        $query=$this->db->query("SELECT * from clerkaccount where systemusername='$systemusername' ORDER BY countername;");
        return $query;
    }
	public function get_counternames($systemusername)
    {
        $query=$this->db->query("SELECT countername from clerkaccount where systemusername='$systemusername' ORDER BY countername;");
        return $query;
    }
	public function get_present_transaction()
	{
		$query=$this->db->query("SELECT DISTINCT transaction from clerkaccount where ispresent=TRUE");
        return $query;
	}
	public function get_distinct_transaction($systemusername)
	{
		$query=$this->db->query("SELECT DISTINCT transaction from clerkaccount where systemusername='$systemusername'");
		return $query;
	}
	public function match_transaction($transaction)
	{
		$query=$this->db->query("SELECT countername from clerkaccount where (transaction='$transaction' AND ispresent=TRUE)");
		if($query->num_rows()>1)
        {
            $minmumCustomer=1000;
			foreach($query->result() as $mycountername)
			{
				$cname=$mycountername->countername;
				$query2=$this->db->query("SELECT count(lastname) as mycount from customer where countername='$cname'");
				foreach($query2->result() as $mycustomer)
				{
					$numberOfcustomer=$mycustomer->mycount;
				}
				if($numberOfcustomer<=$minmumCustomer)
				{
					$minmumCustomer=$numberOfcustomer;
					$finalCountername=$cname;
				}
			}
			$query_final=$this->db->query("SELECT countername from clerkaccount where countername='$finalCountername'");
			return $query_final;
		}
        else
        {
            return $query;
        }
	}
	public function getName_of_constituent($idnumber)
	{
		$query=$this->db->query("SELECT lastname,firstname from constituentdatabase where idnumber='$idnumber'");
		return $query;
	}
	public function getIdnumber_of_constituent($lastname,$firstname)
	{
		$query=$this->db->query("SELECT idnumber from constituent where lastname='$lastname' and firstname='$firstname'");
		return $query;
	}
	public function register_constituent($idnumber,$countername,$lastname,$firstname,$purpose)
	{
		$priorityNumber=1;
		$query=$this->db->query("SELECT MAX(prioritynumber) as number FROM customer");
		foreach($query->result() as $p)
		{
			$priorityNumber=$p->number+1;
		}
		$type="constituent";
		$this->db->query("INSERT into customer(prioritynumber,countername,lastname,firstname,purpose,type) VALUES ('$priorityNumber','$countername','$lastname','$firstname','$purpose','$type')");
		$this->db->query("INSERT into constituent(idnumber,prioritynumber,countername,lastname,firstname,purpose) VALUES ('$idnumber','$priorityNumber','$countername','$lastname','$firstname','$purpose')");		
	}
	public function register_walkin($countername,$lastname,$firstname,$purpose)
	{
		$priorityNumber=1;
		$query=$this->db->query("SELECT MAX(prioritynumber) as number FROM customer");
		foreach($query->result() as $p)
		{
			$priorityNumber=$p->number+1;
		}
		$type="walkin";
		$this->db->query("INSERT into customer(prioritynumber,countername,lastname,firstname,purpose,type) VALUES ('$priorityNumber','$countername','$lastname','$firstname','$purpose','$type')");
		$this->db->query("INSERT into walkin(prioritynumber,countername,lastname,firstname,purpose) VALUES ('$priorityNumber','$countername','$lastname','$firstname','$purpose')");		
	}
	public function get_customers_of_this_counter($countername)
	{
		$query=$this->db->query("SELECT * FROM customer where countername='$countername' ORDER BY prioritynumber");
		return $query;
	}
	public function get_head_of_the_queue($countername)
	{
		$query=$this->db->query("SELECT * FROM customer where prioritynumber=(SELECT MIN(prioritynumber) FROM customer WHERE countername='$countername')");
		return $query;
	}
	public function get_attribute_of_this_counter($countername)
	{
		$query=$this->db->query("SELECT * FROM clerkaccount where countername='$countername'");
		return $query;
	}
	public function update_counter($countername,$systemusername,$username,$password,$transaction,$old_countername,$old_username)
	{
		$this->db->query("UPDATE staff SET username='$username',password='$password' WHERE username='$old_username'");
		$this->db->query("UPDATE clerkaccount SET countername='$countername',systemusername='$systemusername',username='$username',password='$password',transaction='$transaction' WHERE countername='$old_countername'");
	}
	public function restart_queue_of_this_counter($countername)
	{
		$this->db->query("DELETE FROM customer where countername='$countername'");
	}
	public function delete_this_counter($countername)
	{
		$query=$this->db->query("SELECT username from clerkaccount where countername='$countername'");
		foreach($query->result() as $my_username)
		{
			$username=$my_username->username;
		}
		$this->db->query("DELETE FROM staff where username='$username'");
	}
	public function get_attribute_of_this_constituent($idnumber)
	{
		$query=$this->db->query("SELECT * from constituentdatabase where idnumber='$idnumber'");
		return $query;
	}
	public function delete_this_constituent_in_database($idnumber)
	{
		$this->db->query("DELETE FROM constituentdatabase where idnumber='$idnumber'");
	}
	public function update_constituent($new_idnumber,$new_lastname,$new_firstname,$old_idnumber)
	{
		$this->db->query("UPDATE constituentdatabase SET idnumber='$new_idnumber',lastname='$new_lastname',firstname='$new_firstname' where idnumber='$old_idnumber'");
	}
	public function get_admin_password($systemusername)
	{
		$query=$this->db->query("SELECT systempassword from systemadmin where systemusername='$systemusername'");
		return $query;
	}
	public function change_password($systemusername,$systempassword)
	{
		$this->db->query("UPDATE staff set password='$systempassword' where username='$systemusername'");
		$this->db->query("UPDATE systemadmin set systempassword='$systempassword' where systemusername='$systemusername'");
	}
	public function reset_all_queues()
	{
		$this->db->query("delete from customer");
	}
	public function dissolve_admin()
	{
		$this->db->query("delete from staff");
	}
	public function get_clerk_att($username)
	{
		$query=$this->db->query("SELECT * FROM clerkaccount where username='$username'");
		return $query;
	}
	public function set_this_counter_to_true($username)
	{
		$this->db->query("UPDATE clerkaccount SET ispresent=true where username='$username'");
	}
	public function set_this_counter_to_false($username)
	{
		$this->db->query("UPDATE clerkaccount SET ispresent=false where username='$username'");
	}
	public function delete_customer($prioritynumber,$countername)
	{
		$this->db->query("DELETE FROM customer where prioritynumber='$prioritynumber' and countername='$countername'");
	}
	public function requeue($prioritynumber,$countername)
	{
		$query1=$this->db->query("SELECT prioritynumber FROM customer where countername='$countername' ORDER BY prioritynumber");
		$query2=$this->db->query("SELECT * FROM customer where countername='$countername'");
		if($query2->num_rows()<10)
		{
			$this->db->query("UPDATE customer SET prioritynumber=(SELECT MAX(prioritynumber) from customer)+1 where prioritynumber=$prioritynumber");
		}
		else
		{
			$k=0;
			$query3=$this->db->query("SELECT MAX(prioritynumber) as maxnumber from customer");
			foreach($query3->result() as $result)
			{
				$maximumPriorityNumber=$result->maxnumber;
			}
			$x=$maximumPriorityNumber;
			foreach($query1->result() as $myresult)
			{
				$k=$k+1;
				$x=$x+1;
				$pnumber=$myresult->prioritynumber;
				if($k==12)	
				{
					$this->db->query("UPDATE customer SET prioritynumber=$x where prioritynumber=$pnumber and countername='$countername'");
					$this->db->query("UPDATE customer SET prioritynumber=$pnumber where prioritynumber=$prioritynumber and countername='$countername'");	
				}
				else if($k>12)
				{
					$this->db->query("UPDATE customer SET prioritynumber=$x where prioritynumber=$pnumber and countername='$countername'");
				}
			}
		}
	}
	public function transfer_customer($old_countername,$new_countername)
	{
		$query1=$this->db->query("SELECT MAX(prioritynumber) as maxnumber from customer");
		$query2=$this->db->query("SELECT * FROM customer where countername='$new_countername'");
		if($query2->num_rows()==0)
		{
			$this->db->query("UPDATE customer SET countername='$new_countername' where countername='$old_countername'");
			$this->db->query("UPDATE constituent SET countername='$new_countername' where countername='$old_countername'");
			$this->db->query("UPDATE walkin SET countername='$new_countername' where countername='$old_countername'");
		}
		else
		{
			foreach($query1->result() as $p)
			{
				$maximumPriorityNumber=$p->maxnumber;
			}
			$x=$maximumPriorityNumber;
			$query_final=$this->db->query("SELECT prioritynumber FROM customer where countername='$old_countername' ORDER BY prioritynumber");
			foreach($query_final->result() as $myresult)
			{
				$pnumber=$myresult->prioritynumber;
				$x=$x+1;
				$this->db->query("UPDATE customer SET prioritynumber=$x,countername='$new_countername' where prioritynumber=$pnumber and countername='$old_countername'");
				$this->db->query("UPDATE constituent SET prioritynumber=$x,countername='$new_countername' where prioritynumber=$pnumber and countername='$old_countername'");
				$this->db->query("UPDATE walkin SET prioritynumber=$x,countername='$new_countername' where prioritynumber=$pnumber and countername='$old_countername'");
			}
		}	
	}
	public function generate_constituent($idnumber,$lastname,$firstname)
	{
		$this->db->query("INSERT INTO constituentdatabase(idnumber,lastname,firstname) VALUES('$idnumber','$lastname','$firstname')");
	}
	public function get_all_constituent_in_database()
	{
		$query=$this->db->query("SELECT * FROM constituentdatabase ORDER BY lastname");
		return $query;
	}
}
?>