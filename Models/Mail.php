<?php 
	
	namespace Models;
	class Mail()
	{
		private $receiver;
		private $subject;
		private $message;

	    public function getReceiver()
	    {
	        return $this->receiver;
	    }

	    public function setReceiver($receiver)
	    {
	        $this->receiver = $receiver;

	        return $this;
	    }

	    public function getSubject()
	    {
	        return $this->subject;
	    }

	    public function setSubject($subject)
	    {
	        $this->subject = $subject;

	        return $this;
	    }

	    public function getMessage()
	    {
	        return $this->message;
	    }


	    public function setMessage($message)
	    {
	        $this->message = $message;

	        return $this;
	    }
	}	

 ?>