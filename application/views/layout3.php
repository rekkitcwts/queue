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
</style>
</head>
<body>
<div id="container">
  
<div id="header">
  <div class="nav-top">
    <div class="left">
       <ul class="nav-top-menu">
        <li><span id="logo"><a title="Admin Homepage" href="<?php echo base_url()?>index.php/queue_home/home">Home</a></span></li>
        <li class="counter_management"><a href="#" class="brown">Load Queue</a>
          <ul class="lodger-menu">
			<!-- Format: <a href="[base url]bhms_home/methodname">-->
			<li><a href="<?php echo base_url()?>index.php/queue_home/now_serving" title="Create a new Counter">Now Serving</a></li>
          </ul>
        </li>
      </ul>
    </div>
	<div class="right">
		<span>You logged in as <?php echo $staff_type; ?></span>
		 <a title="Log-out of the system" href="<?php echo base_url();?>index.php/queue_home/logout">(LOGOUT)</a>
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