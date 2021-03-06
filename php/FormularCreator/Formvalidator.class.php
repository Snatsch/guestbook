<?php
	namespace FormularGenerator;
	
	require_once("fieldtypes.class.php");
	require_once("errorCodes.class.php");
	require_once("FormField.class.php");
	
	class formvalidator
	{
		public $errorValidation = "";
		
		public function validateAll($Fields)
		{
			foreach($Fields as $Field)
			{
				if($Field->Repetition == false)
				{
					self::validate($Field);
				}
			}
		}
	
		public function validate($Field)
		{
			switch($Field->validate())
			{
				case errorCodes::ERR_MAXLENGTH:
					$this->errorValidation .= "Inhalt vom Feld " . $$Field->FormFieldName . " zu lang! <br>";
					break;
				case errorCodes::ERR_REQUIRED:
					$this->errorValidation .= "Feld " . $Field->FormFieldName . " nicht ausgefüllt! <br>";
					break;
				case errorCodes::ERR_FORMAT:
					$this->errorValidation .= "Format von " . $Field->FormFieldName . " falsch! <br>";
					break;
				case errorCodes::ERR_PASSWORD:
					$this->errorValidation .= "Passwortformat: mindestens 1 kleiner Buchstabe, 1 grosser Buchstabe, 1 Zahl( 8 - 20 Zeichen ) <br>";
					break;
			}
		}

		public function validationSuccessful()
		{
			return $this->errorValidation == "";
		}
		
		public function showErrors()
		{
			return $this->errorValidation;
		}
		
	}
?>