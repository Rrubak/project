<?php 

	include_once '../db/db_functions.php';
	$conn = db_connect();
	$sql = "SELECT * FROM `tasks` WHERE `date` ='".date("Y-m-d")."'";
	$result = execute_query($sql, $conn);
	while ($row = $result->fetch_assoc()) {
		$final[] = $row;
	}
	$tasks = "";
	foreach ($final as $dummy_id => $task_details) {
		$tasks = $tasks.$task_details['tasks_completed'].'<br/>';
	}
	
	mail_to_mam($tasks);
	mail_to_sudhakar($tasks);


	function mail_to_sudhakar($tasks){
		$message_content = "<blockquote>Hi sudhakar, <br/><blockquote>Today <b>".date("Y-m-d")."</b> the students have completed the following tasks<blockquote>".$tasks."</blockquote></blockquote>Thanks,<br/>Rubak</blockquote>";
		$to       = 'sudhakar@vefetch.com';
		print_r($message_content);
		send_mail($to,$message_content);
	}
	function mail_to_mam($tasks){
		$message_content = "<blockquote>Hi Mam, <br/><blockquote>Today <b>".date("Y-m-d")."</b> the students have completed the following tasks<blockquote>".$tasks."</blockquote></blockquote>Thanks,<br/>Rubak</blockquote>";
		$to       = '14cse11@gmail.com';
		print_r($message_content);
		send_mail($to,$message_content);
		
	}
 	function send_mail($to ,$message_content){
 		echo "$message_content";
 		$subject  = "Today's Update ".date("Y-m-d")."- Reg";
		$headers  = 'From: [your_gmail_account_username]@gmail.com' . "\r\n" .
	            'MIME-Version: 1.0' . "\r\n" .
	            'Content-type: text/html; charset=utf-8';
		if(mail($to, $subject, $message_content, $headers))
		    echo "Email sent";
		else
		    echo "Email sending failed";
 	}

