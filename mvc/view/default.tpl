<?php echo $header; ?>
<?php if (!$loggedin){ ?>
<form method="post">
	<input type="" name="username">
	<input type="password" name="password">
	<input type="submit" name="">
</form>
<?php } else { ?>
loggedin
<?php } ?>
<?php echo $footer; ?>