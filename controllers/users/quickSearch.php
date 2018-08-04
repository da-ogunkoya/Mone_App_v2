<?php
 require('config/init.php');

		
		 $user= new User;
		$table=getUser()['type']=='agent'?'agent_new_customer':'receiver';
//for agent and customer	
	if(isset($_GET['term'])){
			$id=getUser()['user_id'];
			  $searchTerm = $_GET['term'];
			  $value=$user->findUsers($searchTerm,$table,$id);		  
		 
		  foreach($value as $value){
			  if($table=='agent_new_customer'){
			  $result[]=$value->fname." ".$value->lname."-".$value->id;
			  }
			  else{
				 $result[]=$value->b_fname." ".$value->b_lname."-".$value->id;  
			  }
		  }
		  
		  echo json_encode($result);
		
	}
//admin search
	if(isset($_GET['adminSearchAgent'])){
				
			  $searchTerm = $_GET['adminSearchAgent'];
			  $value=$user->findAdminAgents($searchTerm);		  
		 
		  foreach($value as $value){
			  $result[]=$value->fname." ".$value->lname."-".$value->id;
		  }
		  
		  echo json_encode($result);
		
	}

//admin  Customer Search	
		if(isset($_GET['adminSearchCust'])){
				
			  $searchTerm = $_GET['adminSearchCust'];
			  $value=$user->findAdminCusts($searchTerm);		  
		 
		  foreach($value as $value){
			  $result[]=$value->fname." ".$value->lname."-".$value->id;
		  }
		  
		  echo json_encode($result);
		
	}
//admin agent Customer Search
		if(isset($_GET['adminAgentCust'])){
				
			  $searchTerm = $_GET['adminAgentCust'];
			  $value=$user->findAdminAgentCusts($searchTerm);		  
		 
		  foreach($value as $value){
			  $result[]=ucfirst($value->fname." ".$value->lname."-".$value->id);
		  }
		  
		  echo json_encode($result);
		
	}
?>