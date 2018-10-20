<?php
//destroy the session
session_start();
unset($_SESSION);
session_destroy();
header('Location: ./'.$_GET['page']);
die;
?>