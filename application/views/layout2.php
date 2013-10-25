<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script type="text/javascript">
function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
	var AMPM;
	AMPM = h<12? "AM": "PM";	
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = 'Today is '+days[day]+' '+months[month]+' '+d+', '+year+' '+h%12+':'+m+':'+s + AMPM;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
</script>
<title><?php echo $title;?></title>

 <script src="<?php echo base_url()?>scripts/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url()?>scripts/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>styles/flexigrid.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>styles/jqpurr.css" />
   <script type="text/javascript" src="<?php echo base_url()?>scripts/jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url()?>scripts/flexigrid.pack.js"></script>
   
  

<link rel="stylesheet" href="<?php echo base_url()?>styles/styletest.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo base_url()?>styles/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>styles/toastmsg/jquery.toast.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>styles/toastmsg/jquery.toast.min.css" type="text/css">

<script src="<?php echo base_url()?>scripts/toastmsg/jquery.toast.js"></script>
<script src="<?php echo base_url()?>scripts/toastmsg/jquery.toast.min.js"></script>
<script type="text/javascript">
			function createToast(t){
				var message = 'Hi, I\m just your every day, average kind of toast.';
				var options = {
					duration: Math.floor(Math.random() * 4001) + 1000,
					sticky: !!Math.round(Math.random() * 1),
					type: t
				};
				
				switch(t){
					case 'danger': message = '<h4>Danger!</h4> Oh no. You\'ve activated a dangerous toast. Beware as it was may (or may not) be sticky.'; break;
					case 'info': message = '<h4>FYI</h4> I\'m a toast and I just wanted you to know that.'; break;
					case 'success': message = '<h4>Great!</h4> You\'ve made a toast. Now let\'s\ toast to you.'; break;
					case 'blankfield': message = '<h4>Blank field alert</h4> All fields are required.'; break;
					
				}
				
				$.toast(message, options);
			}
			
			$(document).ready(function(){
				$.toast.config.align = 'right';
				$.toast.config.width = 400;
				
				$('toast').click(function(){
					createToast($(this).attr('class'));
					return false;
				});
			});
		</script>

<script>
  $(function() {
    $( "#dialog" ).dialog();
  });
  </script>

<style type="text/css">
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
@font-face {
    font-family: 'tf2_buildtf2_build';
    src: url('<?php echo base_url();?>fonts/tf2build-webfont.eot');
    src: url('<?php echo base_url();?>fonts/tf2build-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo base_url();?>fonts/tf2build-webfont.woff') format('woff'),
         url('<?php echo base_url();?>fonts/tf2build-webfont.ttf') format('truetype'),
         url('<?php echo base_url();?>fonts/tf2build-webfont.svg#tf2_buildtf2_build') format('svg');
    font-weight: normal;
    font-style: normal;

}
@font-face {
    font-family: 'tf2secondary';
    src: url('<?php echo base_url();?>fonts/tf2secondary-webfont.eot');
    src: url('<?php echo base_url();?>fonts/tf2secondary-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo base_url();?>fonts/tf2secondary-webfont.woff') format('woff'),
         url('<?php echo base_url();?>fonts/tf2secondary-webfont.ttf') format('truetype'),
         url('<?php echo base_url();?>fonts/tf2secondary-webfont.svg#tf2secondary') format('svg');
    font-weight: normal;
    font-style: normal;

}

div
{
font-family: 'tf2secondary';
}
h1
{
font-family: 'tf2_buildtf2_build';
}
tr
{
font-family: 'tf2secondary';
}
p
{
font-family: 'tf2secondary';
}
div[id=main-menu]{
    text-align: center;
}
span{
    color: black;
}
  a{
        color: blue;
        font-weight: bolder;
	}
form input[type=submit]{
	margin-left: 7em;
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
</head>
<body>
<div id="container">
  
<div id="header">
  <div class="nav-top">
    <div class="left">
       <ul class="nav-top-menu">
        <li><span id="logo"><a title="Admin Homepage" href="<?php echo base_url()?>index.php/queue_home/home">Home</a></span></li>
        <li class="counter_management"><a href="#" class="brown">Counter/Clerk Management</a>
          <ul class="lodger-menu">
			<!-- Format: <a href="[base url]bhms_home/methodname">-->
			<li><a href="<?php echo base_url()?>index.php/queue_home/create_counter" title="Create a new Counter">Create Counter</a></li>
			<li><a href="<?php echo base_url()?>index.php/queue_home/view_or_edit_all_counter" title="Edit or View all Queues of Every Counter">Edit or View all Queues of Every Counter</a></li>
          </ul>
        </li>
		<li class="account_setting"><a href="#" class="brown">Reset All Queues</a>
          <ul class="lodger-menu">
			<!-- Format: <a href="[base url]bhms_home/methodname">-->
			<li><a href="<?php echo base_url()?>index.php/queue_home/reset_all_queue" onclick="return confirm (\'Are you sure you want to reset this Queue? It cannot be undone.\')" title="Reset Queue Of Every Counter">Reset Queue Of Every Counter</a></li>
          </ul>
        </li>
		<li class="account_setting"><a href="#" class="brown">Account Setting</a>
          <ul class="lodger-menu">
			<!-- Format: <a href="[base url]bhms_home/methodname">-->
			<li><a href="<?php echo base_url()?>index.php/queue_home/change_admin_password" title="Edit System account or username">Change Administrator's Password</a></li>
			<li><a href="<?php echo base_url()?>index.php/queue_home/dissolve_system_admin" title="Edit System account or username">Dissolve this System Administrator</a></li>
          </ul>
        </li>
		<li class="account_setting"><a href="#" class="brown">Constituent Management</a>
          <ul class="lodger-menu">
			<!-- Format: <a href="[base url]bhms_home/methodname">-->
			<li><a href="<?php echo base_url()?>index.php/queue_home/generate_constituent" title="Edit System account or username">Generate Constituent</a></li>
			<li><a href="<?php echo base_url()?>index.php/queue_home/edit_or_view_constituent_in_database" title="Edit System account or username">Edit/View All Constituent</a></li>
          </ul>
        </li>

		
      </ul>
    </div>
	<div class="right">
		<span>You logged in as <?php echo $staff_type; ?></span>
		 <a title="Log-out of the system" href="<?php echo base_url()?>index.php/queue_home/logout">(LOGOUT)</a>
		<!--<span>Logged in: <?php //echo $this->username; ?>   </span>-->
		<!--<a title="Log-out of the system." href="<?php echo base_url()?>index.php/bhms_home/logout" class="brown" >Logout</a>-->
	</div>
    
  </div>
  <div class="clear"></div>
  <div id="main-menu">
    <ul>
     <span id="date_time"></span>
            <script type="text/javascript">window.onload = date_time('date_time');</script>
    </ul>
  </div>

</div>
<div class="content">
<div class="content-body">
<center><h1>
<span class="boxshadow"style="background:#fff">
<?php echo $headline;?>
</span>
</h1>

<?php $this->load->view($include);?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</center>

</div>
</div>
<div id="footer">
  <div style="float:left; width:400px"> 
  
  <!--[if IE]>
Place content here to target all Internet Explorer users.
	You are using Internet Explorer.<br>
	This system runs better on Chrome or Firefox
<![endif]-->
<![if !IE]>
Good. You are using the correct browser.
<![endif]>
  
  </div>
  <div style="width:300px;float:right; text-align:right">
  Donut Fortress Queueing System<br>
  Test Build<br>
  Last Release: N/A<br>
  <a href="<?php echo base_url()?>index.php/queue_home/about">About Team Donut</a>
  </div>
</div>
</body>
</html>