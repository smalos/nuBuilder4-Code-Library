// Send reminders to users for their pending tasks

$s	= "
		SELECT task_status, task_id, sus_email
		FROM tasks
		LEFT JOIN zzzzsys_user ON zzzzsys_user_id = task_user_id
		WHERE task_status = 'pending'
		
	   ";
	   
$t	= nuRunQuery($s);

while($r = db_fetch_object($t)){
		
	$recipient	= $r->sus_email;
	$task_id	= $r->task_id;
	
	$body = "Hello, <br><br> This is a reminder that your task with id $task_id is still pending.";
	$subject = "[Reminder] task $task_id pending";
	$cc = "";
	$bcc = "";
	
	nuSendEmail($recipient, "taskreminders@abc.com", "Task Reminder", $body, $subject, [], true, $cc, $bcc);
	
}