<?php

// $retrieve_param = "member_name,member_phone";
// $retrieve_table = "member";
// $retrieve_condition = " where member_id=1";

// echo retrieve($retrieve_param,$retrieve_table,$retrieve_condition);

// function retrieve($retrieve_param,$retrieve_table,$condition,$param_type,$param_val) //$sql,0=nocondition;1=condition
// {
	// if($condition == "1")
	// $sql = "select ".$retrieve_param." from ".$retrieve_table." ".$retrieve_condition;
	// //return 
	// // $stmt_retrieve = $mysqli->prepare($sql);
	// // if($condition == "1")
	// // $stmt_retrieve->bind_param($param_type,$param_val);
	
	// // $stmt_retrieve->execute();
	// // $stmt_retrieve->store_result();
	// // $stmt_retrieve->bind_result($member_id,$member_username);
	// // while($stmt_retrieve->fetch())
	// // {
		
	// // }
	
	// return $sql;
// }

// $sql = "select member_name,member_phone from member where member_id=1";
// echo retrieve($sql);

// function retrieve($sql)
// {
	// $exploded_sql = explode(" ",$sql); 
	
	// $bind_result_param = explode(",",$exploded_sql[1]);
	// //print_r($bind_result_param);
	// // // for($x=0;$x<sizeof($retrieve_param);$x++)
	// // // {
		// // // // //${$retrieve_param[0]} = $retrieve_param[$x];
		// // // // print $retrieve_param[$x];
	// // // }
	// for($x=0;$x<sizeof($bind_result_param);$x++)
	// {
		// $bind_result_param[$x]= "$".$bind_result_param[$x];
	// }
	// //$stmt->bind_result(implode(",",$bind_result_param));
	// return $testing_val[1];
// }


?>