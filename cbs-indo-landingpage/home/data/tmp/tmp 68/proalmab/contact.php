<?php

/*
  |--------------------------------------------------------------------------
  | Mailer                                                                  |
  |--------------------------------------------------------------------------
  |                                                                         |
  | These module ares used when sending email from contact form             |
  |                                                                         |
  |--------------------------------------------------------------------------
*/

	// Configuration
	$email_site = "support@yourdomain.com";
		
		$name = '';
		$email = '';
		$subject = '';
		$messagge = '';
		$user_ip = '';
		$headers = '';
		$text = '';

		// Datamail
		$name      = stripslashes( $_POST['name'] );
		$email     = strtolower( $_POST['email'] );
		$subject   = stripslashes( $_POST['subject'] );
		$messagge  = stripslashes( nl2br( $_POST['text-message'] ) );
		$user_ip   = $_SERVER['REMOTE_ADDR'];

		// Field Control
		if ( empty( $name ) || empty( $email ) || empty( $subject ) ){

			print( 'Please fill all the fields in the form.' );
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			exit();

		}

		// Email Control
		if ( !preg_match( "/^[a-z0-9_\.\-]+@[a-z0-9\-\.]+\.[a-z]{2,4}$/", $email ) ) {

			print( 'e-mail is not valid.' );
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			exit();

		}

			// Header
			$headers = "MIME-Version: 1.0\n";
			$headers.= "X-Sender: <" . $email . ">\n";
			$headers.= "X-Mailer: PHP\n";
			$headers.= "Content-type: text/html; charset=utf-8\n";
			$headers.= "From: " . $name . " <" . $email . ">\n";
			$headers.= "Return-Path: <" . $email . ">\n";
			$headers.= "Reply-To: <" . $email . ">\n";

			// Body
			$text  = 'Name: <strong>'. $name . '</strong><br />';
			$text .= 'Email: <strong>'. $email .'</strong><br />';
			$text .= '------------------------------<br />';
			$text .= '<strong>' . $messagge . '</strong><br />';
			$text .= '------------------------------<br /><br />';
			$text .= 'IP:  <strong>'. $user_ip . '</strong>';

		// Send email
		if ( @mail ( $email_site, $subject, $text, $headers ) ){

			print( "Message successfully sent." );
			exit;

		} else {

			print( "Message could not be sent." );
			exit;

		}