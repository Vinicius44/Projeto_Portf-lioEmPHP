<?php

	/**
	 * 
	 */
	class Email
	{
		
		private $mailer;

		public function __construct($host,$username,$senha,$name)
		{
			//Correção: o correto é $this e não this
			//Correção: o correto é mailer e não $mailer 
			//Dica: Revise o módulo de orientação a objetos
				$this->mailer = new PHPMailer;

			
			    //Server settings
			                 
			    $this->mailer->isSMTP();                                            //Send using SMTP
			    $this->mailer->Host       = $host;                     //Set the SMTP server to send through
			    $this->mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
			    $this->mailer->Username   = $username;                     //SMTP username
			    $this->mailer->Password   = $senha;                               //SMTP password
			    $this->mailer->SMTPSecure = 'tls';            //Enable implicit TLS encryption
			    $this->mailer->Port       = 587;
			    $this->mailer->CharSet = "UTF-8";                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			    //Recipients
			    $this->mailer->setFrom($username, $name);
			    //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
			    //$mail->addAddress('ellen@example.com');               //Name is optional
			    //$mail->addReplyTo('info@example.com', 'Information');
			    //$mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');

			    //Attachments
			    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			    //Content
				$this->mailer->isHTML(true);                                  //Set email format to HTML
			   
		}

		public function addAdress($email,$nome){
			$this->mailer->addAddress($email,$nome); 
		}

		public function formatarEmail($info){
			$this->mailer->Subject = $info['assunto'];
		    $this->mailer->Body    = $info['corpo'];
			$this->mailer->AltBody = strip_tags($info['corpo']);
		}

		public function enviarEmail(){
			if($this->mailer->send()){
				return true;
			}else{
				return false;
			}
		}
	}



?>