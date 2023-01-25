<?php

# for details: https://developer.wordpress.org/reference/functions/wp_mail/

$to = 'sendto@example.com';
$subject = 'The subject';
$body = 'The email body content';
$headers = array('Content-Type: text/html; charset=UTF-8');

wp_mail( $to, $subject, $body, $headers );

// or

// assumes $to, $subject, $message have already been defined earlier...

$headers[] = 'From: Me Myself <me@example.net>';
$headers[] = 'Cc: John Q Codex <jqc@wordpress.org>';
$headers[] = 'Cc: iluvwp@wordpress.org'; // note you can just use a simple email address

wp_mail( $to, $subject, $message, $headers );
