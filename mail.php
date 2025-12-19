<?php

$post_message = '';

$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach
$c = true;
if ( $method === 'POST' ) {

	$project_name = trim($_POST["project_name"]);
	$admin_email  = trim($_POST["admin_email"]);
	$form_subject = trim($_POST["form_subject"]);
	
	$_POST['testkey'] = 'testval';
	

	foreach ( $_POST as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
			$post_message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
} else if ( $method === 'GET' ) {

	$project_name = trim($_GET["project_name"]);
	$admin_email  = trim($_GET["admin_email"]);
	$form_subject = trim($_GET["form_subject"]);

	foreach ( $_GET as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
			$post_message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
}

$post_message = "<table style='width: 100%;'>$post_message</table>";



  function isValidEmail($email){ 
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
  }
  $mailSender = 'po4ta_host@profmed77.ru';
  $mailRecipient = $_POST["admin_email"];
  
  
  $boundary = uniqid('np');
  $headers = 'From: ' . $mailSender  . PHP_EOL .
             'Reply-To: ' . $mailSender  . PHP_EOL .
             'MIME-Version: 1.0' . PHP_EOL .
             "Content-Type: multipart/alternative;boundary=" . $boundary . PHP_EOL;
  //here is the content body
$message = "This is a MIME encoded message.";
$message .= "\r\n\r\n--" . $boundary . "\r\n";
$message .= "Content-type: text/html;charset=utf-8\r\n\r\n";

//Html body
$message .= $post_message;
$message .= "\r\n\r\n--" . $boundary . "--";

  if (!empty($mailRecipient) && isValidEmail($mailRecipient)) {
    if (mail($mailRecipient, $_POST["form_subject"], $message, $headers, '-f '.$mailSender)) {
      echo "php_mail: Отправлено, получатель ",$mailRecipient;
    } else {
      echo "php_mail: Ошибка, проверьте правильность введенных данных";
    }
  } 
?>
