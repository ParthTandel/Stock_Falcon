
<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun; 
if(!class_exists ('mailsender'))
{
   class mailsender
   {
       function send_mail($to , $subject , $message )
       {
			$mg = new Mailgun("key-7421feb3cc1e55af215860441bf734a8");
			$domain = "stockfalcon.com";
			$mg->sendMessage($domain, array('from'    => 'noreply@stockfalcon.com', 
			                                'to'      => $to, 
			                                'subject' => $subject, 
			                                'text'    => $message));
		}
	}
}

?>