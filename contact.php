<?php

// set your email here
$emailTo = 'sample@yourdomain.com';

// If the form is submitted
if(isset($_POST['submitted'])) {

	// Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		// Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '' || trim($_POST['contactName']) === 'Name') {
			$nameError = 'You forgot to enter your name.';
			$nameclass = 'error';
			$phpclass = 'php-message';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		// Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '' || trim($_POST['email']) === 'Email')  {
			$emailError = 'You forgot to enter your email address.';
			$emailclass = 'error';
			$phpclass = 'php-message';
			$hasError = true;
		} else if (!eregi('^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$', trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$emailclass = 'error';
			$phpclass = 'php-message';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		// Check to make sure comments were entered	
		if(trim($_POST['comments']) === '' || trim($_POST['comments']) === 'Message') {
			$commentError = 'You forgot to enter your comments.';
			$commentclass = 'error';
			$phpclass = 'php-message';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		// If there is no error, send the email
		if(!isset($hasError)) {
			
		$success_message = '<p class="message-box no-icon green">'.'<strong>Thanks!</strong> Your email was successfully sent. I check my email all the time, so I should be in touch soon.'.'</p>';

			
			$subject = 'Contact Form Submission from '.$name;
			$body = 'Name: '.$name."\n\nEmail: ".$email."\n\nComments: ".$comments;
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			$emailSent = true;

		}
	}
}

if(isset($emailSent) && $emailSent == true) {
	echo $success_message;
}
	
?>