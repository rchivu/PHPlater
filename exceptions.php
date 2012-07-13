<?php

class NoSuchTemplateFileException extends Exception {
	protected $message = 'Template file not found';
}
class InvalidTemplateSyntaxException extends Exception {
	protected $message = 'Template file contains syntax errors';
}
class NoSuchTagNameException extends Exception {
	public function __construct($name){
		$this->message = $this->message."(".$name.")";
	}
	protected $message ='Tag name does not exist in template';
}
class NoTagValueException extends Exception {
	public function __construct($name){
		$this->message = $this->message."(".$name.")";
	}
	protected $message ='Tag name has no specified value';
}

?>
