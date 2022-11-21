<?php 

	namespace Controllers;
	use Models\Mail;
	use Controllers\MailController;
	
	class MailController
	{

		public function sendEmail($reserveId, $receiver)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			mail($receiver, 'Pet Hero Invoice', 'hola como estas');
		}

	}
 ?>