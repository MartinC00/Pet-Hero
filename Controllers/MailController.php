<?php 

	namespace Controllers;

    use Models\Mail;
    use Controllers\CouponController;
    use Services\PHPMailer\PHPMailer;
    use Services\PHPMailer\Exception;
    use Services\PHPMailer\SMTP;


    class MailController {
        private $couponController;

        public function __construct() {
            $this->couponController = new CouponController();
        }

        public function sendEmail($idReserve, $name, $receiver) {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                               //Enable verbose debug output
                $mail->isSMTP();                                    //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                           //Enable SMTP authentication
                $mail->Username   = 'petheroadm2@gmail.com';         //SMTP username
                $mail->Password   = 'isrtosvxbbntfdmk';             //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
                $mail->Port       = 465;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('petheroadm@gmail.com', 'Admin');
                $mail->addAddress($receiver);     //Add a recipient

                $couponCode = $this->couponController->add($idReserve);

                $messageHTML = "Hi $name, your coupon code for payment is: $couponCode, go to Confirm payment in the PetApp and enter the code to pay the reservation.<br>
                        Please DO NOT SHARE THIS CODE WITH ANYONE besides the oficial site of Pet Hero.<br>
                        Thank you for trusting your pets with us!";

                $messagePlainText = "Hi $name, your coupon code for payment is: $couponCode, go to Confirm payment in the PetApp and enter the code to pay the reservation.
                        Please DO NOT SHARE THIS CODE WITH ANYONE besides the official site of Pet Hero.
                        Thank you for trusting your pets with us!";

                $subject = "Cupon code for Pet Hero's reservation payment";

                //Content
                $mail->isHTML(true);                          //Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $messageHTML;
                $mail->AltBody = $messagePlainText;

                $mail->send();

            } catch (Exception $e) {
                echo $mail->ErrorInfo;
            }
        }

	}
 ?>