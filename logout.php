<?php
  session_start();
  session_destroy();
  header('Location:media.php?module=home');
	die();
		

?>