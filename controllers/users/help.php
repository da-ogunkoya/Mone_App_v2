<?php
include 'config/init.php';

//Get Template & Assign Vars
$template = new Template('templates/help.php');
$user=new User;
echo $template;