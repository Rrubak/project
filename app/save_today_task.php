<?php
	include_once '../db/db_functions.php';
	session_start();
	task_mail();


	//functions
	function task_mail(){
		$conn = db_connect();
		$msg1 = "<b>".$_SESSION["username"].'</b> has completed the following tasks <ol>';
		$msg_2 = "";
		for ($i=1;(bool)($_POST['task'.$i]) ; $i++) { 
			if(isset($_POST['task'.$i])){
				if($msg_2 == ""){
					$msg_2 = "<li><b>".$_POST['task'.$i]."</b></li>";
				}else{
					$msg_2 = $msg_2."<li><b>".$_POST['task'.$i]."</b></li>";
				}
			}
		}		

		$final  = $msg1 . $msg_2."</ol>";
		$time_now=mktime(date('h')+5,date('i')+30,date('s'));
		$date = date('d-m-Y H:i', $time_now);
		$sql = "INSERT INTO `tasks`(`tasks_completed`, `user_id`, `date_time`,`date`) VALUES ('".$final."','".$_SESSION["userid"]."','".date('Y-m-d H:i', $time_now)."','".date('Y-m-d')."')";
		// echo $sql;
		if(execute_query($sql, $conn))
		{
			header("location:home.html");
		} else{
			echo "not inserted";
		}
		
	}
		

