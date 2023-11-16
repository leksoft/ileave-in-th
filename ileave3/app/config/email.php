<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//send mail 
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;


//SMTP
//$config['useragent'] = 'Ninenik.com'; // กำหนดส่งจากอะไร เช่น ใช่ชื่อเว็บเรา  
//$config['protocol'] = 'smtp';  // สามารถกำหนดเป็น mail , sendmail และ smtp  
//$config['smtp_host'] = 'smtp-relay.gmail.com';
//$config['smtp_user'] = 'gmail_account';
//$config['smtp_pass'] = 'gmal_password';
//$config['smtp_port'] = '25';
//$config['smtp_crypto'] = 'tls'; // รูปแบบการเข้ารหัส กำหนดได้เป้น tls และ ssl  
//$config['mailtype'] = 'html'; // กำหนดได้เป็น text หรือ html  