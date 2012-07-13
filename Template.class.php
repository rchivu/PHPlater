<?php

require_once('interfaces.inc.php');
require_once('exceptions.php');

class Template implements ITemplate{
	private $html_body;
    private $definitions = array();
    public function __construct ($fileName){
    	$offset = 0;		
    	$template = file_get_contents($fileName);
		if($template === FALSE) throw new NoSuchTemplateFileException();
		
		$this->html_body = $template;
		
		while(is_numeric($offset = strpos($template,"{{"))){
			$template = substr($template,$offset+2);
			$template_end = strpos($template,"}}");
			$template_definition = substr($template,0,$template_end);
			$template_name_pos = strpos($template_definition,":");
			
			if($template_name_pos === FALSE) 
				throw new InvalidTemplateSyntaxException();
			
			if(trim(substr($template_definition,$template_name_pos+1, $template_end)) === '') 
				throw new InvalidTemplateSyntaxException();
			
			$key_value_array = explode(":",$template_definition);
			
			if($key_value_array[0] !== 'name')
				throw new InvalidTemplateSyntaxException();
			
			$this->definitions[$key_value_array[1]] = '';
			$template = substr($template,$template_end);
		}
    }
	public function __set ($name, $value){
		if (!isset($this->definitions[$name])) throw new NoSuchTagNameException($name);
		$this->definitions[$name] = $value;
	}
	public function __get($name){
		if (!isset($this->definitions[$name])) return "";
		return $this->definitions[$name];
	}
	public function getTagNames(){
		return array_keys($this->definitions);
	}
	public function display (){
		
		echo $this->render();
	}
	public function render (){
		$template = $this->html_body;
		foreach ($this->definitions as $key => $value) {
			if (!isset($value) || $value==='') throw new NoTagValueException($key);
			$template = str_replace("{{name:".$key."}}", $value, $template);
		}
		return $template;
	}
	
}

?>