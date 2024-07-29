<?php  if (isset($_SESSION["user_id"])) { ?>
<div class="p-0">
	<p class="welcome-msg"><marquee>Welcome: <?= $full_name; ?></marquee></p>
</div>
<?php } ?>
