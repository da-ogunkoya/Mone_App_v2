<?php
require_once( "../config/init.php");
$user=new User;
$template=new Template('templates/activites.php');
$user=new User;
$id=isset($_GET['Id'])?$_GET['Id']:"";

//table pagination 
$page_table="SELECT * FROM dellog WHERE email=$id";	
$pages = new Paginator($page_table,9,array(15,3,6,9,12,25,50,100,250,'All'));
		$start=$pages->limit_start;
		$end=$pages->limit_end;

		
//result for template

$template->dataResult=$user->findActivities($id,$start,$end);

//pagination value for the template/view
$template->pagin= $pages->display_pages();														//quick menu
$template->pages=$pages->display_jump_menu(); 
$template->items=$pages->display_items_per_page();	//quick menu
		
		
echo $template;


?>