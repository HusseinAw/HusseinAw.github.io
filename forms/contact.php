<?php
  /**
  * Requires the "PHP Email Form" library
  */

  // Replace with your receiving email address
  $receiving_email_address = 'versionv22@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = 'New Assessment Booking';

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  // Add basic information
  $contact->add_message( $_POST['name'], 'Student Name');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['phone'], 'Phone Number');
  $contact->add_message( $_POST['school_year'], 'School Year');

  // Process multiple selections for preferred days
  if(isset($_POST['preferred_days'])) {
    $preferred_days = implode(', ', $_POST['preferred_days']);
    $contact->add_message( $preferred_days, 'Preferred Days');
  }

  // Process multiple selections for subjects
  if(isset($_POST['subjects'])) {
    $subjects = implode(', ', $_POST['subjects']);
    $contact->add_message( $subjects, 'Preferred Subjects');
  }

  // Add the message
  $contact->add_message( $_POST['message'], 'Message', 10);

  // Send the email
  echo $contact->send();
?>
