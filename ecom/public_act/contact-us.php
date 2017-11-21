<?php 
$member_name = $_POST['name'];
$member_email = $_POST['email'];
$member_subject = $_POST['subject'];
$member_message = $_POST['message'];

$stmt_insert_feedback = $mysqli -> prepare("INSERT INTO feedback (feedback_member_id, feedback_member_name, feedback_member_email, feedback_member_subject, feedback_member_message) VALUES (?,?,?,?,?)");
$stmt_insert_feedback -> bind_param('issss', $member->getMember_id(), $member_name, $member_email, $member_subject, $member_message);
if($stmt_insert_feedback -> execute()){
	$to = "wanhaojun118@hotmail.com";
	$subject = $member_subject;
	$message = $member_message;
	$header = "From: " . $member_email . " , " . $member_name;
	mail($to, $subject, $message, $header);
	$output[0] = true;
	$output[1] = $LANG_FEEDBACK_SUBMITTED;
}else{
	$output[0] = false;
	$output[1] = $LANG_FEEDBACK_NOT_SUBMITTED;
}

echo json_encode($output);
?>