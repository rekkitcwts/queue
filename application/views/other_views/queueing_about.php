
<div id="main">
			<div class="guess_box_kureido"><img src="<?php echo base_url();?>img/TF2-QUEUE/Sniper.jpg"/></div>
			<br>
			<br>
			<br>
			<div class="guess_box_nick"><img src="<?php echo base_url();?>img/TF2-QUEUE/Heavy.jpg"/> </div>
			<br>
			<br>
			<br>
			<div class="guess_box_harold"><img src="<?php echo base_url();?>img/TF2-QUEUE/Engineer.jpg"/> </div>
			<br>
			<br>
			<br>
			<div class="guess_box_jalal"><img src="<?php echo base_url();?>img/TF2-QUEUE/Spy.jpg"/> </div>
			<br>
			<br>
			<br>
		</div>

		<script src="<?php echo base_url();?>scripts/jquery-1.9.1.js"></script>
		<script > 
			$(document).ready(function() {
				$(".guess_box_kureido").click(function() {
					$(".guess_box_kureido p").remove();
					$(".guess_box_nick p").remove();
					$(".guess_box_harold p").remove();
					$(".guess_box_jalal p").remove();
					var name = "<p>KUREIDO<br>BS COMPUTER SCIENCE-4</p>";
					$(this).append(name);
				
				});
				
				$(".guess_box_nick").click(function() {
					$(".guess_box_kureido p").remove();
					$(".guess_box_nick p").remove();
					$(".guess_box_harold p").remove();
					$(".guess_box_jalal p").remove();
					var name = "<p>NICK<br>BS COMPUTER SCIENCE-3</p>";
					$(this).append(name);
				
				});
				
				$(".guess_box_harold").click(function() {
					$(".guess_box_kureido p").remove();
					$(".guess_box_nick p").remove();
					$(".guess_box_harold p").remove();
					$(".guess_box_jalal p").remove();
					var name = "<p>HAROLD<br>BS COMPUTER SCIENCE-3</p>";
					$(this).append(name);
				
				});
				
				$(".guess_box_jalal").click(function() {
					$(".guess_box_kureido p").remove();
					$(".guess_box_nick p").remove();
					$(".guess_box_harold p").remove();
					$(".guess_box_jalal p").remove();
					var name = "<p>JALAL<br>BS COMPUTER SCIENCE-3</p>";
					$(this).append(name);
				
				});
				
			});//end doc ready
		</script> 
