<?php

class message {
	public $name;
	public $time;
	public $message;

	public function __construct($name, $time, $message) {
		$this->name = $name;
		$this->time = $time;
		$this->message = $message;
	}

	public function gethtml() {
		$html = "";
		$html.= "<message style='color:#555555; font 10px'>";
		// time
		$html.= "<span style='color:#DDDDDD'>";
		$html.= $this->time;
		$html.= "</span>";
		$html.= " ";
		// name
		$html.= "<span style='color:#AAAAAA'>";
		$html.= "[";
		$html.= $this->name;
		$html.= "]";
		$html.= "</span>";
		$html.= " ";
		$html.= $this->message;
		$html.= "</message>";
		return $html;
	}

}

?>
