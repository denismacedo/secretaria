<?php

session_start();

if ($_SESSION["USER_SESSION"] == "") {
	header("Location: login.php");
}
?>