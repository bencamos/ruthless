<?php
ini_set("include_path", '/home/dlscogf/php:' . ini_get("include_path") );
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

require_once "Mail.php";

$host = "ssl://domain.com";
$username = "admin@domain.com";
$password = "pass";
$port = "465";
$to = $_GET['to'];
$email_from = "admin@domain.com";
$email_subject = $_GET['subject'];
$email_body = $_GET['body'];
$email_address = "admin@domain.com";

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
echo("");
} else {
echo("<p>Attempted!</p>");
}
?>