<h3>Hello <?php echo ucwords($first_name); ?>! Your name will be transacted in Counter "<?php echo $countername; ?>". Please wait there until your name is called. Thank You!</h3>
<br>
<form action="<?php echo base_url()?>index.php/queue_home/user" method="post">
<input type="submit"  style="width:150px;height:40px;" value="Next Customer"></form>