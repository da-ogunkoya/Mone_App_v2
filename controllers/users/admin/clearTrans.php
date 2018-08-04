<?php 
require_once('../config/init.php');
$template=new Template('templates/clearTrans.php');
$user=new User;
$transaction=new Transaction;

//GET Id
$id=isset($_GET['Id'])?$_GET['Id']:"";
$template->Id=$id;

//System Package type find table display
	if(binfo()['size']==1){
		$table="cust_transaction";
		$template->type='c';
	}
	else{
//table/type-a,c,ac
	$table = isset($_GET['type'])?($_GET['type']=='a' || $_GET['type']=='ac'?'agent_cust_transaction':'cust_transaction'):"agent_cust_transaction";		
		$template->tableGet=$table;	
		$template->type=$_GET['type'];			
	}
//field
$field=$_GET['type']=='c'?'cid':'agid';
//query		


//post
		if(isset($_POST['submit'])){
			$required=array();			
			$date1=$_POST['date1'];
			$date2=$_POST['date2'];
			//$table="clear_trans WHERE (date BETWEEN '08/10/2016' && '10/10/2016')";
			$table='clear_trans WHERE (date BETWEEN '.$date1.' AND '.$date2.')';
			
		}	
		else{
			$table=$table." WHERE $field=$id && clear='uc' ";
		}		
	
$page_table="SELECT * FROM $table";	
$pages = new Paginator($page_table,9,array(15,3,6,9,12,25,50,100,250,'All'));
		$start=$pages->limit_start;
		$end=$pages->limit_end;
//ends here


		
$template->table=$table;
//fetch table result for view		
$table_query="SELECT * FROM $table  ORDER BY date DESC LIMIT $start,$end";
$template->dataResult=$transaction->transaction($table_query);

//pagination value for the template/view
$template->pagin= $pages->display_pages();														//quick menu
$template->pages=$pages->display_jump_menu(); 
$template->items=$pages->display_items_per_page();	//quick menu
		
echo $template;


?>