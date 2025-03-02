<?php
  // Gmail SMTP ayarlarıyla çalışacak şekilde yapılandırılmış form
  $receiving_email_address = 'murattrbl@icloud.com';

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
  $contact->subject = $_POST['subject'];

  // 📌 SMTP AYARLARI (Gmail Kullanarak Göndermek İçin)
  $contact->smtp = array(
    'host' => 'smtp.gmail.com', // Gmail SMTP Sunucusu
    'username' => 'murattrbl@icloud.com', // Kendi email adresin
    'password' => 'uyfwhoyknfjktodfkt', // App Password (Google'dan aldığın şifre)
    'port' => '587', // Gmail SMTP portu
    'encryption' => 'tls' // TLS kullanarak güvenli bağlantı sağlar
  );

  // 📩 Mesaj içeriğini belirle
  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  // Hata mesajlarını İngilizce yap
  $contact->error_messages = array(
    'empty_fields' => 'Please fill in all fields.',
    'invalid_email' => 'Invalid email format.',
    'short_message' => 'Message is too short.',
    'sending_failed' => 'Failed to send the message. Please try again later.'
  );

  echo $contact->send();
?>
